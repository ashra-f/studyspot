<?php
date_default_timezone_set('America/Detroit');
function time_elapsed_string($datetime, $full = false) {
	$seconds_ago = (time() - strtotime($datetime));

	if ($seconds_ago >= 31536000) {
		return intval($seconds_ago / 31536000) . " years ago";
	} elseif ($seconds_ago >= 2419200) {
		return intval($seconds_ago / 2419200) . " months ago";
	} elseif ($seconds_ago >= 86400) {
		return intval($seconds_ago / 86400) . " days ago";
	} elseif ($seconds_ago >= 3600) {
		return intval($seconds_ago / 3600) . " hours ago";
	} elseif ($seconds_ago >= 60) {
		return intval($seconds_ago / 60) . " minutes ago";
	} else {
		return "just now";
	}
}

?>
<?php 
	session_start();
	readfile("scripts/header.php");

	if (!isset($_SESSION['userID'])) { 
		readfile("scripts/logged-out-search.php");
	} 
	else {
		readfile("scripts/logged-in-search.php");
	} 

        if (isset($_POST['advancedsearch-submit'])) {
            
            require 'scripts/db_handler.php';

            $categoryToLookInto = $_POST['categoryToLookInto'];
            $wordsToInclude = $_POST['wordsToInclude'];
            $wordsToExclude = $_POST['wordsToExclude'];
            $postsAfterDate = $_POST['postsAfterDate'];
        
            if (empty($categoryToLookInto)) {
                header("Location: index.php?error=emptyCategory");
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

                
                        ?>
                <div class="container-fluid main-body" >
                <div class="container body-wrapper">
                        <!-- All Posts Section -->
					<div class="container-fluid posts-wrapper" id="all-posts">
						<!-- All Posts Content -->
						<div class="container-fluid posts-body">
							<div class="container posts-title">
								<label>Posts searched for</label>
							</div>
							<!-- All Posts Section Posts-->
							<div class="container all-posts-wrapper">
								<ul class="list-group all-posts">
									<?php
										
										$result = mysqli_query($connection, $sql);
										while($row = mysqli_fetch_array($result)) {
											$title = $row['title'];
											$type = -1;
											$description = $row['descr'];
											$cmtyName = $row['community_name'];
											$username = $row['author'];
											$timeDiff = time_elapsed_string($row['created_at']); //date('m/d/Y h:i:s a', time()) - 
											$comments = $row['comments'];
											$postid = $row['id'];
						
											if (isset($_SESSION['userID'])) {
												$userid = $_SESSION['userID'];
												$status_query = "SELECT count(*) as cntStatus,type FROM like_unlike WHERE userid=".$userid." and postid=".$postid." GROUP BY id;";
												$status_result = mysqli_query($connection,$status_query);
												$status_row = mysqli_fetch_array($status_result);
												$count_status = $status_row['cntStatus'];

												if($count_status > 0){
													$type = $status_row['type'];
												}
							
												$like_query = "SELECT COUNT(*) AS cntLikes FROM like_unlike WHERE type=1 and postid=".$postid;
												$like_result = mysqli_query($connection,$like_query);
												$like_row = mysqli_fetch_array($like_result);
												$total_likes = $like_row['cntLikes'];
							
												$unlike_query = "SELECT COUNT(*) AS cntUnlikes FROM like_unlike WHERE type=0 and postid=".$postid;
												$unlike_result = mysqli_query($connection,$unlike_query);
												$unlike_row = mysqli_fetch_array($unlike_result);
												$total_unlikes = $unlike_row['cntUnlikes'];
											}
						
									?>
										<li class="list-group-item post-item">
											<a class="sticky-note" style="text-decoration: none; color: black;">
												<div class="post">
													<div class="post-title">
														<h5>
															<btn data-id='<?php echo $postid?>' data-method='<?php echo $methodType?>' data-bs-toggle="modal" style="cursor: pointer;" data-bs-target="#noteModal"><?php echo $title?></btn>
														</h5>
													</div>
													<div class="poster-info">
														<small><?php echo $cmtyName.' • Post by '.$username?> • <?php echo $timeDiff; ?></small> 
													</div>
												</div>
												<?php
														if (!isset($_SESSION['userID'])) {
															// get likes and dislikes for each post
															$sql = 'SELECT * FROM posts where community_name=?;';
															$statement = mysqli_stmt_init($connection);

															if (!mysqli_stmt_prepare($statement, $sql)) {
																header("Location: index.php?error=sqlError");
																exit();
															}
															else {
																mysqli_stmt_bind_param($statement, "s", $cmtyName);
																mysqli_stmt_execute(($statement));
											
																$results = mysqli_stmt_get_result($statement);
											
																if ($row = mysqli_fetch_assoc($results)) {
																	$likes = $row['likes'];
																	$dislikes = $row['dislikes'];
																	$comments = $row['comments'];
																}
																else {
																	header("Location: index.php?error=sqlError");
																	exit();
																}
															}
													?>
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
													<?php
														}
														else {
													?>
													<div class="interactions">
														<button tabindex="-1" class="bi bi-hand-thumbs-up interaction-btn like like_<?php echo $postid; ?>" id="like_<?php echo $postid; ?>">
															<span class="like-count likes_<?php echo $postid; ?>" id="likes_<?php echo $postid; ?>"><?php echo $total_likes; ?></span>
														</button>
														<button tabindex="-1" class="bi bi-hand-thumbs-down interaction-btn unlike unlike_<?php echo $postid; ?>" id="unlike_<?php echo $postid; ?>">
																<span class="dislike-count unlikes_<?php echo $postid; ?>" id="unlikes_<?php echo $postid; ?>"><?php echo $total_unlikes; ?></span>
														</button>
														<button tabindex="-1" class="bi bi-chat-left-text interaction-btn">
															<span class="comment-count"><?php echo ' '.$comments?></span>
														</button>
													</div>
												<?php } ?>
											</a>
										</li>
									<?php
										}
									?>
								</ul>
							</div>	
						</div>
                        </div>
					</div>
                    </div>
            <!-- Modals -->
			<!-- Sticky Note Modal -->
			<div class="modal fade" id="noteModal" tabindex="-1" aria-labelledby="noteModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered fetched-data" style="width: 450px; height: 400px;">
				</div>
			</div>
                        <?php

                    
            }
        }
        
        else {
            header("Location: ../index.php");
            exit();
        }
?>