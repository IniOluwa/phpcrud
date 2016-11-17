<!DOCTYPE html>
<html>
    <head>
        <title>PhpCrudApp - Content</title>
        <?php
            require_once("includes/session.php");
            require_once("includes/connection.php");
            require_once("includes/functions.php");
        ?>
        <?php
            confirm_logged_in();
            find_selected();
        ?>
        <?php include("includes/header.php"); ?>
    </head>
    <body>
        <header>
            <div class="navbar navbar-default navbar-fixed-top">
                <div class="navbar-brand">PhpCrudApp - Content</div>
<ul class="nav navbar navbar-nav navbar-right">
                    <li><a href="logout.php" name="logout">Logout</a></li>
                </ul
            </div>
        </header>
        <section>
            <div class="row">
                <div id="sidebar-wrapper" class="col-xs-2">
                    <ul class="nav nav-sidebar" >
                        <?php navigation($the_selected_subject, $the_selected_page); ?>
                        <br id="fine-line">
                        <a href="new-subject.php">+ Add a subject</a>
                    </ul> 
                </div>
                <h3 class="jumbotron"><?php
                    if (isset($the_selected_subject)) {
                        # code...
                        echo $the_selected_subject['menu_name'] . "<br/>";
                    }elseif (isset($the_selected_page)) {
                        # code...
                        echo $the_selected_page['menu_name'] . "<br/>";
                    }else{
                        echo "Select a subject";
                    }
                ?></h3>
                <div id="page-content"><?php
                    if (isset($the_selected_page)) {
                        # code...
                        echo $the_selected_page['content'] . "<br/>";
                    }
                ?></div>
            </div>
        </section>
        <footer><?php include("includes/footer.php"); ?></footer>
    </body>
</html>
