<?php
    /* Local */
    $servername = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "studyspot";

    /* UMD's servers */
    // $servername = "141.215.80.154";
    // $dbUsername = "group12";
    // $dbPassword = "MVOPz@9EvNs";
    // $dbName = "group12_db";

    $connection = mysqli_connect($servername, $dbUsername, $dbPassword, $dbName);

    if (!$connection) {
        die("Connection failed: ".mysqli_connect_error());
    }

?>