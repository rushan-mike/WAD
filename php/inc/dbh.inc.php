<?php

$hostname = "localhost:3306";
$dbUsername = "root";
$dbPassword = "";
$dbName = "loginsys";

$conn = mysqli_connect($hostname, $dbUsername, $dbPassword, $dbName);

if (!$conn) {
    die("SQL fail :" . mysqli_connect_error());
}
