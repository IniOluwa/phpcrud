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
        <?php include("includes/header.php");?>
    </head>
    <body>
        <header>
            <div class="navbar navbar-default navbar-fixed-top">
                <div class="navbar-brand">PhpCrudApp - Content</div>
            </div>
        </header>
        <section>
        <p>123</p>
            <div class="row">
                <div id="sidebar-wrapper" class="col-xs-2">
                    <ul class="nav nav-sidebar" >
                        <?php navigation($the_selected_subject, $the_selected_page); ?>
                    </ul> 
                </div>
                <div class="col-sm-5 form">
                    <form class="form-horizontal" action="create-subject.php" method="post">
                        <fieldset>
                        <legend>Add a new subject</legend>
                          <div class="form-group">
                            <label for="" class="col-lg-2 control-label">Subject name</label>
                            <div class="col-lg-10">
                              <input type="text" class="form-control" name="menu_name" id="" placeholder="Subject name">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="select" class="col-lg-2 control-label">Position</label>
                            <div class="col-lg-10">
                            <select class="form-control" name="position" id="select">
                            <?php 
                                $num_of_subjects = mysqli_num_rows(get_all_subjects());
                                for ($count=1; $count <= $num_of_subjects+1 ; $count++) { 
                                    # code...
                                    echo "<option value=\"{$count}\">{$count}</option>";
                                }
                            ?>
                            </select>
                            </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Visibility</label>
                            <div class="col-lg-10">
                            <div class="radio">
                              <label>
                                <input type="radio" name="visible" id="optionsRadios1" value="1" checked="">
                                Yes
                              </label>
                            </div>

                            <div class="radio">
                              <label>
                                <input type="radio" name="visible" id="optionsRadios2" value="0">
                                No
                              </label>
                            </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-lg-10 col-lg-offset-2">
                                <button type="reset" class="btn btn-default"><a href="content.php" />Cancel</a></button>
                                <button type="submit" class="btn btn-primary">Add subject</button>
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
