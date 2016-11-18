<!DOCTYPE html>
<html>
    <head>
        <title>PhpCrudApp - Content</title>
        <?php
            require("includes/connection.php");
            require("includes/functions.php");
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
                    $query = "INSERT INTO users (
                                username, password
                                ) VALUES (
                                '{$username}', '{$hashed_password}'
                            )";
                    $new_user = mysqli_query($connection, $query);
                    if ($new_user) {
                        # code...
                        redirect_to("login.php");
                    } else {
                        echo "<pre>User Creation Failed.</pre>";
                        echo "<pre>" . var_dump($_POST) . "</pre>";
                        echo "<pre>{$query}</pre>";
                    }
                } else {
                    echo "<pre>There are errors in your form.</pre>";
                } 
            } else {
                // Form has not been submitted.
                $username = "";
                $password = "";
            }
        ?>
        <?php include("includes/header.php"); ?>
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
                        <h3><?php  ?></h3>
                        <a href="index.php">Return to site</a>
                    </ul> 
                </div>

                <div class="col-sm-5 form" >    
                    <form class="form-horizontal" action="new-user.php" method="post">
                      <fieldset>
                        <legend>Signup</legend>
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
                                <button type="submit" name="submit" class="btn btn-primary">Signup</button>
                            </div>
                        </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </section>
        <footer><?php include("includes/footer.php"); ?></footer>
    </body>
</html>
