<?php

    if (isset($_POST['signup-submit'])) {

        require 'db_handler.php';

        $username = $_POST['username'];
        $email = $_POST['mail'];
        $password1 = $_POST['password'];
        $password2 = $_POST['password-repeat'];
        $img = $_POST['photo'];

        // Error handling
        if (empty($username) || empty($email) || empty($password1) || empty($password2)) {
            header("Location: ../index.php?error=emptyFields&username=".$username."&mail=".$email);
            exit();
        }
        else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) {
            header("Location: ../index.php?error=invalidFields");
            exit();
        }
        else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { 
            header("Location: ../index.php?error=invalidMail&username=".$username);
            exit();
        }
        else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
            header("Location: ../index.php?error=invalidUsername&mail=".$email);
            exit();
        }
        else if ($password1 !== $password2) {
            header("Location: ../index.php?error=passwordCheck&username=".$username."&mail=".$email);
            exit();
        }
        else {

            // checks if username already exists in the db
            $sql = "SELECT username FROM users WHERE username=?;";
            $statement = mysqli_stmt_init($connection);
            
            if (!mysqli_stmt_prepare($statement, $sql)) {
                header("Location: ../index.php?error=sqlError");
                exit();
            }
            else {
                mysqli_stmt_bind_param($statement, "s", $username);
                mysqli_stmt_execute($statement);
                mysqli_stmt_store_result($statement);
                $resultsFound = mysqli_stmt_num_rows($statement);

                // Match found
                if ($resultsFound > 0) {
                    header("Location: ../index.php?error=usernameTaken&mail=".$email);
                    exit();
                }

                // checks if email already exists in the db
                $sql = "SELECT username FROM users WHERE email=?;";
                $statement = mysqli_stmt_init($connection);
                
                if (!mysqli_stmt_prepare($statement, $sql)) {
                    header("Location: ../index.php?error=sqlError");
                    exit();
                }
                else {
                    mysqli_stmt_bind_param($statement, "s", $email);
                    mysqli_stmt_execute($statement);
                    mysqli_stmt_store_result($statement);
                    $resultsFound = mysqli_stmt_num_rows($statement);

                    // Match found
                    if ($resultsFound > 0) {
                        header("Location: ../index.php?error=emailTaken&username=".$username);
                        exit();
                    }
                    else {
                        $sql = "INSERT INTO users (username, email, pwd) VALUES (?, ?, ?);";
                        $statement = mysqli_stmt_init($connection);

                        if (!mysqli_stmt_prepare($statement, $sql)) {
                            header("Location: ../index.php?error=sqlError");
                            exit();
                        }
                        else {
                            // SIGNED UP SUCCESSFULLY
                            $hashedPwd = password_hash($password1, PASSWORD_DEFAULT);
                            mysqli_stmt_bind_param($statement, "sss", $username, $email, $hashedPwd);
                            mysqli_stmt_execute($statement);
                
                            $sql = "SELECT * FROM users WHERE username=?;";
                            $statement = mysqli_stmt_init($connection);
            
                            if (!mysqli_stmt_prepare($statement, $sql)) {
                                header("Location: ../index.php?error=sqlError");
                                exit();
                            }
                            else {
                                mysqli_stmt_bind_param($statement, "s", $username);
                                mysqli_stmt_execute($statement);
            
                                $results = mysqli_stmt_get_result($statement);
            
                                if ($row = mysqli_fetch_assoc($results)) {
                                        session_start();
                                        $_SESSION['userID'] = $row['id'];
                                        $_SESSION['username'] = $row['username'];
                                        header("Location: ../index.php?login=success");
                                        exit();
                                    }
                                else {
                                    header("Location: ../index.php?error=noUserFound");
                                    exit();
                                }
                            }
                            
                            exit();
                        }
                    }
                }
            }
        }

        mysqli_stmt_close(($statement));
        mysqli_close($connection);
    }
    else {
        header("Location: ../index.php");
        exit();
    }
?>