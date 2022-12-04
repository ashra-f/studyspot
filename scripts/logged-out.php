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
                    ?>
                    <form class="signup-form" method="post" action="scripts/signup.php">
                        <div class="form-body">
                            <!-- User info -->
                            <div class="form-group">
                                <div class="form-group input-field">
                                    <label for="inputUserName">Username:</label>
                                    <input type="text" class="form-control" name="username" for="inputUserName" placeholder="" autocomplete="off">
                                </div>
                                <div class="form-group input-field">
                                    <label for="inputEmail4">Email:</label>
                                    <input type="email" class="form-control" name="mail" for="inputEmail4" placeholder="" autocomplete="off">
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
                                    <input type="text" class="form-control" name="mailUsername" id="input4" placeholder="" autocomplete="off">
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