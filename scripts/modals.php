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
                                        <input type="text" class="form-control" name="username" for="inputUserName"
                                            placeholder="" autocomplete="off">
                                    </div>
                                    <div class="form-group input-field">
                                        <label for="inputEmail4">Email:</label>
                                        <input type="email" class="form-control" name="mail" for="inputEmail4"
                                            placeholder="" autocomplete="off">
                                    </div>
                                    <div class="form-group input-field">
                                        <label for="inputPassword4">Password:</label>
                                        <input type="password" class="form-control" name="password" for="inputPassword4"
                                            placeholder="">
                                    </div>
                                    <div class="form-group input-field">
                                        <label for="inputPassword5">Confirm Password:</label>
                                        <input type="password" class="form-control" name="password-repeat"
                                            for="inputPassword5" placeholder="">
                                    </div>
                                    <!-- Profile photo -->
                                    <div class="form-group input-field">
                                        <label for="file-upload">
                                            Upload a profile picture:
                                        </label>
                                        <br>
                                        <input type="file" name="photo" accept="image/png, image/jpeg, image/jpg">
                                    </div>
                                    <!-- Login option -->
                                    <div class="form-group input-field">
                                        Already a member? <a
                                            style="cursor: pointer; color: #00274C; text-decoration: underline;"
                                            onclick="openLoginModal()">log in</a>
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
                                        <input type="text" class="form-control" name="mailUsername" id="input4"
                                            placeholder="" autocomplete="off">
                                    </div>
                                    <div class="form-group input-field">
                                        <label for="inputPassword4">Password:</label>
                                        <input type="password" class="form-control" name="pwd" id="inputPassword4"
                                            placeholder="">
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
                    <button tabindex="-1" type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="scripts/create-cmty.php">
                        <div class="form-body" style="padding: 15px;">
                            <!-- Cmty info -->
                            <div class="form-group">
                                <div class="form-group input-field">
                                    <label for="inputFirstName">Community Name:</label>
                                    <input type="text" class="form-control" id="inputCmtyName" name="cmtyName"
                                        placeholder="">
                                </div>
                                <div class="form-group input-field">
                                    <label for="inputLastName">About the Community:</label>
                                    <textarea class="form-control" id="inputAbtCmty" name="aboutCmty"
                                        placeholder=""></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button tabindex="-1" type="submit" name="create-cmty-submit"
                                class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Advanced Search Modal -->
    <div class="modal fade" id="advancedsearch-modal" tabindex="-1" aria-labelledby="advancedsearchLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="advancedsearch-modalLabel">Advanced Search</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Main Body -->
                    <div class="container-fluid signup-container" style="padding-bottom: 0;">
                        <form method="post" class="login-form"> <!-- action="search.php"-->
                            <div class="form-body">
                                <!-- Query info -->
                                <div class="form-group">

                                    <div class="form-group input-field">
                                        <label for="categoryToLookInto">Community to look in: * </label>
                                        <input type="text" class="form-control" name="categoryToLookInto"
                                            id="categoryToLookInto" placeholder="">
                                    </div>
                                    <div class="form-group input-field">
                                        <label for="inputInclude4">Words to include in the title: </label>
                                        <input type="text" class="form-control" name="wordsToInclude" id="inputInclude4"
                                            placeholder="">
                                    </div>
                                    <div class="form-group input-field">
                                        <label for="inputPassword4">Words to exclude in the title: </label>
                                        <input type="text" class="form-control" name="wordsToExclude" id="inputExclude4"
                                            placeholder="">
                                    </div>
                                    <div class="form-group input-field">
                                        <label for="inputPassword4">Select Posts after: </label>
                                        <input type="date" class="form-control" name="postsAfterDate" id="inputExclude4"
                                            placeholder="">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer" style="margin-top: 20px;">
                                <button type="submit" class="btn btn-primary" name="advancedsearch-submit">Search
                                    posts</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
