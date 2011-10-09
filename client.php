<?php

require 'config.php';

function addToQueue(mysqli $mysqli, $message)
{
    $processId = mt_rand(1, 24); // total number of concurrent processes

    $stmt = $mysqli->prepare('INSERT INTO queue_data SET created = NOW(), message = ?, process_id = ?');
    $stmt->bind_param('si', $message, $processId);
    $stmt->execute();
    $stmt->free_result();
}


for ($i = 0; $i < 450; $i++) {
    addToQueue($mysqli, json_encode(array('foo' => 'bar')));
    
    if (($i % 100) === 50) {
        sleep(20);
    }
}
