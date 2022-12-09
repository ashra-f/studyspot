<?php

    // MVOPz@9EvNs
    /* Local */
    $servername = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "studyspot";

    $connection = mysqli_connect($servername, $dbUsername, $dbPassword, $dbName);

    /* UMD's servers */
    

    // $servername = "141.215.80.154";
    // $username = "group12";
    // $password = "MVOPz@9EvNs";
    // $dbName = "group12_db";


    // $connection = mysqli_connect($servername, $username, $password, $dbName);


    if (!$connection) {
        die("Connection failed: ".mysqli_connect_error());
    }

?>