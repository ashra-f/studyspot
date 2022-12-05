<?php

    if (isset($_POST['create-cmt-submit'])) {
                
        require 'db_handler.php';
        session_start();

        $comment = $_POST['cmt-body'];
        $postID = $_POST['postid'];
        $authorID = $_SESSION['userID'];

        $query = "SELECT cmty_name FROM communities WHERE id=".$postID;
        $results = mysqli_query($connection, $query);
        if ($row = mysqli_fetch_assoc($results)) {
            $cmtyName = $row['cmty_name'];
        }

        // Error handling
        if (empty($comment)) {
            header("Location: ../cmty.php?cmty=".$cmtyName."&error=sqlError");
            exit();
        }
        else {
            // add comment
            $sql = 'INSERT INTO comments(author_id, post_id, description) VALUES(?, ?, ?)';
            $statement = mysqli_stmt_init($connection);
        
            if (!mysqli_stmt_prepare($statement, $sql)) {
                header("Location: ../cmty.php?cmty=".$cmtyName."&error=sqlError");
                exit();
            }
            else {
                mysqli_stmt_bind_param($statement, "sss", $authorID, $postID, $comment);
                mysqli_stmt_execute(($statement));

                // update posts
                $sql = 'UPDATE posts SET comments=comments + 1 WHERE id=?';
                $statement = mysqli_stmt_init($connection);
            
                if (!mysqli_stmt_prepare($statement, $sql)) {
                    header("Location: ../cmty.php?cmty=".$cmtyName."&error=sqlError");
                    exit();
                }
                else {
                    mysqli_stmt_bind_param($statement, "s", $postID);
                    mysqli_stmt_execute(($statement));
            
                    header("Location: ../cmty.php?cmty=".$cmtyName."&sucess=1");
                    exit();
                }
            }
        }
    }
    else {
        header("Location: ../cmty.php?cmty=".$cmtyName);
        exit();
    }


?>