<?php

    if (isset($_POST['create-post-submit'])) {
                    
        require 'db_handler.php';
        session_start();

        $postTitle = $_POST['postTitle'];
        $postBody = $_POST['postBody'];
        $community = $_POST['cmty'];

        // Error handling
        if (empty($postTitle) || empty($postBody) || empty($community)) {
            header("Location: ../create.php?error=emptyFields");
            exit();
        }
        else {
            // get community id from community            
            $sql = "SELECT * FROM communities WHERE cmty_name=?;";
            $statement = mysqli_stmt_init($connection);

            if (!mysqli_stmt_prepare($statement, $sql)) {
                header("Location: ../create.php?error=sqlError");
                exit();
            }

            mysqli_stmt_bind_param($statement, "s", $community);
            mysqli_stmt_execute($statement);
            $result = mysqli_stmt_get_result($statement);

            if ($row = mysqli_fetch_assoc($result)) {              
                // Add a post in posts
                $sql = "INSERT INTO posts(author, community_name, title, descr) VALUES (?, ?, ?, ?);";
                $statement = mysqli_stmt_init($connection);

                if (!mysqli_stmt_prepare($statement, $sql)) {
                    header("Location: ../create.php?error=sqlError");
                    exit();
                }
                else {
                    mysqli_stmt_bind_param($statement, "ssss", $_SESSION['username'], $community, $postTitle, $postBody);
                    mysqli_stmt_execute($statement);
                    mysqli_stmt_store_result($statement);

                    // Update post_count in communities
                    $sql = "UPDATE communities SET post_count = post_count + 1 WHERE cmty_name=?;";
                    $statement = mysqli_stmt_init($connection);

                    if (!mysqli_stmt_prepare($statement, $sql)) {
                        header("Location: ../create.php?error=sqlError");
                        exit();
                    }
        
                    mysqli_stmt_bind_param($statement, "s", $community);
                    mysqli_stmt_execute($statement);
                
                    header("Location: ../index.php?success=postCreated");
                    exit();
                }
            }
            else {
                header("Location: ../create.php?error=noCmtyFound");
                exit();
            }
        }
    }
    else {
        header("Location: ../create.php");
        exit();
    }

?>
