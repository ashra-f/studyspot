            <?php 
                session_start();
                readfile("scripts/header.php");
            ?>

            <!-- Check if the user is logged in or not -->
            <?php if (!isset($_SESSION['userID'])){ ?>
                <!-- USER IS NOT LOGGED IN -->
                <!-- Navbar -->
                <nav class="d-flex flex-column flex-shrink-0 bg-light my-navbar" style="width: 4.5rem;">
                    <!-- studySpot Brand and Icon -->
                    <a class="navbar-brand border-bottom" href="index.php">
                        <div class="brand-wrapper">
                            <img src="assets/imgs/study.png" alt="studySpot Logo" width="35" title="studySpot">
                        </div>
                    </a>
                    <!-- Options -->
                    <ul class="nav nav-pills nav-flush flex-column mb-auto text-center">
                        <li class="nav-item">
                            <!-- Log in btn trigger modal -->						  
                            <button type="button" class="btn navbar-btn create-btn material-symbols-outlined"
                                            data-bs-toggle="modal" data-bs-target="#login-modal"
                                            data-toggle="tooltip" data-placement="right" title="Login">
                                Login
                            </button>	
                        </li>
                        <li class="nav-item">
                            <!-- Sign up btn trigger modal -->
                            <button type="button" class="btn navbar-btn create-btn material-symbols-outlined" 
                                            data-bs-toggle="modal" data-bs-target="#signup-modal"
                                            data-toggle="tooltip" data-placement="right" title="Sign Up">
                                person_add
                            </button>      
                        </li>
                        <li class="nav-item">
                            <button tabindex="-1" type="button" class="btn material-symbols-outlined create-btn" 
                                            data-toggle="tooltip" data-placement="right" title="Browse Communities">
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
                </nav>
                
                <!-- MODALS -->
                <!-- Sticky Note Modal -->
                <div class="modal fade" id="noteModal" tabindex="-1" aria-labelledby="noteModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="noteModalLabel">Title of the post</h1>
                                <button tabindex="-1" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="container">
                                    <small>what community?</small>
                                    <p>
                                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ut alias fugit,
                                            dignissimos fugiat atque quos minus, nobis, eius laboriosam perspiciatis 
                                            rerum quaerat in voluptatum maxime eligendi hic libero officia nemo.
                                    </p>
                                    <small>username • datetime</small>
                                    <button>Likes</button>
                                    <button>Disikes</button>
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
                            <div class="modal-footer">
                                <button tabindex="-1" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sign up Modal -->
                <div class="modal fade" id="signup-modal" tabindex="-1" aria-labelledby="signup-modalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="signup-modalLabel">Sign Up</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Main Body -->
                                <div class="container-fluid signup-container" style="padding-bottom: 0;">
                                    <?php
                                        if (isset($_GET['error'])) {
                                            if ($_GET['error'] == "emptyFields") {
                                                echo '<p class="signuperror" style="color: red">Fill in all fields!</p>';
                                            }
                                        }
                                    ?>
                                    <form class="signup-form" method="post" action="scripts/signup.php">
                                        <div class="form-body">
                                            <!-- User info -->
                                            <div class="form-group">
                                                <div class="form-group input-field">
                                                    <label for="inputUserName">Username:</label>
                                                    <input type="text" class="form-control" name="username" for="inputUserName" placeholder="">
                                                </div>
                                                <div class="form-group input-field">
                                                    <label for="inputEmail4">Email:</label>
                                                    <input type="email" class="form-control" name="mail" for="inputEmail4" placeholder="">
                                                </div>
                                                <div class="form-group input-field">
                                                    <label for="inputPassword4">Password:</label>
                                                    <input type="password" class="form-control" name="password" for="inputPassword4" placeholder="">
                                                </div>
                                                <div class="form-group input-field">
                                                    <label for="inputPassword5">Confirm Password:</label>
                                                    <input type="password" class="form-control" name="password-repeat" for="inputPassword5" placeholder="">
                                                </div>
                                                <!-- Profile photo -->
                                                <div class="form-group input-field">
                                                    <label for="file-upload">
                                                        Upload a profile picture: 
                                                    </label>
                                                    <br>
                                                    <input type="file" name="photo" accept="image/png, image/jpeg, image/jpg">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer" style="margin-top: 10px;">
                                            <button type="submit" class="btn btn-primary" name="signup-submit">Sign up</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Login in Modal -->
                <div class="modal fade" id="login-modal" tabindex="-1" aria-labelledby="login-modalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="signup-modalLabel">Login</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Main Body -->
                                <div class="container-fluid signup-container" style="padding-bottom: 0;">
                                    <form method="post" action="scripts/login.php" class="login-form">
                                        <div class="form-body">
                                            <!-- User info -->
                                            <div class="form-group">
                                                <div class="form-group input-field">
                                                    <label for="input4">Email or Username:</label>
                                                    <input type="text" class="form-control" name="mailUsername" id="input4" placeholder="">
                                                </div>
                                                <div class="form-group input-field">
                                                    <label for="inputPassword4">Password:</label>
                                                    <input type="password" class="form-control" name="pwd" id="inputPassword4" placeholder="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer" style="margin-top: 20px;">
                                            <button type="submit" class="btn btn-primary" name="login-submit">Log in</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>    
            <?php } else { ?>
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
                            <button tabindex="-1" type="button" class="btn material-symbols-outlined create-btn" 
                                            data-toggle="tooltip" data-placement="right" title="Browse">
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
                            <li><a class="dropdown-item" href="#">Settings</a></li>
                            <li><a class="dropdown-item" href="#">Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="scripts/logout.php" class="logout-form" method="post">
                                    <button type="submit" class="dropdown-item logout-submit">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </nav>

                <!-- Sticky Note Modal -->
                <div class="modal fade" id="noteModal" tabindex="-1" aria-labelledby="noteModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="noteModalLabel">Title of the post</h1>
                                <button tabindex="-1" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="container">
                                    <small>what community?</small>
                                    <p>
                                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ut alias fugit,
                                            dignissimos fugiat atque quos minus, nobis, eius laboriosam perspiciatis 
                                            rerum quaerat in voluptatum maxime eligendi hic libero officia nemo.
                                    </p>
                                    <small>username • datetime</small>
                                    <button>Likes</button>
                                    <button>Disikes</button>
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
                            <div class="modal-footer">
                                <button tabindex="-1" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
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
                                <form method="post" action="">
                                    <div class="form-body" style="padding: 15px;">
                                        <!-- Cmty info -->
                                        <div class="form-group">
                                            <div class="form-group input-field">
                                                <label for="inputFirstName">Community Name:</label>
                                                <input type="text" class="form-control" id="inputCmtyName" placeholder="">
                                            </div>
                                            <div class="form-group input-field">
                                                <label for="inputLastName">About the Community:</label>
                                                <textarea class="form-control" id="inputAbtCmty" placeholder=""></textarea>
                                            </div>
                                            <!-- Profile photo -->
                                            <div class="form-group input-field">
                                                <label for="file-upload" class="custom-file">
                                                    <i class="bi bi-upload"></i>
                                                    Upload an image
                                                </label>
                                                <input type="file" class="form-control-file" accept="image/png, image/jpeg, image/jpg">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button tabindex="-1" type="button" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>

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
									<label style="font-size: 25px;">CompSci</label> 
								</button>
								<ul class="dropdown-menu dropdown-menu" aria-labelledby="dropdownMenuButton2">
									<li>
										<a class="dropdown-item" href="#">								
											<form class="d-flex" role="search" method="POST" action="">
												<input class="form-control me-2 search-bar" type="search" placeholder="Search studySpot" aria-label="Search">
											</form>
										</a>
									</li>
									<li><hr class="dropdown-divider"></li>
									<li><a class="dropdown-item" href="#">Chemistry</a></li>
									<li><a class="dropdown-item" href="#">Bio</a></li>
									<li><a class="dropdown-item" href="#">Maths</a></li>
								</ul>
							</div>
							<!-- Search bar -->
							<div class="container" id="searchbar">
								<button tabindex="-1" type="submit" class="btn material-symbols-outlined create-btn" title="Browse">search</button>
								<!-- <form class="d-flex" role="search" method="POST" action="">
									<input class="form-control me-2 search-bar" type="search" placeholder="Search studySpot" aria-label="Search">
								</form> -->
							</div>
						</div>
						<div class="card-body">
							<h5 class="card-title">About CompSci</h5>
							<p class="card-text">
								Lorem ipsum dolor sit amet consectetur adipisicing elit. 
								Vel repellat quos quidem commodi excepturi hic! Beatae, necessitatibus enim 
								possimus saepe quasi consectetur nobis? Veniam obcaecati voluptatem minima soluta, ut aliquid?
							</p>
							<a href="#" class="btn" id="join-btn">Join</a>
						</div>
						<div class="card-footer text-muted">
							50 Members • 32 Posts
						</div>
					</div>
					<!-- Top Posts Section -->
					<div class="container-fluid posts-wrapper" id="top-posts">
						<!-- Top Posts Content -->
						<div class="container-fluid posts-body">
							<div class="container" id="posts-title">
								<label>Top Posts</label>
							</div>
							<!-- Bulletin Board -->
							<div class="container" id="stickies-wrapper">
								<ul class="sticky-notes">
									<li>
										<a class="sticky-note">
											<div class="sticky-note-info">
												<small>UMD</small>
												<btn class="bi bi-arrows-angle-expand" data-bs-toggle="modal" data-bs-target="#noteModal"></btn>
											</div>
											<div class="sticky-note-title">
												<h6>Best Spot to Study at CASL?</h6>
											</div>
											<div class="sticky-note-info">
												<small>FLYING_4 • 11 hours ago</small> 
											</div>
											<div class="interactions">
												<button tabindex="-1" class="bi bi-hand-thumbs-up interaction-btn">
													<span class="like-count">&nbsp;16</span>
												</button>
												<button tabindex="-1" class="bi bi-hand-thumbs-down interaction-btn">
													<span class="dislike-count">&nbsp;3</span>
												</button>
												<button tabindex="-1" class="bi bi-chat-left-text interaction-btn">
													<span class="comment-count">&nbsp;20</span>
												</button>
											</div>
										</a>
									</li>
									<li>
										<a class="sticky-note">
											<div class="sticky-note-info">
												<small>CompSci</small>
												<btn class="bi bi-arrows-angle-expand" data-bs-toggle="modal" data-bs-target="#noteModal"></btn>
											</div>
											<div class="sticky-note-title">
												<h6>Does anyone wanna team up for CIS 427?Does anyone wanna team up for CIS 427?Does anyone wanna team up for CIS 427?Does anyone wanna team up for CIS 427?</h6>
											</div>
											<div class="sticky-note-info">
												<small>edwad2 • 5 hours ago</small> 
											</div>
											<div class="interactions">
												<button tabindex="-1" class="bi bi-hand-thumbs-up interaction-btn">
													<span class="like-count">&nbsp;16</span>
												</button>
												<button tabindex="-1" class="bi bi-hand-thumbs-down interaction-btn">
													<span class="dislike-count">&nbsp;3</span>
												</button>
												<button tabindex="-1" class="bi bi-chat-left-text interaction-btn">
													<span class="comment-count">&nbsp;20</span>
												</button>
											</div>
										</a>
									</li>
									<li>
										<a class="sticky-note">
											<div class="sticky-note-info">
												<small>Biology</small>
												<btn class="bi bi-arrows-angle-expand" data-bs-toggle="modal" data-bs-target="#noteModal"></btn>
											</div>
											<div class="sticky-note-title">
												<h6>Any good electives to take?</h6>
											</div>
											<div class="sticky-note-info">
												<small>youngwizard3 • 2 hours ago</small> 
											</div>
											<div class="interactions">
												<button tabindex="-1" class="bi bi-hand-thumbs-up interaction-btn">
													<span class="like-count">&nbsp;16</span>
												</button>
												<button tabindex="-1" class="bi bi-hand-thumbs-down interaction-btn">
													<span class="dislike-count">&nbsp;3</span>
												</button>
												<button tabindex="-1" class="bi bi-chat-left-text interaction-btn">
													<span class="comment-count">&nbsp;20</span>
												</button>
											</div>
										</a>
									</li>
									<li>
										<a class="sticky-note">
											<div class="sticky-note-info">
												<small>Chemistry</small>
												<btn class="bi bi-arrows-angle-expand" data-bs-toggle="modal" data-bs-target="#noteModal"></btn>
											</div>
											<div class="sticky-note-title">
												<h6>Incoming Freshman | Are the Classes Difficult Here?</h6>
											</div>
											<div class="sticky-note-info">
												<small>thinkingishard • 15 hours ago</small> 
											</div>
											<div class="interactions">
												<button tabindex="-1" class="bi bi-hand-thumbs-up interaction-btn">
													<span class="like-count">&nbsp;16</span>
												</button>
												<button tabindex="-1" class="bi bi-hand-thumbs-down interaction-btn">
													<span class="dislike-count">&nbsp;3</span>
												</button>
												<button tabindex="-1" class="bi bi-chat-left-text interaction-btn">
													<span class="comment-count">&nbsp;20</span>
												</button>
											</div>
										</a>
									</li>
									<li>
										<a class="sticky-note">
											<div class="sticky-note-info">
												<small>UMD</small>
												<btn class="bi bi-arrows-angle-expand" data-bs-toggle="modal" data-bs-target="#noteModal"></btn>
											</div>
											<div class="sticky-note-title">
												<h6>Best Spot to Study at CASL?</h6>
											</div>
											<div class="sticky-note-info">
												<small>FLYING_4 • 11 hours ago</small> 
											</div>
											<div class="interactions">
												<button tabindex="-1" class="bi bi-hand-thumbs-up interaction-btn">
													<span class="like-count">&nbsp;16</span>
												</button>
												<button tabindex="-1" class="bi bi-hand-thumbs-down interaction-btn">
													<span class="dislike-count">&nbsp;3</span>
												</button>
												<button tabindex="-1" class="bi bi-chat-left-text interaction-btn">
													<span class="comment-count">&nbsp;20</span>
												</button>
											</div>
										</a>
									</li>
									<li>
										<a class="sticky-note">
											<div class="sticky-note-info">
												<small>Psychology</small>
												<btn class="bi bi-arrows-angle-expand" data-bs-toggle="modal" data-bs-target="#noteModal"></btn>
											</div>
											<div class="sticky-note-title">
												<h6>New Psychology Professor at UMD. AMA!</h6>
											</div>
											<div class="sticky-note-info">
												<small>profsunshine • 22 hours ago</small> 
											</div>
											<div class="interactions">
												<button tabindex="-1" class="bi bi-hand-thumbs-up interaction-btn">
													<span class="like-count">&nbsp;16</span>
												</button>
												<button tabindex="-1" class="bi bi-hand-thumbs-down interaction-btn">
													<span class="dislike-count">&nbsp;3</span>
												</button>
												<button tabindex="-1" class="bi bi-chat-left-text interaction-btn">
													<span class="comment-count">&nbsp;20</span>
												</button>
											</div>
										</a>
									</li>
									<li>
										<a class="sticky-note">
											<div class="sticky-note-info">
												<small>Business</small>
												<btn class="bi bi-arrows-angle-expand" data-bs-toggle="modal" data-bs-target="#noteModal"></btn>
											</div>
											<div class="sticky-note-title">
												<h6>Final Exams Coming Up</h6>
											</div>
											<div class="sticky-note-info">
												<small>-snake-231 • 1 hour ago</small> 
											</div>
											<div class="interactions">
												<button tabindex="-1" class="bi bi-hand-thumbs-up interaction-btn">
													<span class="like-count">&nbsp;16</span>
												</button>
												<button tabindex="-1" class="bi bi-hand-thumbs-down interaction-btn">
													<span class="dislike-count">&nbsp;3</span>
												</button>
												<button tabindex="-1" class="bi bi-chat-left-text interaction-btn">
													<span class="comment-count">&nbsp;20</span>
												</button>
											</div>
										</a>
									</li>
									<li>
										<a class="sticky-note">
											<div class="sticky-note-info">
												<small>CompSci</small>
												<btn class="bi bi-arrows-angle-expand" data-bs-toggle="modal" data-bs-target="#noteModal"></btn>
											</div>
											<div class="sticky-note-title">
												<h6>Does anyone wanna team up for CIS 427?Does anyone wanna team up for CIS 427?Does anyone wanna team up for CIS 427?Does anyone wanna team up for CIS 427?</h6>
											</div>
											<div class="sticky-note-info">
												<small>edwad2 • 5 hours ago</small> 
											</div>
											<div class="interactions">
												<button tabindex="-1" class="bi bi-hand-thumbs-up interaction-btn">
													<span class="like-count">&nbsp;16</span>
												</button>
												<button tabindex="-1" class="bi bi-hand-thumbs-down interaction-btn">
													<span class="dislike-count">&nbsp;3</span>
												</button>
												<button tabindex="-1" class="bi bi-chat-left-text interaction-btn">
													<span class="comment-count">&nbsp;20</span>
												</button>
											</div>
										</a>
									</li>
									<li>
										<a class="sticky-note">
											<div class="sticky-note-info">
												<small>Biology</small>
												<btn class="bi bi-arrows-angle-expand" data-bs-toggle="modal" data-bs-target="#noteModal"></btn>
											</div>
											<div class="sticky-note-title">
												<h6>Any good electives to take?</h6>
											</div>
											<div class="sticky-note-info">
												<small>youngwizard3 • 2 hours ago</small> 
											</div>
											<div class="interactions">
												<button tabindex="-1" class="bi bi-hand-thumbs-up interaction-btn">
													<span class="like-count">&nbsp;16</span>
												</button>
												<button tabindex="-1" class="bi bi-hand-thumbs-down interaction-btn">
													<span class="dislike-count">&nbsp;3</span>
												</button>
												<button tabindex="-1" class="bi bi-chat-left-text interaction-btn">
													<span class="comment-count">&nbsp;20</span>
												</button>
											</div>
										</a>
									</li>
									<li>
										<a class="sticky-note">
											<div class="sticky-note-info">
												<small>Chemistry</small>
												<btn class="bi bi-arrows-angle-expand" data-bs-toggle="modal" data-bs-target="#noteModal"></btn>
											</div>
											<div class="sticky-note-title">
												<h6>Incoming Freshman | Are the Classes Difficult Here?</h6>
											</div>
											<div class="sticky-note-info">
												<small>thinkingishard • 15 hours ago</small> 
											</div>
											<div class="interactions">
												<button tabindex="-1" class="bi bi-hand-thumbs-up interaction-btn">
													<span class="like-count">&nbsp;16</span>
												</button>
												<button tabindex="-1" class="bi bi-hand-thumbs-down interaction-btn">
													<span class="dislike-count">&nbsp;3</span>
												</button>
												<button tabindex="-1" class="bi bi-chat-left-text interaction-btn">
													<span class="comment-count">&nbsp;20</span>
												</button>
											</div>
										</a>
									</li>
									<li>
										<a class="sticky-note">
											<div class="sticky-note-info">
												<small>UMD</small>
												<btn class="bi bi-arrows-angle-expand" data-bs-toggle="modal" data-bs-target="#noteModal"></btn>
											</div>
											<div class="sticky-note-title">
												<h6>Best Spot to Study at CASL?</h6>
											</div>
											<div class="sticky-note-info">
												<small>FLYING_4 • 11 hours ago</small> 
											</div>
											<div class="interactions">
												<button tabindex="-1" class="bi bi-hand-thumbs-up interaction-btn">
													<span class="like-count">&nbsp;16</span>
												</button>
												<button tabindex="-1" class="bi bi-hand-thumbs-down interaction-btn">
													<span class="dislike-count">&nbsp;3</span>
												</button>
												<button tabindex="-1" class="bi bi-chat-left-text interaction-btn">
													<span class="comment-count">&nbsp;20</span>
												</button>
											</div>
										</a>
									</li>
									<li>
										<a class="sticky-note">
											<div class="sticky-note-info">
												<small>Psychology</small>
												<btn class="bi bi-arrows-angle-expand" data-bs-toggle="modal" data-bs-target="#noteModal"></btn>
											</div>
											<div class="sticky-note-title">
												<h6>New Psychology Professor at UMD. AMA!</h6>
											</div>
											<div class="sticky-note-info">
												<small>profsunshine • 22 hours ago</small> 
											</div>
											<div class="interactions">
												<button tabindex="-1" class="bi bi-hand-thumbs-up interaction-btn">
													<span class="like-count">&nbsp;16</span>
												</button>
												<button tabindex="-1" class="bi bi-hand-thumbs-down interaction-btn">
													<span class="dislike-count">&nbsp;3</span>
												</button>
												<button tabindex="-1" class="bi bi-chat-left-text interaction-btn">
													<span class="comment-count">&nbsp;20</span>
												</button>
											</div>
										</a>
									</li>
									<li>
										<a class="sticky-note">
											<div class="sticky-note-info">
												<small>Business</small>
												<btn class="bi bi-arrows-angle-expand" data-bs-toggle="modal" data-bs-target="#noteModal"></btn>
											</div>
											<div class="sticky-note-title">
												<h6>Final Exams Coming Up</h6>
											</div>
											<div class="sticky-note-info">
												<small>-snake-231 • 1 hour ago</small> 
											</div>
											<div class="interactions">
												<button tabindex="-1" class="bi bi-hand-thumbs-up interaction-btn">
													<span class="like-count">&nbsp;16</span>
												</button>
												<button tabindex="-1" class="bi bi-hand-thumbs-down interaction-btn">
													<span class="dislike-count">&nbsp;3</span>
												</button>
												<button tabindex="-1" class="bi bi-chat-left-text interaction-btn">
													<span class="comment-count">&nbsp;20</span>
												</button>
											</div>
										</a>
									</li>
								</ul>
							</div>	
						</div>
					</div>
					<!-- All Posts Section -->
					<div class="container-fluid posts-wrapper" id="all-posts">
						<!-- All Posts Content -->
						<div class="container-fluid posts-body">
							<div class="container" id="posts-title">
								<label>All Posts</label>
							</div>
							<!-- All Posts Section Posts-->
							<div class="container all-posts-wrapper">
								<ul class="list-group all-posts">
									<li class="list-group-item post-item">
										<div class="post">
											<div class="post-title">
												<h5>Any good CIS electives to take?</h5>
											</div>
											<div class="poster-info">
												<small>CompSci • Post by youngwizard3 5 hours ago</small>
											</div>
										</div>
										<div class="interactions">
											<button class="bi bi-hand-thumbs-up interaction-btn">
												<span class="like-count">&nbsp;16</span>
											</button>
											<button class="bi bi-hand-thumbs-down interaction-btn">
												<span class="dislike-count">&nbsp;3</span>
											</button>
											<button class="bi bi-chat-left-text interaction-btn">
												<span class="comment-count">&nbsp;20</span>
											</button>
										</div>
									</li>
									<li class="list-group-item post-item">
										<div class="post">
											<div class="post-title">
												<h5>Incoming Freshman | Are the Classes Difficult Here?</h5>
											</div>
											<div class="poster-info">
												<small>Chemistry • Post by thinkingishard 2 hours ago</small>
											</div>
										</div>
										<div class="interactions">
											<button class="bi bi-hand-thumbs-up interaction-btn">
												<span class="like-count">&nbsp;16</span>
											</button>
											<button class="bi bi-hand-thumbs-down interaction-btn">
												<span class="dislike-count">&nbsp;3</span>
											</button>
											<button class="bi bi-chat-left-text interaction-btn">
												<span class="comment-count">&nbsp;20</span>
											</button>
										</div>
									</li>
									<li class="list-group-item post-item">
										<div class="post">
											<div class="post-title">
												<h5>Best Spot to Study at CASL?</h5>
											</div>
											<div class="poster-info">
												<small>UMD • Post by FLYING_4 16 hours ago</small>
											</div>
										</div>
										<div class="interactions">
											<button class="bi bi-hand-thumbs-up interaction-btn">
												<span class="like-count">&nbsp;16</span>
											</button>
											<button class="bi bi-hand-thumbs-down interaction-btn">
												<span class="dislike-count">&nbsp;3</span>
											</button>
											<button class="bi bi-chat-left-text interaction-btn">
												<span class="comment-count">&nbsp;20</span>
											</button>
										</div>
									</li>
									<li class="list-group-item post-item">
										<div class="post">
											<div class="post-title">
												<h5>New Psychology Professor at UMD. AMA!</h5>
											</div>
											<div class="poster-info">
												<small>Psychology • Post by profsunshine 6 hours ago</small>
											</div>
										</div>
										<div class="interactions">
											<button class="bi bi-hand-thumbs-up interaction-btn">
												<span class="like-count">&nbsp;16</span>
											</button>
											<button class="bi bi-hand-thumbs-down interaction-btn">
												<span class="dislike-count">&nbsp;3</span>
											</button>
											<button class="bi bi-chat-left-text interaction-btn">
												<span class="comment-count">&nbsp;20</span>
											</button>
										</div>
									</li>
									<li class="list-group-item post-item">
										<div class="post">
											<div class="post-title">
												<h5>Final Exams Coming Up</h5>
											</div>
											<div class="poster-info">
												<small>Business • Post by -snake-231 1 hour ago</small>
											</div>
										</div>
										<div class="interactions">
											<button class="bi bi-hand-thumbs-up interaction-btn">
												<span class="like-count">&nbsp;16</span>
											</button>
											<button class="bi bi-hand-thumbs-down interaction-btn">
												<span class="dislike-count">&nbsp;3</span>
											</button>
											<button class="bi bi-chat-left-text interaction-btn">
												<span class="comment-count">&nbsp;20</span>
											</button>
										</div>
									</li>
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
        </div>
	</body>
</html>