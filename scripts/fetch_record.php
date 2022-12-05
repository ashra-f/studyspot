<?php
//Include database connection
session_start();

if($_POST['rowid']) {
    require 'db_handler.php';
    $id = $_POST['rowid'];
    if (isset($_POST['bgcolor'])) {
        $bgcolor = $_POST['bgcolor'];
    }
    else {
        $bgcolor = 'aaf0c5';
    }


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
            $age;
            $interactions;
            $title = $row['title'];
            $cmtyName = $row['community_name'];
            $descrip = $row['descr'];
            $likes = $row['likes'];
            $dislikes = $row['dislikes'];
            $comments = $row['comments'];
            $timeDiff = date("H:i:s",strtotime($row['created_at'])); //date('m/d/Y h:i:s a', time()) - 
            if ($timeDiff < 1) {
                 $age = 'just now';
            } 
            else {
                $age = $timeDiff.' hour(s) ago';
            }

            if (isset($_SESSION['userID'])) {
                $userid = $_SESSION['userID'];
                $status_query = "SELECT count(*) as cntStatus,type FROM like_unlike WHERE userid=".$userid." and postid=".$id;
                $status_result = mysqli_query($connection,$status_query);
                $status_row = mysqli_fetch_array($status_result);
                $count_status = $status_row['cntStatus'];

                if($count_status > 0){
                    $type = $status_row['type'];
                }

                $like_query = "SELECT COUNT(*) AS cntLikes FROM like_unlike WHERE type=1 and postid=".$id;
                $like_result = mysqli_query($connection,$like_query);
                $like_row = mysqli_fetch_array($like_result);
                $total_likes = $like_row['cntLikes'];

                $unlike_query = "SELECT COUNT(*) AS cntUnlikes FROM like_unlike WHERE type=0 and postid=".$id;
                $unlike_result = mysqli_query($connection,$unlike_query);
                $unlike_row = mysqli_fetch_array($unlike_result);
                $total_unlikes = $unlike_row['cntUnlikes'];
            
                ?>
                <div class="modal-content" style="width: 100%; height: 400px; padding: 15px; border-radius: 5px; background-color: <?php echo $bgcolor; ?>;">
                    <div class="modal-header border-0">
                        <h1 class="modal-title fs-5" id="noteModalLabel"><?php echo $title ?></h1>
                        <button tabindex="-1" type="button" class="btn material-symbols-outlined" data-bs-dismiss="modal">close_fullscreen</button>
                    </div>
                    <div class="modal-body">
                        <div class="container" style="padding-left: 15px;">
                            <div id="descrip"><?php echo $descrip ?></div>
                            <p style="font-size: 12px;"> <?php echo $cmtyName.' • '.$author.' • '.$age ?></p>
                            <div class="interactions">
                                <button tabindex="-1" class="bi bi-hand-thumbs-up interaction-btn like like_<?php echo $postid; ?>" id="like_<?php echo $postid; ?>">
                                    <span class="like-count likes_<?php echo $postid; ?>" id="likes_<?php echo $postid; ?>"><?php echo $total_likes; ?></span>
                                </button>
                                <button tabindex="-1" class="bi bi-hand-thumbs-down interaction-btn unlike unlike_<?php echo $postid; ?>" id="unlike_<?php echo $postid; ?>">
                                        <span class="dislike-count unlikes_<?php echo $postid; ?>" id="unlikes_<?php echo $postid; ?>"><?php echo $total_unlikes; ?></span>
                                </button>
                                <button tabindex="-1" class="bi bi-chat-left-text interaction-btn">
                                    <span class="comment-count"><?php echo ' '.$comments;?></span>
                                </button>
                            </div>  
                        </div> 
                    </div>
                </div>
                <?php     
            }
            else { ?>
            <div class="modal-content" style="width: 100%; height: 400px; padding: 15px; border-radius: 5px; background-color:<?php echo $bgcolor;?>">
                <div class="modal-header border-0">
                    <h1 class="modal-title fs-5" id="noteModalLabel">'<?php echo $title ?></h1>
                    <button tabindex="-1" type="button" class="btn material-symbols-outlined" data-bs-dismiss="modal">close_fullscreen</button>
                </div>
                <div class="modal-body">
                    <div class="container" style="padding-left: 15px;">
                        <div id="descrip"><?php echo $descrip ?></div>
                        <p style="font-size: 12px;"><?php echo $cmtyName.' • '.$author.' • '.$age ?></p>
                        <div class="interactions">
                            <button tabindex="-1" class="bi bi-hand-thumbs-up interaction-btn" onclick="loginAlert()">
                                <span class="like-count"><?php echo $likes; ?></span>
                            </button>
                            <button tabindex="-1" class="bi bi-hand-thumbs-down interaction-btn" onclick="loginAlert()">
                                    <span class="dislike-count"><?php echo $dislikes; ?></span>
                            </button>
                            <button tabindex="-1" class="bi bi-chat-left-text interaction-btn" onclick="loginAlert()">
                                <span class="comment-count"><?php echo $comments?></span>
                            </button>
                        </div>
                    </div>
                </div>		
            </div>		               
                
        <?php 
            }
        }
    }

} else {
    header("Location: ../index.php?error=sqlError");
    exit();
}
?>
