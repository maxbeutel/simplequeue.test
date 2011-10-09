<?php

try {
    $dbh = new PDO('mysql:host=localhost;dbname=queue_test', 'root', 'password');
    echo "Connected\n";
} catch (Exception $e) {
    die("Unable to connect: " . $e->getMessage());
}

function addToQueue($dbh, $message)
{
    $processId = mt_rand(1, 24);
    

    
    $sql = "INSERT INTO queue_data (tstamp, message, in_progress, process_id) VALUES (NOW(), :message, 0, :process_id)";
    
    $q = $dbh->prepare($sql);
    $q->execute(array(':message' => $message, ':process_id' => $processId));
}

#addToQueue($dbh, json_encode(array('foo' => 'bar')));


for ($i = 0; $i < 450; $i++) {
    addToQueue($dbh, json_encode(array('foo' => 'bar')));
    
    if (($i % 100) === 50) {
        sleep(20);
    }
}


/*
CREATE TABLE queue_data (
  id int(11) unsigned NOT NULL auto_increment,
  tstamp datetime NOT NULL,
  message mediumblob,
  PRIMARY KEY (id)
) ENGINE=InnoDB;
 */