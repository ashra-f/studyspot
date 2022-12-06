<?php
    session_start();
	require 'db_handler.php';

    $userid = $_SESSION['userID'];
    $postid = $_POST['postid'];
    $type = $_POST['type'];
    
    $query = "SELECT COUNT(*) AS cntpost FROM like_unlike WHERE postid=".$postid." and userid=".$userid." GROUP BY id;";
    
    $result = mysqli_query($connection, $query);

    $fetchdata = mysqli_fetch_array($result);
    $count = $fetchdata['cntpost'];
    
    if($count == 0) {
        $insertquery = "INSERT INTO like_unlike(userid,postid,type) values(".$userid.",".$postid.",".$type.")";
        mysqli_query($connection, $insertquery);
    }
    else {
        $updatequery = "UPDATE like_unlike SET type=" . $type . " where userid=" . $userid . " and postid=" .$postid;
        mysqli_query($connection, $updatequery);
    }
    
    $query = "SELECT COUNT(*) AS cntLike FROM like_unlike WHERE type=1 and postid=".$postid." GROUP BY id;";
    $result = mysqli_query($connection, $query);
    $fetchlikes = mysqli_fetch_array($result);
    $totalLikes = $fetchlikes['cntLike'];
    
    $query = "SELECT COUNT(*) AS cntUnlike FROM like_unlike WHERE type=0 and postid=".$postid." GROUP BY id;";
    $result = mysqli_query($connection, $query);
    $fetchunlikes = mysqli_fetch_array($result);
    $totalUnlikes = $fetchunlikes['cntUnlike'];
    
    $return_arr = array("likes"=>$totalLikes,"unlikes"=>$totalUnlikes);

    // update post's likes and dislikes
    $sql = 'UPDATE posts SET likes=?, dislikes=? where id=?;';
    $statement = mysqli_stmt_init($connection);

    if (!mysqli_stmt_prepare($statement, $sql)) {
        header("Location: ../index.php?error=sqlError");
        exit();
    }
    else {
        mysqli_stmt_bind_param($statement, "sss", $totalLikes, $totalUnlikes, $postid);
        mysqli_stmt_execute(($statement));
    }
   
    echo json_encode($return_arr);
?>