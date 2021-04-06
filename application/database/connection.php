<?php

$dbHost = 'localhost';
$dbUser = 'root';
$dbUserPass = '';
$dbName = 'webiptsystem';

$conn = new mysqli($dbHost, $dbUser, $dbUserPass, $dbName);

//Checks the connection

if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

//Long method in connecting to database

// $conn = mysqli_connect('localhost', 'root','');
// mysqli_select_db($conn, 'userregistration');