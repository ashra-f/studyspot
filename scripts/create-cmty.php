<?php

    if (isset($_POST['create-cmty-submit'])) {
                
        require 'db_handler.php';
        session_start();

        $cmtyName = $_POST['cmtyName'];
        $cmtyAbout = strtolower($_POST['aboutCmty']);

        // Error handling
        if (empty($cmtyName) || empty($cmtyAbout)) {
            header("Location: ../index.php?error=emptyFields");
            exit();
        }
        // check if community name is already in the communities table
        else {
            $sql = "SELECT * FROM communities WHERE cmty_name=?;";
            $statement = mysqli_stmt_init($connection);

            if (!mysqli_stmt_prepare($statement, $sql)) {
                header("Location: ../index.php?error=sqlError");
                exit();
            }
            else {
                mysqli_stmt_bind_param($statement, "s", strtolower($cmtyName));
                mysqli_stmt_execute($statement);
                mysqli_stmt_store_result($statement);
                $resultsFound = mysqli_stmt_num_rows($statement);

                // Match found
                if ($resultsFound > 0) {
                    header("Location: ../index.php?error=cmtynameTaken");
                    exit();
                }

                $sql = "INSERT INTO communities (cmty_name, about) VALUES (?, ?);";
                $statement = mysqli_stmt_init($connection);

                if (!mysqli_stmt_prepare($statement, $sql)) {
                    header("Location: ../index.php?error=sqlError");
                    exit();
                }
                else {
                    // ADDED A NEW CMTY SUCCESSFULLY
                    mysqli_stmt_bind_param($statement, "ss", strtolower($cmtyName), $cmtyAbout);
                    mysqli_stmt_execute($statement);

                    // Get Cmty ID
                    $sql = "SELECT id FROM communities WHERE cmty_name=?;";
                    $statement = mysqli_stmt_init($connection);

                    if (!mysqli_stmt_prepare($statement, $sql)) {
                        header("Location: ../index.php?error=sqlError");
                        exit();
                    }

                    mysqli_stmt_bind_param($statement, "s", $cmtyName);
                    mysqli_stmt_execute(($statement));
                    $results = mysqli_stmt_get_result($statement);
            
                    if ($row = mysqli_fetch_assoc($results)) {            
                        // Add creator of community to membership table
                        $sql = "INSERT INTO memberships (usr_id, community_id) VALUES (?, ?);";
                        $statement = mysqli_stmt_init($connection);

                        if (!mysqli_stmt_prepare($statement, $sql)) {
                            header("Location: ../index.php?error=sqlError");
                            exit();
                        }
                        else {                        
                            mysqli_stmt_bind_param($statement, "ss", $_SESSION['userID'], $row['id']);
                            mysqli_stmt_execute($statement);
                                      
                            header("Location: ../index.php?sucess=cmtyCreated");
                            exit();
                        }
                    }
                    else {
                        header("Location: ../index.php?error=noUserFound");
                        exit();
                    }
                }                
            }
        }
    }
    else {
        header("Location: ../index.php");
        exit();
    }


?>