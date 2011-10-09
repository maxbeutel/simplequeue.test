<?php

require 'config.php';

syslog(LOG_DEBUG, '### lets get crackin mr. manager');

$mysqli->autocommit(false);

// remove jobs that failed too often - could be written to a log table or so before deleting
// re-enqueue previously failed jobs (failed = jobs that did not complete within 25 seconds)
// remove successfull jobs (state 2)
$query = '
START TRANSACTION;
DELETE FROM queue_data WHERE retry_count > 4;
DELETE FROM queue_data WHERE status = 2 AND started < date_sub(now(), INTERVAL 12 HOUR);
UPDATE queue_data SET created = NOW(), retry_count = retry_count + 1, started = NULL WHERE state = 1 AND started < date_sub(now(), INTERVAL 25 SECOND);
COMMIT;
';

$mysqli->multi_query($query);
