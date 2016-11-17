<!DOCTYPE html>
<?php
    require("includes/connection.php");
    require("includes/functions.php");
?>
<?php find_selected(); ?>
<?php require_once("includes/functions.php") ?>
<html>
    <head>
        <title>PhpCrudApp</title>
        <?php include("includes/header.php"); ?>
    </head>
    <body>
        <header>
            <div id="top-navbar" class="navbar navbar-default navbar-fixed-top">
                <div class="navbar-brand">PhpCrudApp</div>
                <ul class="nav navbar-nav navbar-right"><li><a href="login.php">Login as Staff</a></li></ul>
            </div>
        </header>
        <section>
            <div class="row">
                <div id="sidebar-wrapper" class="col-xs-2">
                    <ul class="nav nav-sidebar" >
                        <?php 
                            // Make database queries.
                            $subjects_set = get_all_subjects();

                            // Use returned data.
                            while ($subject = mysqli_fetch_array($subjects_set)) {
                                # code...
                                $subject_menu = $subject["menu_name"];
                                $position = $subject["position"];
                                $subject_id = $subject["id"];
                                echo "<li";
                                if ($subject_id == $the_selected_subject['id']) {
                                   // echo "class=\"selected\""; 
                                }
                                echo "><a href=\"index.php?subj=" . urlencode($subject_id) . "\">$subject_menu</a></li>";
                           }
                        ?>
                    </ul> 
                </div>
                <h3 class="jumbotron"><?php
                    if (isset($the_selected_subject)) {
                        # code...
                        echo $the_selected_subject['menu_name'];
                        $pages_set = get_all_pages($subject_id);
                        while ($page = mysqli_fetch_array($pages_set)) {
                            # code...
                            $page_menu_name = $page["menu_name"];
                            $page_content = $page["content"];
                            $page_id = $page["id"];
                            echo "<li>"; 
                            if ($page['subject_id'] == $the_selected_subject['id']) {
                                echo $page_menu_name;
                            }
                            echo "</li>";
                        }
                    }
                ?></h3>
                <div id="page-content"><?php

                ?></div>
            </div>
        </section>
        <footer><?php include("includes/footer.php"); ?></footer>
    </body>
</html>