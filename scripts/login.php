<?php
        if (isset($_POST['login-submit']) || isset($_POST['signup-submit'])) {
            
            require 'db_handler.php';

            $mailUsername = $_POST['mailUsername'];
            $password = $_POST['pwd'];

            // Error handling
            if (empty($mailUsername) || empty($password)) {
                header("Location: ../index.php?error=emptyFields&mailUsername=".$mailUsername);
                exit();
            }
            else {
                $sql = "SELECT * FROM users WHERE username=? OR email=?;";
                $statement = mysqli_stmt_init($connection);

                if (!mysqli_stmt_prepare($statement, $sql)) {
                    header("Location: ../index.php?error=sqlError");
                    exit();
                }
                else {
                    mysqli_stmt_bind_param($statement, "ss", $mailUsername, $mailUsername);
                    mysqli_stmt_execute(($statement));

                    $results = mysqli_stmt_get_result($statement);

                    if ($row = mysqli_fetch_assoc($results)) {
                        $pwdCheck = password_verify($password, $row['pwd']);
                        if ($pwdCheck == true) {
                            // LOGGED IN SUCCESSFULLY
                            session_start();
                            $_SESSION['userID'] = $row['id'];
                            $_SESSION['username'] = $row['username'];
                            ?>
                            <b>helloo</b>
                            <?php
                            header("Location: ../index.php?login=success");
                            exit();
                        }
                        else {
                            header("Location: ../index.php?error=wrongPassword");
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
        else {
            header("Location: ../index.php");
            exit();
        }
?>