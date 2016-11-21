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
                          <input type="text" class="form-control" name="page_title" id="" placeholder="Page">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="textArea" class="col-lg-2 control-label">Page content</label>
                        <div class="col-lg-10">
                            <textarea class="form-control" rows="3" id="textArea" name="page_content" placeholder="Page content"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-lg-2 control-label">Page number</label>
                        <div class="col-lg-10">
                            <input type="number" min="1" name="page_number">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="" class="col-lg-2 control-label">Page's book</label>
                        <div class="col-xs-1">
                            <input type="number" name="page_book_id" min="1" max="<?php $books = mysqli_fetch_array(get_all_books()); echo count($books);?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <button type="reset" class="btn btn-default"><a href="view_contents.php" />Cancel</a></button>
                            <button type="submit" class="btn btn-primary">Add book page</button>
                        </div>
                    </div>
                  </fieldset>
                </form>
            </div>
                <?php 
                # Not in use yet
                while ($books_list = mysqli_fetch_array(get_all_books())) {
                    # code...
                    if (count($books_list) == count($books)) {
                        return $books;
                    }
                    $books[] = $books_list;
                }
                foreach ($books as $book) {
                    # code...
                    echo "id: " . $book['id'] . "title" . $book['book_title'];
                }
            ?>
        </section>
        <footer><?php include("../includes/footer.php"); ?></footer>
    </body>
</html>
 
