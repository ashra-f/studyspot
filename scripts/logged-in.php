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
                    <form method="post" action="scripts/search.php" class="login-form">
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