<?php

$dbHost = 'localhost';
$dbUser = 'root';
$dbUserPass = 'mark0710';
$dbName = 'webiptsystem';

$conn = new MySQLi($dbHost, $dbUser, $dbUserPass, $dbName);


//Checks the connection

if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

//Long method in connecting to database

// $conn = mysqli_connect('localhost', 'root','');
// mysqli_select_db($conn, 'userregistration');