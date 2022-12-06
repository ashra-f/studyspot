<!-- Handles all community pages -->
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
	require 'scripts/db_handler.php';
	readfile("scripts/header.php");
    $cmtyName = strtolower($_GET['cmty']);

    if (empty($cmtyName)) {
        header("Location: index.php");
        exit();
    }

    $sql = "SELECT * FROM communities WHERE cmty_name=?;";
    $statement = mysqli_stmt_init($connection);

    if (!mysqli_stmt_prepare($statement, $sql)) {
        header("Location: index.php");
        exit();
    }

    mysqli_stmt_bind_param($statement, "s", $cmtyName);
    mysqli_stmt_execute(($statement));
    $results = mysqli_stmt_get_result($statement);

    if ($row = mysqli_fetch_assoc($results)) {        
        $descr = $row['about'];
        $total_member_count = $row['member_count'];
        $total_post_count = $row['post_count'];
    }
    else {
        header("Location: ./index.php?error=noCmtyFound");
        exit();
    }

	// Check if the user is logged in or not
	if (!isset($_SESSION['userID'])) { 
		readfile("scripts/logged-out.php");
	} 
	else {
		?>
			<!-- USER IS LOGGED IN -->
			<!-- Sidebar -->
			<nav class="d-flex flex-column flex-shrink-0 bg-light my-navbar" style="width: 4.5rem;">
				<!-- studySpot Brand and Icon -->
				<a class="navbar-brand border-bottom" href="index.php">
					<div class="brand-wrapper">
						<img src="assets/imgs/study.png" alt="studySpot Logo" width="35" title="studySpot">
					</div>
				</a>
				<!-- Options: create post, create cmty, browse cmties, and help -->
				<ul class="nav nav-pills nav-flush flex-column mb-auto text-center">
					<li class="nav-item">
						<button tabindex="-1" onclick="location.href='create.php'" 
										type="button" class="btn material-symbols-outlined create-btn" 
										data-toggle="tooltip" data-placement="right" title="Create Post" id="createPostBtn">
								library_add
						</button>			
					</li>
					<li class="nav-item">
						<button tabindex="-1" data-bs-toggle="modal" data-bs-target="#cmtyModal" 
										type="button" class="btn material-symbols-outlined create-btn" 
										data-toggle="tooltip" data-placement="right" title="Create Community" id="createCmtyBtn">
							group_add
						</button>
					</li>
					<li class="nav-item">
						<!-- Log in btn trigger modal -->						  
						<button type="button" class="btn navbar-btn create-btn material-symbols-outlined"
										data-bs-toggle="modal" data-bs-target="#advancedsearch-modal"
										data-toggle="tooltip" data-placement="right" title="Search studySpot">
							search
						</button>	
					</li>
					<li class="nav-item">
						<button tabindex="-1" type="button" class="btn material-symbols-outlined create-btn"
										data-toggle="tooltip" data-placement="right" title="Help">
								help
						</button>
					</li>
				</ul>
				<!-- User settings, logout -->
				<div class="dropdown border-top user-settings">
					<a href="#" class="d-flex align-items-center justify-content-center p-3 link-dark text-decoration-none dropdown-toggle" id="dropdownUser3" data-bs-toggle="dropdown">        
						<img src="assets/imgs/homer.jpg" alt="mdo" width="24" height="24" class="rounded-circle">
					</a>
					<ul class="dropdown-menu text-small shadow settings-dropdown" aria-labelledby="dropdownUser3">
						<b style="margin-left: 15px;">Welcome <?php echo $_SESSION['username']; ?>!</b>
						<li><a class="dropdown-item" href="#">Profile</a></li>
						<li><a class="dropdown-item" href="#">Settings</a></li>
						<li><hr class="dropdown-divider"></li>
						<li>
							<form action="scripts/logout.php" class="logout-form" method="post">
								<button type="submit" class="dropdown-item logout-submit">Logout</button>
							</form>
						</li>
					</ul>
				</div>
			</nav>
<?php
	} 
