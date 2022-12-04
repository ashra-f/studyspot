<?php
//Include database connection
if($_POST['rowid']) {
    require 'db_handler.php';
    $id = $_POST['rowid'];
    $bgcolor = $_POST['bgcolor'];

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
                <div class="modal-content" style="width: 100%; height: 400px; padding: 15px; border-radius: 5px; background-color:'.$bgcolor.';">
                    <div class="modal-header border-0">
                        <h1 class="modal-title fs-5" id="noteModalLabel">'.$title.'</h1>
                        <button tabindex="-1" type="button" class="btn material-symbols-outlined" data-bs-dismiss="modal">close_fullscreen</button>
                    </div>
                    <div class="modal-body">
                        <div class="container" style="padding-left: 15px;">
                            <div id="descrip">'.$descrip.'</div>
                            <p style="font-size: 12px;">'.$cmtyName.' • '.$author.' • '.$age.'</p>
                            <div class="interactions">
                                <button tabindex="-1" class="bi bi-hand-thumbs-up interaction-btn like">
                                    <span class="like-count">'.$likes.'</span>
                                </button>
                                <button tabindex="-1" class="bi bi-hand-thumbs-down interaction-btn unlike">
                                        <span class="dislike-count">'.$dislikes.'</span>
                                </button>
                                <button tabindex="-1" class="bi bi-chat-left-text interaction-btn">
                                    <span class="comment-count">'.$comments.'</span>
                                </button>
                            </div>
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
