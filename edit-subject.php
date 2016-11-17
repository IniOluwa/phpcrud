<!DOCTYPE html>
<html>
    <head>
        <title>PhpCrudApp - Edit</title>
        <?php
            require_once("includes/session.php");
            require_once("includes/connection.php");
            require_once("includes/functions.php");
        ?>
        <?php
            confirm_logged_in();
            find_selected();
        ?>
        <?php
            $id = $_GET['subj'];

            form_validation();
            if (isset($_POST['submit'])) {
                if (isset($id)) {
                    # code...
                    if (intval($id) == 0) {
                        # code...
                        redirect_to("content.php");
                    }
                    if (empty($errors)) {
                        # code...
                        // Perform update
                        $menu_name = $_POST['menu_name'];
                        $position = $_POST['position'];
                        $visible = $_POST['visible'];

                        $query = "UPDATE subjects SET menu_name = '{$menu_name}', position = {$position}, visibLe = {$visible} WHERE id = {$id}";
                        $result = mysqli_query($connection, $query);
                    }else{
                        redirect_to("content.php");
                    }
                }
                $message = "The subject has successfully been updated.";
            }else{
                if (isset($errors)) {
                    # code...
                    $error_count = count($errors);
                    $message = "There were {$error_count} errors with the post request.";
                }
            }
        ?>
        <?php include("includes/header.php");?>
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
                        <li><a href="logout.php" name="logout">Logout</a></li>
                    </ul> 
                </div>

                <h2 class="jumbotron">Edit Subject: <?php echo $the_selected_subject['menu_name'] ?></h2>
                <?php
                    if (isset($message)) {
                        # code...
                        echo "<pre> {$message} </pre>";
                    }
                ?>
                <div class="col-sm-5 form">
                    <form class="form-horizontal" action="edit-subject.php?subj=<?php echo urlencode($the_selected_subject['id']); ?>" method="post">
                        <fieldset>
                        <legend>Edit a subject</legend>
                        <div class="form-group">
                            <label for="" class="col-lg-2 control-label">Subject name</label>
                            <div class="col-lg-10">
                              <input type="text" class="form-control" name="menu_name" id="" placeholder="Subject name" value="<?php echo $the_selected_subject['menu_name'] ?>">
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
                                    echo "<option value=\"{$count}\"";
                                    if ($the_selected_subject['position'] == $count) {
                                        # code...
                                        echo " selected";
                                    }
                                    echo " >{$count}</option>";
                                }
                            ?>
                            </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Visibility</label>
                            <div class="col-lg-10">
                            <div class="radio">
                              <label>
                                <input type="radio" name="visible" id="optionsRadios1" value="1"
                                    <?php 
                                        if ($the_selected_subject['visibLe'] == 1) {
                                            # code...
                                            echo "checked=\"\"";
                                        }
                                    ?>
                                >
                                Yes
                              </label>
                            </div>

                            <div class="radio">
                              <label>
                                <input type="radio" name="visible" id="optionsRadios2" value="0"
                                    <?php 
                                        if ($the_selected_subject['visibLe'] == 0) {
                                            # code...
                                            echo "checked=\"\"";
                                        }
                                    ?>
                                >
                                No
                              </label>
                            </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-lg-10 col-lg-offset-2">
                                <button type="reset" class="btn btn-default"><a href="content.php">Cancel</a></button>
                                <button type="submit" name="submit" class="btn btn-primary">Edit subject</button>
                                <button type="delete" class="btn btn-danger"><a href="delete-subject.php?subj=<?php echo urlencode($the_selected_subject['id']); ?>" onclick="return confirm('Are you sure?')">Delete subject</a></button>
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
