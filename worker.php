<?php


$processId = isset($argv[1]) ? intval($argv[1]) : 1;

syslog(LOG_DEBUG, '###proc-' . $processId . ' worker starting');

$mysqli = new mysqli("localhost", "root", "password", "queue_test");

if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

$mysqli->autocommit(false);

$query = '
start transaction; 
select @A:=id from queue_data where process_id = ' . $processId . ' and in_progress = 0 and deleted = 0 order by tstamp asc limit 1;
update queue_data set in_progress = 1, progress_startet = NOW() where id = @A; 
select * from queue_data where id = @A; 
commit;
';

$mysqli->multi_query($query);

#printf("Errormessage: %s\n", $mysqli->error);

$id = 0;

do {
    /* store first result set */
    if ($result = $mysqli->store_result()) {
        while ($row = $result->fetch_row()) {


            if (count($row) > 1) {
                syslog(LOG_DEBUG, '###proc-' . $processId . ' processing: ' . json_encode($row));
                
                $id = $row[0];
                
                // something goes really wrong
                if (mt_rand() % 10 === 0) {
                    
                    
                    if (mt_rand() % 2 === 0) {
                        syslog(LOG_DEBUG, '###proc-' . $processId . ' sleeping');
                        
                        sleep(20);
                    } else {
                        syslog(LOG_DEBUG, '###proc-' . $processId . ' throw exception');
                        
                        throw new Exception();
                    }
                }
            }
        }
        $result->free();
    }
} while ($mysqli->next_result());

if ($id > 0) {
    syslog(LOG_DEBUG, '###proc-' . $processId . ' mark ' . $id . ' as done');

    $mysqli->autocommit(true);
    $mysqli->query('update queue_data set in_progress = 2 where id = ' . $id);  
} else {
    syslog(LOG_DEBUG, '###proc-' . $processId . ' no jobs found');
}

    
