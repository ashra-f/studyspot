<?php
//Include database connection
session_start();

if($_POST['rowid']) {
    require 'db_handler.php';
    $id = $_POST['rowid'];

    // Run the Query
    $sql = "SELECT comments FROM posts WHERE id=?";
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
            $numCmts = $row['comments'];
        }
    }
    ?>
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="commentModalLabel">
                        <div class="container" style="display: flex;">
                            <h4 style="margin: 0;">Comments</h4>
                            <h4 style="margin: 0; font-weight:400;"><?php echo str_repeat('&nbsp;', 2).$numCmts ?></h4>
                        </div>
                    </h1>
                    <button tabindex="-1" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Check if logged in, if they are, echo create comment form -->
                    <?php
                        if (isset($_SESSION['userID'])) { ?>
                            <form action="scripts/create-comment.php" method="POST" id="create-cmt" style="padding: 10px;">
                                <div class="mb-1" style="display: flex; align-items: center; justify-content: center;">
                                    <label for="commentBody" class="form-label"></label>
                                    <input type="hidden" name="postid" value="<?php echo $id ?>">
                                    <input type="text" name="cmt-body" class="form-control" id="commentBody" aria-describedby="emailHelp" placeholder="add a comment">
                                    <button type="submit" name="create-cmt-submit" class="btn btn-primary" style="margin-left: 6px; background-color: #00274C; border: none;">Post</button>
                                </div>
                            </form>
                    <?php    
                        }
                    ?>
                    <ul class="list-group">
    <?php

    $sql = 'SELECT * FROM comments WHERE post_id=?;';
    $statement = mysqli_stmt_init($connection);

    if (!mysqli_stmt_prepare($statement, $sql)) {
        header("Location: ../index.php?error=sqlError");
        exit();
    }
    else {
        mysqli_stmt_bind_param($statement, "s", $id);
        mysqli_stmt_execute(($statement));
        $results = mysqli_stmt_get_result($statement);
        $num_rows = mysqli_num_rows($results);

        if ($num_rows != 0) {
            while ($row = mysqli_fetch_array($results)) {
                $authorID = $row['author_id'];
                $descrip = $row['description'];
                $time = $row['created_at'];

                $sql = "SELECT username FROM users WHERE id=?";
                $statement = mysqli_stmt_init($connection);
            
                if (!mysqli_stmt_prepare($statement, $sql)) {
                    header("Location: ../index.php?error=sqlError");
                    exit();
                }
                else {
                    mysqli_stmt_bind_param($statement, "s", $authorID);
                    mysqli_stmt_execute(($statement));
            
                    $result = mysqli_stmt_get_result($statement);
                    if ($row1 = mysqli_fetch_assoc($result)) {
                        $author = $row1['username'];
                    }
                }

        ?>
                    <li class="list-group-item" style="border-radius:0;">
                        <div class="container" style="display: flex; padding: 10px; align-items: center;">
                            <p style="margin: 0; font-weight: bold; font-size: 17px;"><?php echo $author.str_repeat('&nbsp;', 1);?></p>
                            <p style="margin: 0; font-size: 17px;"><?php echo $descrip?></p> 
                        </div>
                        <div class="container" style="display: flex; padding: 10px; align-items: center;">
                            <p style="font-size: 12px; color: rgb(171, 171, 171);"><?php echo $time?></p>
                        </div>
                    </li>
        <?php
            }
        }
        else { ?>
            <li class="list-group-item">
                <div class="container" style="display: flex; padding: 10px; align-items: center;">
                    <p>There are no comments</p>
                </div>
            </li>
        <?php
        }
        ?>
        </ul>
    </div>
</div>
        <?php
    }
} else {
    header("Location: ../index.php?error=sqlError");
    exit();
}
?>



<!-- INSERT INTO `comments`(author_id, post_id, description) VALUES(26, 22, "blahblahblah"); -->