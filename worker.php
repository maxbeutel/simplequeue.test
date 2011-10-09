<?php

require 'config.php';

$processId = isset($argv[1]) ? intval($argv[1]) : 1;

syslog(LOG_DEBUG, '###proc-' . $processId . ' worker starting');

function getQueueData(mysqli $mysqli)
{
    $queueData = null;
    
    // fetching the row is kind of ugly
    // some queries in the transaction also return results, so these are skipped within the while loop
    // then the array is transformed to a hash with the decoded json message
    do {
        if ($result = $mysqli->store_result()) {
            while ($row = $result->fetch_row()) {
                // we found the data row
                if (count($row) > 1) {
                    $queueData = $row;
                    break;
                }
            }
            
            $result->free();
        }
    } while ($mysqli->next_result());
    
    if (!$queueData) {
        throw new RuntimeException('No queue data row found?!');
    }
    
    $message = json_decode($queueData[2], true);
    
    if (!$message) {
        throw new UnexpectedValueException('Got error decoding message');
    }
    
    return array(
        'id'        => $queueData[0],
        'created'   => $queueData[1],
        'message'   => $message,
        'processId' => $queueData[3],
        'started'   => $queueData[4],
    );
}


// pop off newest job from queue for this process
$mysqli->autocommit(false);

$query = '
START TRANSACTION; 
SELECT @A:=id FROM queue_data WHERE process_id = ' . $processId . ' AND state = 0 ORDER BY created ASC LIMIT 1;
UPDATE queue_data SET state = 1, started = NOW() WHERE id = @A; 
SELECT * FROM queue_data WHERE id = @A; 
COMMIT;
';

$mysqli->multi_query($query);

// fetch the job which will be processed
$queueData = null;

try {
    $queueData = getQueueData($mysqli);
} catch(RuntimeException $e) {
    syslog(LOG_DEBUG, '###proc-' . $processId . ' no jobs found');
    return;
}

syslog(LOG_DEBUG, '###proc-' . $processId . ' found: ' . json_encode($queueData));

// sometimes things go really wrong ...
if (mt_rand() % 10 === 0) {
    if (mt_rand() % 2 === 0) {
        syslog(LOG_DEBUG, '###proc-' . $processId . ' timing out');

        sleep(20);
    } else {
        syslog(LOG_DEBUG, '###proc-' . $processId . ' throwing exception');

        throw new Exception();
    }
}

// mark this row as done
syslog(LOG_DEBUG, '###proc-' . $processId . ' mark ' . $queueData['id'] . ' as done');

$mysqli->autocommit(true);

$stmt = $mysqli->prepare('UPDATE queue_data SET state = 2 WHERE id = ?');  
$stmt->bind_param('i', $queueData['id']);
$stmt->execute();
$stmt->free_result();
