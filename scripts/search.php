<?php
        if (isset($_POST['advancedsearch-submit'])) {
            
            require 'db_handler.php';

            $categoryToLookInto = $_POST['categoryToLookInto'];
            $wordsToInclude = $_POST['wordsToInclude'];
            $wordsToExclude = $_POST['wordsToExclude'];
            $postsAfterDate = $_POST['postsAfterDate'];
        
            if (empty($categoryToLookInto)) {
                header("Location: ../index.php?error=emptyCategory");
                exit();
            }
            
            $sql = "";
            //If all but posts are empty:
            if (empty($wordsToExclude) && empty($wordsToExclude) && empty($postsAfterDate)) {
                $sql =
                "SELECT `posts`.*
                FROM `posts`    
                WHERE `posts`.`community_name` = '$categoryToLookInto';";
            }
            //If only words to Include: 
            else if (empty($wordsToExclude) && empty($postsAfterDate)) {
                $sql = "SELECT `posts`.*
                FROM `posts`
                WHERE `posts`.`title` LIKE '%$wordsToInclude%' AND `posts`.`community_name` = '$categoryToLookInto';";
            }
            //If only words to exclude
            else if (empty($wordsToInclude) && empty($postsAfterDate)) {
                $sql = "SELECT `posts`.*
                FROM `posts`
                WHERE `posts`.`title` NOT LIKE '%$wordsToExclude%' AND `posts`.`community_name` = '$categoryToLookInto';";
            }
            //If only the posts after date:
            else if (empty($wordsToExclude) && empty($wordsToInclude)) {
                $sql = "SELECT `posts`.*
                FROM `posts`
                WHERE `posts`.`created_at` > '$postsAfterDate' AND `posts`.`community_name` = '$categoryToLookInto';";
            }
            //Else if all are non empty (all filters are applied) 
            else if (!empty($categoryToLookInto) && !empty($wordsToExclude) && !empty($wordsToInclude) && !empty($postsAfterDate)) {
                $sql = "SELECT `posts`.*
                FROM `posts`
                WHERE `posts`.`created_at` > '$postsAfterDate'`posts`.`community_name` = '$categoryToLookInto'`posts`.`title` LIKE '$wordsToInclude' AND `posts`.`title` NOT LIKE '$wordsToExclude';";
            }
            //If includes and date 
            else if (empty($wordsToExclude)) {
                $sql = "SELECT `posts`.*
                FROM `posts`
                WHERE `posts`.`created_at` > '$postsAfterDate'`posts`.`community_name` = '$categoryToLookInto'`posts`.`title` LIKE '$wordsToInclude';";
            }
            // if excludes and data
            else if (empty($wordsToInclude)) {
                $sql = "SELECT `posts`.*
                FROM `posts`
                WHERE `posts`.`created_at` > '$postsAfterDate'`posts`.`community_name` = '$categoryToLookInto'`posts`.`title` NOT LIKE '$wordsToExclude';";
            }
            //if includes and excludes
            else if (empty($postsAfterDate)) {
                $sql = "SELECT `posts`.*
                FROM `posts`
                WHERE `posts`.`title` NOT LIKE '$wordsToExclude'`posts`.`community_name` = '$categoryToLookInto'`posts`.`title` LIKE '$wordsToInclude';";
            } 


            $statement = mysqli_stmt_init($connection);
            if (!mysqli_stmt_prepare($statement, $sql)) {
                            header("Location: ../index.php?error=sqlError");
                            exit();
            }
            else {
                mysqli_stmt_execute(($statement));

                $results = mysqli_stmt_get_result($statement);

                // echo($results);

                while ($row = mysqli_fetch_assoc($results)) {
                // //         // LOGGED IN SUCCESSFULLY
                // //         session_start();
                        
                // //         header("Location: ../index.php?search=success");
                        echo(implode($row));
                        echo('<br/><br/>');
                        // exit();
                    
                // //     else {
                // //         header("Location: ../index.php?error=somethingWentWrong");
                // //         exit();
                // //     }
                }
            }

            //There are going to be multiple queries created based on what was entered in 

            // // Error handling
            // if (empty($mailUsername) || empty($password)) {
            //     header("Location: ../index.php?error=emptyFields&mailUsername=".$mailUsername);
            //     exit();
            // }
            // else {
            //     $sql = "SELECT * FROM users WHERE username=? OR email=?;";
            //     $statement = mysqli_stmt_init($connection);

        //         if (!mysqli_stmt_prepare($statement, $sql)) {
        //             header("Location: ../index.php?error=sqlError");
        //             exit();
        //         }
        //         else {
        //             mysqli_stmt_bind_param($statement, "ss", $mailUsername, $mailUsername);
        //             mysqli_stmt_execute(($statement));

        //             $results = mysqli_stmt_get_result($statement);

        //             if ($row = mysqli_fetch_assoc($results)) {
        //                 $pwdCheck = password_verify($password, $row['pwd']);
        //                 if ($pwdCheck == true) {
        //                     // LOGGED IN SUCCESSFULLY
        //                     session_start();
        //                     $_SESSION['userID'] = $row['id'];
        //                     $_SESSION['username'] = $row['username'];
                            
        //                     header("Location: ../index.php?login=success");
        //                     exit();
        //                 }
        //                 else {
        //                     header("Location: ../index.php?error=wrongPassword");
        //                     exit();
        //                 }
        //             }
        //             else {
        //                 header("Location: ../index.php?error=noUserFound");
        //                 exit();
        //             }
        //         }
        //     }
        // }
        }
        else {
            header("Location: ../index.php");
            exit();
        }
?>