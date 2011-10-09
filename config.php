<?php

$dbHost = 'localhost';
$dbUser = 'root';
$dbPassword = 'password';

if (is_file('config.local.php')) {
    require 'config.local.php';
}


$mysqli = new mysqli($dbHost, $dbUser, $dbPassword , 'queue_test');