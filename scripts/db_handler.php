<?php

// MVOPz@9EvNs
// $servername = "localhost";
// $dbUsername = "root";
// $dbPassword = "";
// $dbName = "studyspot";

// $connection = mysqli_connect($servername, $dbUsername, $dbPassword, $dbName);

    // $servername = "141.215.80.154";
    // $username = "group12";
    // $password = "MVOPz@9EvNs";
    // $dbName = "group12_db";

    $servername = "127.0.0.1";
    $username = "root";
    $password = "Moscow";
    $dbName = "group12";

    $connection = mysqli_connect($servername, $username, $password, $dbName);

    if (!$connection) {
        die("Connection failed: ".mysqli_connect_error());
    }

?>