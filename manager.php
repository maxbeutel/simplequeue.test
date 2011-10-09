<?php

$mysqli = new mysqli("localhost", "root", "password", "queue_test");

if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

syslog(LOG_DEBUG, '### lets get crackin mr. manager');

// delete stale jobs
// soft deleting for debug purposes
$mysqli->query('delete from queue_data where retry_count > 4');


$mysqli->autocommit(false);

$query = '
start transaction;
update queue_data set tstamp = NOW(), retry_count = retry_count + 1, progress_startet = NULL, in_progress = 0 where deleted = 0 and in_progress = 1 and progress_startet < date_sub(now(), interval 25 second);
commit;
';


$mysqli->multi_query($query);
