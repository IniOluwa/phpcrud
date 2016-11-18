<!DOCTYPE html>
<html>
    <head>
        <title>BookCrud - Login</title>
        <?php
            require_once("../includes/session.php");
            require_once("../includes/connection.php");
            require_once("../includes/book_functions.php");
        ?>
        <?php
            if (logged_in()) {
                # code...
                redirect_to("index.php");
            }
        ?>
        <?php 
            // Form processing
            if (isset($_POST['submit'])) {
                # code...
                authentication_form_validation();
                if (empty($errors)) {
                    # code...
                    $username = $_POST['username'];
                    $password = $_POST['password'];
                    $hashed_password = sha1($password);
                    $query = "SELECT id, username ";
                    $query .= "FROM users ";
                    $query .= "WHERE username = '{$username}'";
                    $query .= "AND password = '{$hashed_password}' ";
                    $query .= "LIMIT 1";
                    $login = mysqli_query($connection, $query);
                    $logged_in_user = mysqli_fetch_array($login);
                    confirm_query($login);
                    if ($logged_in_user) {
                        # code...
                        // $_COOKIE['userid'] = $login['id'];
                        $_SESSION['userid'] = $logged_in_user['id'];
                        $_SESSION['username'] = $logged_in_user['username'];
                        print_r($logged_in_user);
                        redirect_to("index.php");
                        exit();
                    } else {

                        $message = "Login failed. Check your username or password.";
                        echo "<pre>" . var_dump($_POST) . "</pre>";
                    }
                } else {
                    echo "<pre>There are errors in your form.</pre>";
                } 
            } else {
                if (isset($_GET['logout']) && $_GET['logout'] == 1) {
                    $message = "You are now logged out.";
                }
                // Form has not been submitted.
                $username = "";
                $password = "";
            }
        ?>
        <?php include("../includes/header.php"); ?>
    </head>
    <body>
        <header>
            <div class="navbar navbar-default navbar-fixed-top">
                <div class="navbar-brand">PhpCrudApp - Content</div>
            </div>
        </header>
        <section>
            <div class="row">
                <div id="sidebar-wrapper" class="col-xs-2">
                    <ul class="nav nav-sidebar" >
                        <h3><?php  
                            if (isset($message)) {
                                # code...
                                echo $message;
                            }
                        ?></h3>
                        <a href="index.php">Return to site</a>
                    </ul> 
                </div>

                <div class="col-sm-5 form" >    
                    <form class="form-horizontal" action="login.php" method="post">
                      <fieldset>
                        <legend>Login</legend>
                        <div class="form-group">
                            <label for="inputEmail" class="col-lg-2 control-label">Username</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="inputEmail" placeholder="Username" maxlength="30" name="username" value="<?php htmlentities($username) ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword" class="col-lg-2 control-label">Password</label>
                            <div class="col-lg-10">
                                <input type="password" class="form-control" id="inputPassword" placeholder="Password" maxlength="30" name="password" value="<?php htmlentities($password) ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-10 col-lg-offset-2">
                                <button type="reset" class="btn btn-default">Cancel</button>
                                <button type="submit" name="submit" class="btn btn-primary">Login</button>
                            </div>
                        </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </section>
        <footer><?php include("../includes/footer.php"); ?></footer>
    </body>
</html>
