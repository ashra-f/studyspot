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

	session_start();
	require 'scripts/db_handler.php';
	readfile("scripts/modals.php");
	$user_id;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required Meta Tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="assets/imgs/study.png" type="image/icon">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <!-- Our Styling and Scripts -->
    <link rel="stylesheet" href="css/styles.css">
    <script src="scripts/index.js" defer></script>

    <!-- jQuery first, then jQuery min.js, then Bootstrap Bundle JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.js"
        integrity="sha256-w8CvhFs7iHNVUtnSP0YKEg00p9Ih13rlL9zGqvLdePA=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.slim.min.js"
        integrity="sha256-w8CvhFs7iHNVUtnSP0YKEg00p9Ih13rlL9zGqvLdePA=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"
        defer></script>

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">

    <!-- TinyMCE -->
    <script src="https://cdn.tiny.cloud/1/5a8wqgbattaow0xq2sww1dwrn5pvgl8lmg4bmp7bej4k5nsa/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>


    <title>studySpot</title>
</head>

<body>
    <div class="container-fluid" id="main-container">
        <?php
				// check if user ID is present in session
				if (isset($_SESSION['userID'])) {
					// user ID is present in session
					$user_id = $_SESSION['userID'];
			?>
        <!-- Sidebar (Logged In) -->
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
                    <button tabindex="-1" onclick="location.href='create.php'" type="button"
                        class="btn material-symbols-outlined create-btn" data-toggle="tooltip" data-placement="right"
                        title="Create Post" id="createPostBtn">
                        library_add
                    </button>
                </li>
                <li class="nav-item">
                    <button tabindex="-1" data-bs-toggle="modal" data-bs-target="#cmtyModal" type="button"
                        class="btn material-symbols-outlined create-btn" data-toggle="tooltip" data-placement="right"
                        title="Create Community" id="createCmtyBtn">
                        group_add
                    </button>
                </li>
                <li class="nav-item">
                    <!-- Log in btn trigger modal -->
                    <button type="button" class="btn navbar-btn create-btn material-symbols-outlined"
                        data-bs-toggle="modal" data-bs-target="#advancedsearch-modal" data-toggle="tooltip"
                        data-placement="right" title="Search studySpot">
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
                <a href="#"
                    class="d-flex align-items-center justify-content-center p-3 link-dark text-decoration-none dropdown-toggle"
                    id="dropdownUser3" data-bs-toggle="dropdown">
                    <?php 
									// $sql = 'SELECT img_path FROM users WHERE username='.$_SESSION['username'];
									// $results = mysqli_query($connection, $sql);
									// if ($row = mysqli_fetch_array($results)) { 
									// 	$img = $row['img_path'];
									// 	if (empty($img)) {

									// 	}
									// 	else {
									// 		echo '<img src = "data:image/png;base64,' . base64_encode($img) . '" width="24" height="24" class="rounded-circle"/>';
									// 	}
									// }
								?>

                    <img src="assets/imgs/homer.jpg" alt="mdo" width="24" height="24" class="rounded-circle">
                </a>
                <ul class="dropdown-menu text-small shadow settings-dropdown" aria-labelledby="dropdownUser3">
                    <b style="margin-left: 15px;">Welcome <?php echo $_SESSION['username']; ?>!</b>
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    <li><a class="dropdown-item" href="#">Settings</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
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
			else {
				// no user ID in session
			?>

        <!-- Sidebar (Logged Out) -->
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
                        data-bs-toggle="modal" data-bs-target="#login-modal" data-toggle="tooltip"
                        data-placement="right" title="Login">
                        Login
                    </button>
                </li>
                <li class="nav-item">
                    <!-- Sign up btn trigger modal -->
                    <button type="button" class="btn navbar-btn create-btn material-symbols-outlined"
                        data-bs-toggle="modal" data-bs-target="#signup-modal" data-toggle="tooltip"
                        data-placement="right" title="Sign Up">
                        person_add
                    </button>
                </li>
                <li class="nav-item">
                    <!-- Log in btn trigger modal -->
                    <button type="button" class="btn navbar-btn create-btn material-symbols-outlined"
                        data-bs-toggle="modal" data-bs-target="#advancedsearch-modal" data-toggle="tooltip"
                        data-placement="right" title="Search studySpot">
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

        <?php
			}
            if(isset($_GET['cmty'])) {
                $cmtyName = strtolower($_GET['cmty']);
            }
            else {
                $cmtyName = 'home';
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
		?>

        <!-- Community PAGE:  -->
        <!-- Main Body -->
        <div class="container-fluid main-body">
            <!-- Body -->
            <div class="container body-wrapper">
                <!-- About the Cmty -->
                <div class="card text-center" id="cmty-card">
                    <div class="card-header">
                        <!-- Dropdown Cmty -->
                        <div class="dropdown">
                            <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown"
                                aria-expanded="false" style="background-color:#00274C; color:#FFCB05">
                                <label style="font-size: 25px;"><?php echo $cmtyName ?></label>
                            </button>
                            <ul class="dropdown-menu dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                <li>
                                    <a class="dropdown-item searching">
                                        <form class="d-flex" role="search" method="GET" action="index.php">
                                            <button class="btn material-symbols-outlined"
                                                id="takeMeHome" name="cmty" value="home">home</button>
                                        </form>
                                        <form class="d-flex" role="search" method="GET" action="index.php">
                                            <input class="form-control me-2 search-bar" type="search"
                                                placeholder="community search" aria-label="Search" name="cmty"
                                                autocomplete="off">
                                        </form>
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <?php 
                                                // print out all communities
                                                $sql = 'SELECT * FROM communities;';
                                                $results = mysqli_query($connection, $sql);

                                                if (empty($results)) {
                                                    echo '<li style="text-align:center;"><span>No Communities Found :(</span></li>';
                                                }
                                                else {
                                                    while ($row = mysqli_fetch_array($results)) {
                                                        if ($row['cmty_name'] == "home") {
                                                            continue;
                                                        }
                                                        echo '<li><a class="dropdown-item" href="index.php?cmty='.$row['cmty_name'].'">'.$row['cmty_name'].'</a></li>';
                                                        $cmtyID = $row['id'];
                                                    }
                                                }
                                            ?>
                            </ul>
                        </div>
                        <!-- Search bar -->
                        <div class="container" id="searchbar">
                            <button type="button" class="btn navbar-btn create-btn material-symbols-outlined"
                                data-bs-toggle="modal" data-bs-target="#advancedsearch-modal" data-toggle="tooltip"
                                data-placement="right" title="Advanced Search">
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
                                                                        <a href="#" class="btn" id="leave-btn" data-id="'.$currUsr.'" style="background-color:#FFCB05; color: #00274C;">Leave</a>
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
                                            <btn class="bi bi-arrows-angle-expand" data-id='<?php echo $postid?>'
                                                data-method='<?php echo $methodType?>' data-bs-toggle="modal"
                                                data-bs-target="#noteModal"></btn>
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
                                            <button tabindex="-1" class="bi bi-hand-thumbs-up interaction-btn"
                                                onclick="loginAlert()">
                                                <span class="like-count"><?php echo $likes; ?></span>
                                            </button>
                                            <button tabindex="-1" class="bi bi-hand-thumbs-down interaction-btn"
                                                onclick="loginAlert()">
                                                <span class="dislike-count"><?php echo $dislikes; ?></span>
                                            </button>
                                            <button tabindex="-1" class="bi bi-chat-left-text interaction-btn"
                                                data-id='<?php echo $postid?>' data-bs-toggle="modal"
                                                data-bs-target="#commentModal">
                                                <span class="comment-count"><?php echo $comments?></span>
                                            </button>
                                        </div>
                                        <?php
                                                                }
                                                                else {
                                                            ?>
                                        <div class="interactions">
                                            <?php 
                                                                    // check if any button was clicked by this user
                                                                    $sql= 'SELECT * FROM like_unlike WHERE userid='.$_SESSION['userID'].' AND postid='.$postid;
                                                                    $results = mysqli_query($connection, $sql);

                                                                    if ($row = mysqli_fetch_array($results)) {
                                                                        $type1 = $row['type'];
                                                                        if ($type1 == 0) { ?>
                                            <button tabindex="-1"
                                                class="bi bi-hand-thumbs-up interaction-btn like like_<?php echo $postid; ?>"
                                                id="like_<?php echo $postid; ?>">
                                                <span class="like-count likes_<?php echo $postid; ?>"
                                                    id="likes_<?php echo $postid; ?>"><?php echo $total_likes; ?></span>
                                            </button>
                                            <button tabindex="-1"
                                                class="bi bi-hand-thumbs-down-fill selected interaction-btn unlike unlike_<?php echo $postid; ?>"
                                                id="unlike_<?php echo $postid; ?>">
                                                <span class="dislike-count unlikes_<?php echo $postid; ?>"
                                                    id="unlikes_<?php echo $postid; ?>"><?php echo $total_unlikes; ?></span>
                                            </button>
                                            <button tabindex="-1" class="bi bi-chat-left-text interaction-btn"
                                                data-id='<?php echo $postid?>' data-bs-toggle="modal"
                                                data-bs-target="#commentModal">
                                                <span class="comment-count"><?php echo $comments;?></span>
                                            </button>
                                            <?php 
                                                                        }
                                                                        else { ?>
                                            <button tabindex="-1"
                                                class="bi bi-hand-thumbs-up-fill selected interaction-btn like like_<?php echo $postid; ?>"
                                                id="like_<?php echo $postid; ?>">
                                                <span class="like-count likes_<?php echo $postid; ?>"
                                                    id="likes_<?php echo $postid; ?>"><?php echo $total_likes; ?></span>
                                            </button>
                                            <button tabindex="-1"
                                                class="bi bi-hand-thumbs-down  interaction-btn unlike unlike_<?php echo $postid; ?>"
                                                id="unlike_<?php echo $postid; ?>">
                                                <span class="dislike-count unlikes_<?php echo $postid; ?>"
                                                    id="unlikes_<?php echo $postid; ?>"><?php echo $total_unlikes; ?></span>
                                            </button>
                                            <button tabindex="-1" class="bi bi-chat-left-text interaction-btn"
                                                data-id='<?php echo $postid?>' data-bs-toggle="modal"
                                                data-bs-target="#commentModal">
                                                <span class="comment-count"><?php echo $comments;?></span>
                                            </button>
                                            <?php 
                                                                        }
                                                                ?>
                                            <?php }
                                                        else { ?>
                                            <button tabindex="-1"
                                                class="bi bi-hand-thumbs-up interaction-btn like like_<?php echo $postid; ?>"
                                                id="like_<?php echo $postid; ?>">
                                                <span class="like-count likes_<?php echo $postid; ?>"
                                                    id="likes_<?php echo $postid; ?>"><?php echo $total_likes; ?></span>
                                            </button>
                                            <button tabindex="-1"
                                                class="bi bi-hand-thumbs-down interaction-btn unlike unlike_<?php echo $postid; ?>"
                                                id="unlike_<?php echo $postid; ?>">
                                                <span class="dislike-count unlikes_<?php echo $postid; ?>"
                                                    id="unlikes_<?php echo $postid; ?>"><?php echo $total_unlikes; ?></span>
                                            </button>
                                            <button tabindex="-1" class="bi bi-chat-left-text interaction-btn"
                                                data-id='<?php echo $postid?>' data-bs-toggle="modal"
                                                data-bs-target="#commentModal">
                                                <span class="comment-count"><?php echo $comments;?></span>
                                            </button>
                                            <?php } ?>
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
                                                $methodType = 0;

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
                                                    <btn data-id='<?php echo $postid?>' data-method='<?php echo $methodType?>'
                                                        data-bs-toggle="modal" style="cursor: pointer;"
                                                        data-bs-target="#noteModal"><?php echo $title?></btn>
                                                </h5>
                                            </div>
                                            <div class="poster-info">
                                                <small><?php echo $cmtyName.' • Post by '.$username?> •
                                                    <?php echo $timeDiff;?></small>
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
                                            <button tabindex="-1" class="bi bi-hand-thumbs-up interaction-btn"
                                                onclick="loginAlert()">
                                                <span class="like-count"><?php echo $likes; ?></span>
                                            </button>
                                            <button tabindex="-1" class="bi bi-hand-thumbs-down interaction-btn"
                                                onclick="loginAlert()">
                                                <span class="dislike-count"><?php echo $dislikes; ?></span>
                                            </button>
                                            <button tabindex="-1" class="bi bi-chat-left-text interaction-btn"
                                                data-id='<?php echo $postid?>' data-bs-toggle="modal"
                                                data-bs-target="#commentModal">
                                                <span class="comment-count"><?php echo $comments?></span>
                                            </button>
                                        </div>
                                        <?php
                                                                }
                                                                else {
                                                            ?>
                                        <div class="interactions">
                                            <?php 
                                                                    // check if any button was clicked by this user
                                                                    $sql= 'SELECT * FROM like_unlike WHERE userid='.$_SESSION['userID'].' AND postid='.$postid;
                                                                    $results = mysqli_query($connection, $sql);

                                                                    if ($row = mysqli_fetch_array($results)) {
                                                                        $type1 = $row['type'];
                                                                        if ($type1 == 0) { ?>
                                            <button tabindex="-1"
                                                class="bi bi-hand-thumbs-up interaction-btn like like_<?php echo $postid; ?>"
                                                id="like_<?php echo $postid; ?>">
                                                <span class="like-count likes_<?php echo $postid; ?>"
                                                    id="likes_<?php echo $postid; ?>"><?php echo $total_likes; ?></span>
                                            </button>
                                            <button tabindex="-1"
                                                class="bi bi-hand-thumbs-down-fill selected interaction-btn unlike unlike_<?php echo $postid; ?>"
                                                id="unlike_<?php echo $postid; ?>">
                                                <span class="dislike-count unlikes_<?php echo $postid; ?>"
                                                    id="unlikes_<?php echo $postid; ?>"><?php echo $total_unlikes; ?></span>
                                            </button>
                                            <button tabindex="-1" class="bi bi-chat-left-text interaction-btn"
                                                data-id='<?php echo $postid?>' data-bs-toggle="modal"
                                                data-bs-target="#commentModal">
                                                <span class="comment-count"><?php echo $comments;?></span>
                                            </button>
                                            <?php 
                                                                        }
                                                                        else { ?>
                                            <button tabindex="-1"
                                                class="bi bi-hand-thumbs-up-fill selected interaction-btn like like_<?php echo $postid; ?>"
                                                id="like_<?php echo $postid; ?>">
                                                <span class="like-count likes_<?php echo $postid; ?>"
                                                    id="likes_<?php echo $postid; ?>"><?php echo $total_likes; ?></span>
                                            </button>
                                            <button tabindex="-1"
                                                class="bi bi-hand-thumbs-down  interaction-btn unlike unlike_<?php echo $postid; ?>"
                                                id="unlike_<?php echo $postid; ?>">
                                                <span class="dislike-count unlikes_<?php echo $postid; ?>"
                                                    id="unlikes_<?php echo $postid; ?>"><?php echo $total_unlikes; ?></span>
                                            </button>
                                            <button tabindex="-1" class="bi bi-chat-left-text interaction-btn"
                                                data-id='<?php echo $postid?>' data-bs-toggle="modal"
                                                data-bs-target="#commentModal">
                                                <span class="comment-count"><?php echo $comments;?></span>
                                            </button>
                                            <?php 
                                                                        }
                                                                ?>
                                            <?php }
                                                        else { ?>
                                            <button tabindex="-1"
                                                class="bi bi-hand-thumbs-up interaction-btn like like_<?php echo $postid; ?>"
                                                id="like_<?php echo $postid; ?>">
                                                <span class="like-count likes_<?php echo $postid; ?>"
                                                    id="likes_<?php echo $postid; ?>"><?php echo $total_likes; ?></span>
                                            </button>
                                            <button tabindex="-1"
                                                class="bi bi-hand-thumbs-down interaction-btn unlike unlike_<?php echo $postid; ?>"
                                                id="unlike_<?php echo $postid; ?>">
                                                <span class="dislike-count unlikes_<?php echo $postid; ?>"
                                                    id="unlikes_<?php echo $postid; ?>"><?php echo $total_unlikes; ?></span>
                                            </button>
                                            <button tabindex="-1" class="bi bi-chat-left-text interaction-btn"
                                                data-id='<?php echo $postid?>' data-bs-toggle="modal"
                                                data-bs-target="#commentModal">
                                                <span class="comment-count"><?php echo $comments;?></span>
                                            </button>
                                            <?php } ?>
                                        </div>
                                        <?php } ?>
                                    </a>
                                </li>
                                <?php
                                                $methodType++;
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
                    <a href="/"
                        class="col-md-4 d-flex align-items-center justify-content-center mb-3 link-dark text-decoration-none"
                        id="title-img">
                        <img src="assets/imgs/study.png" alt="" width="40">
                    </a>
                    <p class="col-md-4 mb-0" style="color: #00274C; text-align: center;">&copy; 2022 studySpot, Inc</p>
                </footer>
            </div>
        </div>

    </div>
</body>

</html>