<?php

$servername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "studyspot";

$connection = mysqli_connect($servername, $dbUsername, $dbPassword, $dbName);

if (!$connection) {
    die("Connection failed: ".mysqli_connect_error());
}

?>