<!DOCTYPE html>
<html>
    <head>
        <title>PhpCrudApp - Staff</title>
        <?php
            require_once("includes/session.php");
            require_once("includes/connection.php");
            require_once("includes/functions.php");
        ?>
        <?php confirm_logged_in(); ?>
        <?php include("includes/header.php"); ?>
    </head>
    <body>
        <header>
            <div class="navbar navbar-default navbar-fixed-top">
                <div class="navbar-brand">PhpCrudApp - Staff</div>
                <ul class="nav navbar navbar-nav navbar-right">
                    <li><a href="logout.php" name="logout">Logout</a></li>
                </ul>
            </div>
        </header>
        <section>
            <div class="row">
                <div id="sidebar-wrapper" class="col-sm-2">
                    <ul class="nav nav-sidebar">
                        <li> <a href="#">Dashboard</a> </li>
                        <li><a href="content.php">Manage website content.</a></li>
                        <li><a href="new-user.php">Add new user</a></li>
                    </ul> 
                </div>
                <div id="page-content" class="jumbotron">
                    <ul>
                        <li>Welcome to your staff-dash <?php echo $_SESSION['username']; ?>.</li>   
                    </ul>
                </div>
            </div>
        </section>
        <footer><?php include("includes/footer.php"); ?></footer>
    </body>
</html>