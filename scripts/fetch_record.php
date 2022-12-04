<?php
//Include database connection
if($_POST['rowid']) {
    require 'db_handler.php';
    $id = $_POST['rowid'];

    // Run the Query
    $sql = 'SELECT * FROM posts WHERE id=?;';
    $statement = mysqli_stmt_init($connection);

    if (!mysqli_stmt_prepare($statement, $sql)) {
        header("Location: ../index.php?error=sqlError");
        exit();
    }
    else {
        mysqli_stmt_bind_param($statement, "s", $id);
        mysqli_stmt_execute(($statement));

        $results = mysqli_stmt_get_result($statement);
        if ($row = mysqli_fetch_assoc($results)) {
            $author = $row['author'];
            $title = $row['title'];
            $cmtyName = $row['community_name'];
            $descrip = $row['descr'];
            $likes = $row['likes'];
            $dislikes = $row['dislikes'];
            $comments = $row['comments'];
            $timeDiff = date('m/d/Y h:i:s a', time()) - date("H:i:s",strtotime($row['created_at']));
            if ($timeDiff < 1) {
                 $age = 'just now';
            } 
            else {
                $age = $timeDiff.' hour(s) ago';
            }

            echo '
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="noteModalLabel">'.$title.'</h1>
                    <button tabindex="-1" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <small>'.$cmtyName.'</small>
                        <p>'.$descrip.'</p>
                        <small>'.$author.' • '.$age.'</small>
                        <button>'.$likes.'</button>
                        <button>'.$dislikes.'</button>
                        <div class="comments">
                            comments (scrollable):
                            <ul>
                                <li>
                                    username: comment
                                    <ul>
                                        <li>username: reply</li>
                                        <li>username: reply</li>
                                    </ul>
                                </li>
                                <li>username: comment</li>
                                <li>username: comment</li>
                            </ul>
                        </div>
                    </div>
                </div>					
                ';
        }
        else {
            header("Location: ../index.php?error=sqlError");
            exit();
        }
    }
 }
?>
