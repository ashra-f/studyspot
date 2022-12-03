<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Required Meta Tags -->
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Create a Post</title>
		<link rel="icon" href="assets/imgs/study.png" type="image/icon">

		<!-- Bootstrap CSS -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

		<!-- Our Styling and Scripts -->
		<link rel="stylesheet" href="css/styles.css">
		<script src="scripts/index.js" defer></script>

		<!-- jQuery first, then jQuery min.js, then Bootstrap Bundle JS -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.js" integrity="sha256-w8CvhFs7iHNVUtnSP0YKEg00p9Ih13rlL9zGqvLdePA=" crossorigin="anonymous"></script>		<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
		<script src="https://code.jquery.com/jquery-3.6.1.slim.min.js" integrity="sha256-w8CvhFs7iHNVUtnSP0YKEg00p9Ih13rlL9zGqvLdePA=" crossorigin="anonymous"></script>		<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous" defer></script>
		
		<!-- Icons -->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">

		<!-- TinyMCE -->
		<script src="https://cdn.tiny.cloud/1/5a8wqgbattaow0xq2sww1dwrn5pvgl8lmg4bmp7bej4k5nsa/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
		<!-- <a href="https://www.flaticon.com/free-icons/study" title="study icons">Study icons created by Prosymbols - Flaticon</a> -->
	</head>
	<body>		
		<div class="container-fluid" id="main-container">
			<!-- Navbar -->
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
						<button tabindex="-1" onclick="location.href='pages/create.html'" 
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
					<ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser3">
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

			<!-- Post Guidelines (Hidden Content) -->
			<div id="guidelines-popover-content" class="hidden-info">
				<div>
					<!-- Guidelines -->
					<ol class="list-group list-group-numbered posts">
						<li class="list-group-item d-flex justify-content-between align-items-start">
							<div class="ms-2 me-auto">
								<div class="fw-bold">Respect other members</div>
							</div>
						</li>
						<li class="list-group-item d-flex justify-content-between align-items-start">
							<div class="ms-2 me-auto">
								<div class="fw-bold">Read the community's rules</div>
							</div>
						</li>
						<li class="list-group-item d-flex justify-content-between align-items-start">
							<div class="ms-2 me-auto">
								<div class="fw-bold">Look for the original source of content</div>
							</div>
						</li>
						<li class="list-group-item d-flex justify-content-between align-items-start">
							<div class="ms-2 me-auto">
							<div class="fw-bold">Foster meaningful and genuine interactions</div>
							</div>
						</li>
						<li class="list-group-item d-flex justify-content-between align-items-start">
							<div class="ms-2 me-auto">
							<div class="fw-bold">Have fun!</div>
							</div>
						</li>
					</ol>
				</div>
			</div>

			<!-- Main Body -->
			<div class="container-fluid main-body" id="create-mbody">
				<!-- Body -->
				<div class="container" id="create-field">
					<!-- Rules and Guidelines -->
					<div class="container-fluid side-content-wrapper">
						<div class="container-fluid side-content">
							<div class="container side-content-header">
								studySpot
							</div>
							<ol class="list-group list-group-numbered posts">
								<li class="list-group-item d-flex justify-content-between align-items-start">
									<div class="ms-2 me-auto">
										<div class="fw-bold">Respect other members</div>
									</div>
								</li>
								<li class="list-group-item d-flex justify-content-between align-items-start">
									<div class="ms-2 me-auto">
										<div class="fw-bold">Read the community's rules</div>
									</div>
								</li>
								<li class="list-group-item d-flex justify-content-between align-items-start">
									<div class="ms-2 me-auto">
										<div class="fw-bold">Look for the original source of content</div>
									</div>
								</li>
								<li class="list-group-item d-flex justify-content-between align-items-start">
									<div class="ms-2 me-auto">
									<div class="fw-bold">Foster meaningful and genuine interactions</div>
									</div>
								</li>
								<li class="list-group-item d-flex justify-content-between align-items-start">
									<div class="ms-2 me-auto">
									<div class="fw-bold">Have fun!</div>
									</div>
								</li>
							</ol>
						</div>
					</div>
					
					<!-- Create a post -->
					<div class="container-fluid create-post-wrapper">
						<div class="create-title">
							<label>Create a Post</label> 
							<a tabindex="0" class="btn material-symbols-outlined create-btn" role="button" id="guidelines-popover">info</a>	
						</div>
						<form method="post" action="scripts/create-post.php" id="new-post">
							<div class="form-group">
								<input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Title" name="postTitle">
							</div>
							<div class="form-group">
								<textarea id="my_tinymce" placeholder="Description" name="postBody">
								</textarea>
							</div>
							<div class="forum-options" id="community-options">
								<div class="form-group col-md-4">
									<!-- connect to db and get all the communities this user is in -->
										<select id="inputState" class="form-select" name="cmty">
											<option selected disabled>Select a Community</option>
											<option>CompSci</option>
											<option>UMD</option>
											<option>Gaming</option>
											<option>Sports</option>
										</select>
								</div>
								<button tabindex="-1" data-bs-toggle="modal" data-bs-target="#cmtyModal" type="button" class="btn material-symbols-outlined create-btn" title="Create a Community"  id="add-cmty-btn">group_add</button>
							</div>
							<div class="post-btns">
								<button type="submit" id="post-btn" name="create-post-submit" class="btn">Post</button>
							</div>
						</form>
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