?>

		<!-- Community PAGE:  -->
		<!-- Displays all the posts --> 
            <!-- Main Body -->
			<div class="container-fluid main-body">
				<!-- Body -->
				<div class="container body-wrapper">
					<!-- About the Cmty -->
					<div class="card text-center" id="cmty-card">
						<div class="card-header">
							<!-- Dropdown Cmty -->
							<div class="dropdown">
								<button class="btn dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false" style="background-color:#00274C; color:#FFCB05">
									<label style="font-size: 25px;"><?php echo $cmtyName ?></label> 
								</button>
								<ul class="dropdown-menu dropdown-menu" aria-labelledby="dropdownMenuButton2">
									<li>
										<a class="dropdown-item searching">								
											<form class="d-flex" role="search" method="GET" action="cmty.php">
												<button class="btn material-symbols-outlined" onclick="location.href='index.php'" id="takeMeHome">home</button>
												<input class="form-control me-2 search-bar" type="search" placeholder="community search" aria-label="Search" name="cmty" autocomplete="off">
											</form>
										</a>
									</li>
									<li><hr class="dropdown-divider"></li>
									<?php 
										// print out all communities
										$sql = 'SELECT * FROM communities;';
										$results = mysqli_query($connection, $sql);

										if (empty($results)) {
											echo '<li style="text-align:center;"><span>No Communities Found :(</span></li>';
										}
										else {
											while ($row = mysqli_fetch_array($results)) { 
												echo '<li><a class="dropdown-item" href="cmty.php?cmty='.$row['cmty_name'].'">'.$row['cmty_name'].'</a></li>';
												$cmtyID = $row['id'];
											}
										}
									?>
								</ul>
							</div>
							<!-- Search bar -->
							<div class="container" id="searchbar">
								<button type="button" class="btn navbar-btn create-btn material-symbols-outlined" 
												data-bs-toggle="modal" data-bs-target="#advancedsearch-modal"
												data-toggle="tooltip" data-placement="right" title="Advanced Search">
									search
								</button>      
								<!-- <button tabindex="-1" type="submit" class="btn material-symbols-outlined create-btn" title="Browse">search</button> -->
							</div>
						</div>
						<div class="card-body" style="display: flex; align-items: center; flex-direction: column;">
                            <h5 class="card-title">Welcome to <?php echo $cmtyName ?></h5>
							<p class="card-text" style="width: 60%;">
                                <?php echo $descr ?>
							</p>
							<?php
								if (isset($_SESSION['userID'])) {
									$currUsr = $_SESSION['userID'];
							?>
							<?php
									$sql = 'SELECT * FROM memberships WHERE community_id='.$cmtyID.';';
									$results = mysqli_query($connection, $sql);
									$found = 0;

									if (empty($results)) {
										
									}
									else {
										while ($row = mysqli_fetch_array($results)) { 
											if ($row['usr_id'] == $_SESSION['userID']) {
												
												echo '	<div style="display: flex;">
																<a href="#" class="btn" id="leave-btn" data-id="'.$currUsr.'" style="background-color:#FFCB05; color: #00274C;">Leave</a>;
																<button style="margin-left: 5px; color: #FFCB05; background-color: #00274C;" tabindex="-1" onclick="location.href=`create.php`" 
																		type="button" class="btn material-symbols-outlined" 
																		data-toggle="tooltip" data-placement="right" title="Create Post" id="createPostBtn"> library_add 
																</button>
															</div>';
												$found = 1;
											}
										}

										if ($found == 0) {
											echo '	<div style="display: flex;">
															<a href="#" class="btn" id="join-btn" data-id="'.$currUsr.'" style="background-color:#FFCB05; color: #00274C;">Join</a>
															<button style="margin-left: 5px; color: #FFCB05; background-color: #00274C;" tabindex="-1" onclick="location.href=`create.php`" 
																	type="button" class="btn material-symbols-outlined" 
																	data-toggle="tooltip" data-placement="right" title="Create Post" id="createPostBtn"> library_add 
															</button>
														</div>';
										}
									}
								}
								else {
									echo '<a href="#" class="btn" id="join-btn" data-id="'.$currUsr.'" style="background-color: #FFCB05; color: #00274C;" onclick="loginAlert()">Join</a>';
								}
							?>
						</div>
						<div class="card-footer text-muted">
							<?php
								if ($total_member_count == 1 && $total_post_count == 1) {
									echo $total_member_count.' Member • '.$total_post_count.' Post';
								}
								else if ($total_member_count == 1) {
									echo $total_member_count.' Member • '.$total_post_count.' Posts';
								}
								else if($total_post_count == 1) {
									echo $total_member_count.' Members • '.$total_post_count.' Post';
								}
								else {
									echo $total_member_count.' Members • '.$total_post_count.' Posts';
								}
							?>
						</div>
					</div>
				
				<!-- No Posts in Cmty -->
					<?php
						$query = "SELECT * FROM posts WHERE community_name=?;";
						if (!mysqli_stmt_prepare($statement, $query)) {
							header("Location: index.php?error=sqlError");
							exit();
						}
						mysqli_stmt_bind_param($statement, "s", $cmtyName);
						mysqli_stmt_execute(($statement));
						$result = mysqli_stmt_get_result($statement);

						$total_rows = mysqli_num_rows($result);
						if ($total_rows == 0) {
					?>
					<!-- Posts Section -->
					<div class="container-fluid posts-wrapper">
						<!-- Posts Content -->
						<div class="container-fluid posts-body">
							<div class="container posts-title">
								<label>Posts</label>
							</div>
							<!-- Bulletin Board -->
							<div class="container stickies-wrapper">
								<ul class="sticky-notes" style="display: flex; flex-direction: column;">
									<h5 style="text-align: center; margin-top: 10px;">Be the first to post!</h5>
									<br>
									<img src="assets/imgs/astronaut.png" alt="mdo" width="200" height="200">
								</ul>
							</div>	
						</div>
					</div>
					<?php
						}
						else {
					?>

					<!-- Top Posts Section -->
					<div class="container-fluid posts-wrapper" id="top-posts">
						<!-- Top Posts Content -->
						<div class="container-fluid posts-body">
							<div class="container posts-title">
								<label>Top Posts</label>
							</div>
							<!-- Bulletin Board -->
							<div class="container stickies-wrapper">
								<!-- Get all posts from DB -->
								<ul class="sticky-notes">
									<?php
                                        $query = "SELECT * FROM posts WHERE community_name=?;";
										$methodType = 0;

                                        if (!mysqli_stmt_prepare($statement, $query)) {
                                            header("Location: index.php?error=sqlError");
                                            exit();
                                        }

                                        mysqli_stmt_bind_param($statement, "s", $cmtyName);
                                        mysqli_stmt_execute(($statement));
                                        $result = mysqli_stmt_get_result($statement);

										while($row = mysqli_fetch_array($result)) {
											$methodType = $methodType % 3;
											$title = $row['title'];
											$type = -1;
											//$cmtyID = $row['community_id'];
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
										<li>
											<a class="sticky-note">
												<div class="sticky-note-info">
													<small><?php echo $cmtyName?></small>
													<btn class="bi bi-arrows-angle-expand" data-id='<?php echo $postid?>' data-method='<?php echo $methodType?>' data-bs-toggle="modal" data-bs-target="#noteModal"></btn>
												</div>
												<div class="sticky-note-title">
													<h6><?php echo $title?></h6>
												</div>
												<div class="sticky-note-info">
													<small><?php echo $username?> • <?php echo $timeDiff;?></small> 
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
														<button tabindex="-1" class="bi bi-chat-left-text interaction-btn" data-id='<?php echo $postid?>' data-bs-toggle="modal" data-bs-target="#commentModal">
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
														<button tabindex="-1" class="bi bi-chat-left-text interaction-btn" data-id='<?php echo $postid?>' data-bs-toggle="modal" data-bs-target="#commentModal">
															<span class="comment-count"><?php echo ' '.$comments?></span>
														</button>
													</div>
												<?php } ?>
											</a>
										</li>
									<?php
										$methodType++;
										}
									?>
								</ul>
							</div>	
						</div>
					</div>

					<!-- All Posts Section -->
					<div class="container-fluid posts-wrapper" id="all-posts">
						<!-- All Posts Content -->
						<div class="container-fluid posts-body">
							<div class="container posts-title">
								<label>All Posts</label>
							</div>
							<!-- All Posts Section Posts-->
							<div class="container all-posts-wrapper">
								<ul class="list-group all-posts">
									<?php
                                        $userid = $_SESSION['userID'];
                                        $query = "SELECT * FROM posts WHERE community_name=?;";

                                        if (!mysqli_stmt_prepare($statement, $query)) {
                                            header("Location: index.php?error=sqlError");
                                            exit();
                                        }

                                        mysqli_stmt_bind_param($statement, "s", $cmtyName);
                                        mysqli_stmt_execute(($statement));

                                        $result = mysqli_stmt_get_result($statement);
										while($row = mysqli_fetch_array($result)) {
											$title = $row['title'];
											$type = -1;
											//$cmtyID = $row['community_id'];
											$description = $row['descr'];
											$cmtyName = $row['community_name'];
											$username = $row['author'];
											$timeDiff = time_elapsed_string($row['created_at']); //date('m/d/Y h:i:s a', time()) - 
											$comments = $row['comments'];
											$postid = $row['id'];
						
											if (isset($_SESSION['userID'])) {
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
														<small><?php echo $cmtyName.' • Post by '.$username?> • <?php echo $timeDiff;?></small> 
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
														<button tabindex="-1" class="bi bi-chat-left-text interaction-btn" data-id='<?php echo $postid?>' data-bs-toggle="modal" data-bs-target="#commentModal">
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
														<button tabindex="-1" class="bi bi-chat-left-text interaction-btn" data-id='<?php echo $postid?>' data-bs-toggle="modal" data-bs-target="#commentModal">
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

								<nav class="nav-pager container-fluid" aria-label="Page navigation example">
									<ul class="pagination justify-content-center container-fluid m-0 p-0">
										<li class="page-item">
											<a class="page-link" href="#" aria-label="Previous">
												<span aria-hidden="true">&laquo;</span>
												<span class="sr-only"></span>
											</a>
										</li>
										<li class="page-item">
											<a class="page-link" href="#">1</a>
										</li>
										<li class="page-item">
											<a class="page-link" href="#">2</a>
										</li>
										<li class="page-item">
											<a class="page-link" href="#">3</a>
										</li>
										<li class="page-item">
											<a class="page-link" href="#" aria-label="Next">
												<span aria-hidden="true">&raquo;</span>
												<span class="sr-only"></span>
											</a>
										</li>
									</ul>
								</nav>
							</div>	
						</div>
					</div>

					<?php
					}
					?>
				</div>

				<!-- Footer -->
				<div class="container footer-wrapper">
					<footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top" id="footer">					
						<a href="/" class="col-md-4 d-flex align-items-center justify-content-center mb-3 link-dark text-decoration-none" id="title-img">
							<img src="assets/imgs/study.png" alt="" width="40">
						</a>
						<p class="col-md-4 mb-0" style="color: #00274C; text-align: center;">&copy; 2022 studySpot, Inc</p>
					</footer>
				</div>
			</div>

			<!-- Modals -->
			<!-- Sticky Note Modal -->
			<div class="modal fade" id="noteModal" tabindex="-1" aria-labelledby="noteModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered fetched-data" style="width: 450px; height: 400px;">
				</div>
			</div>
			
			<!-- Create Comment Modal -->
			<div class="modal fade" id="commentModal" tabindex="-1" aria-labelledby="commentModalLabel" aria-hidden="true">
				<div class="modal-dialog fetch-comments">
				</div>
			</div>

			<!-- Create Community Modal -->
			<div class="modal fade" id="cmtyModal" tabindex="-1" aria-labelledby="cmtyModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h1 class="modal-title fs-5" id="cmtyModalLabel">Add a Community</h1>
							<button tabindex="-1" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<form method="post" action="scripts/create-cmty.php">
								<div class="form-body" style="padding: 15px;">
									<!-- Cmty info -->
									<div class="form-group">
										<div class="form-group input-field">
											<label for="inputFirstName">Community Name:</label>
											<input type="text" class="form-control" id="inputCmtyName" name="cmtyName" placeholder="">
										</div>
										<div class="form-group input-field">
											<label for="inputLastName">About the Community:</label>
											<textarea class="form-control" id="inputAbtCmty" name="aboutCmty" placeholder=""></textarea>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<button tabindex="-1" type="submit" name="create-cmty-submit" class="btn btn-primary">Create</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>

			<!-- Advanced Search Modal -->
			<div class="modal fade" id="advancedsearch-modal" tabindex="-1" aria-labelledby="advancedsearchLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="advancedsearch-modalLabel">Advanced Search</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<!-- Main Body -->
							<div class="container-fluid signup-container" style="padding-bottom: 0;">
								<form method="post" action="search.php" class="login-form">
									<div class="form-body">
										<!-- Query info -->
										<div class="form-group">
											
										<div class="form-group input-field">
												<label for="categoryToLookInto">Community to look in: * </label>
												<input type="text" class="form-control" name="categoryToLookInto" id="categoryToLookInto" placeholder="">
											</div>
											<div class="form-group input-field">
												<label for="inputInclude4">Words to include in the title: </label>
												<input type="text" class="form-control" name="wordsToInclude" id="inputInclude4" placeholder="">
											</div>
											<div class="form-group input-field">
												<label for="inputPassword4">Words to exclude in the title: </label>
												<input type="text" class="form-control" name="wordsToExclude" id="inputExclude4" placeholder="">
											</div>
											<div class="form-group input-field">
												<label for="inputPassword4">Select Posts after: </label>
												<input type="date" class="form-control" name="postsAfterDate" id="inputExclude4" placeholder="">
											</div>
										</div>
									</div>
									<div class="modal-footer" style="margin-top: 20px;">
										<button type="submit" class="btn btn-primary" name="advancedsearch-submit">Search posts</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>   

        </div>
	</body>
</html>