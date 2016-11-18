<!DOCTYPE html>
<html>
    <head>
        <title>PhpCrudApp - Content</title>
        <?php
            require_once("../includes/session.php");
            require_once("../includes/connection.php");
            require_once("../includes/book_functions.php");
        ?>
        <?php
            confirm_logged_in();
            find_selected();
        ?>
        <?php include("../includes/header.php");?>
    </head>
    <body>
        <header>
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="#">BookCrud</a>
                    </div>
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li><a href="#">Link</a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="#"><span class="glyphicon glyphicon-user"></span><?php echo " " . $_SESSION['username']?></a></li>
                            <li><a href="logout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <section>
            <div class="col-sm-10 form">
                <form class="form-horizontal" action="creation.php" method="post">
                    <fieldset>
                    <legend>Add A New Book</legend>
                      <div class="form-group">
                        <label for="" class="col-lg-2 control-label">Book title</label>
                        <div class="col-lg-10">
                          <input type="text" class="form-control" name="book_title" id="" placeholder="Title">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <button type="reset" class="btn btn-default"><a href="view_contents.php" />Cancel</a></button>
                            <button type="submit" class="btn btn-primary">Add book</button>
                        </div>
                    </div>
                  </fieldset>
                </form>
            </div>

            <div class="col-sm-10 form">
                <form class="form-horizontal" action="creation.php" method="post">
                    <fieldset>
                    <legend>Add A New Book Page</legend>
                    <div class="form-group">
                        <label for="" class="col-lg-2 control-label">Page title</label>
                        <div class="col-lg-10">
                          <input type="text" class="form-control" name="menu_name" id="" placeholder="Page">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="textArea" class="col-lg-2 control-label">Page content</label>
                        <div class="col-lg-10">
                            <textarea class="form-control" rows="3" id="textArea" name="page_contents" placeholder="Page content"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="select" class="col-lg-2 control-label">Page number</label>
                        <div class="col-lg-10">
                            <select class="form-control" name="position" id="select">
                            <?php 
                                // $num_of_subjects = mysqli_num_rows(get_all_subjects());
                                // for ($count=1; $count <= $num_of_subjects+1 ; $count++) { 
                                //     # code...
                                //     echo "<option value=\"{$count}\">{$count}</option>";
                                // }
                            ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="select" class="col-lg-2 control-label">Page's book</label>
                        <div class="col-lg-10">
                            <select class="form-control" name="position" id="select" name="page_book_id">
                            <?php 
                                // $num_of_subjects = mysqli_num_rows(get_all_subjects());
                                // for ($count=1; $count <= $num_of_subjects+1 ; $count++) { 
                                //     # code...
                                //     echo "<option value=\"{$count}\">{$count}</option>";
                                // }
                            ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <button type="reset" class="btn btn-default"><a href="content.php" />Cancel</a></button>
                            <button type="submit" class="btn btn-primary">Add page</button>
                        </div>
                    </div>
                  </fieldset>
                </form>
            </div>
        </section>
        <footer><?php include("../includes/footer.php"); ?></footer>
    </body>
</html>