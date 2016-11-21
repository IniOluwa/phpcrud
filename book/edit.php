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
        <?php
            //Edit Book
            $book_id = $_GET['book'];
            if (isset($_POST['book_title'])) {
                # code...
                form_validation();
                if (empty($errors)) {
                    # code...
                    if (isset($book_id)) {
                        $new_book_title = $_POST['book_title'];
                        $query = "UPDATE books SET book_title = '{$new_book_title}' WHERE id = {$book_id}";
                        $result = mysqli_query($connection, $query);
                        if ($result) {
                            # code...
                            redirect_to("view_contents.php");
                        
                        } else {
                            echo $query;
                            echo mysqli_error($connection);
                        }
                    }
            }   }
        ?>
        <?php
            //Edit Page
            $page_id = $_GET['page'];
            if (isset($_POST['page_title'])) {
                # code...
                form_validation();
                if (empty($errors)) {
                    # code...
                    if (isset($page_id)) {
                        $page_title = $_POST['page_title'];
                        $page_content = $_POST['page_content'];
                        $page_number = $_POST['page_number'];
                        $page_book_id = $_POST['page_book_id'];
                        $query = "UPDATE pages SET page_title = '{$page_title}', page_content = '{$page_content}', page_number = {$page_number}, book_id = {$page_book_id} WHERE id = {$page_id}";
                        $result = mysqli_query($connection, $query);
                        if ($result) {
                            # code...
                            redirect_to("view_contents.php");
                        
                        } else {
                            echo $query;
                            echo mysqli_error($connection);
                        }
                    }
            }   }
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
                            <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <section>
            <div class="col-sm-10 form">
                <form class="form-horizontal" action="edit.php?book=<?php echo urlencode($the_selected_book['id']); ?>" method="post">
                    <fieldset>
                    <legend>Edit Book Title</legend>
                      <div class="form-group">
                        <label for="" class="col-lg-2 control-label">Book title</label>
                        <div class="col-lg-10">
                          <input type="text" class="form-control" name="book_title" id="" placeholder="Title" value="<?php if (isset($the_selected_book)) {echo $the_selected_book['book_title'];} ?>">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <button type="reset" class="btn btn-default"><a href="view_contents.php" />Cancel</a></button>
                            <button type="submit" class="btn btn-primary">Edit book</button>
                            <button type="delete" class="btn btn-danger"><a href="delete.php?book=<?php echo urlencode($the_selected_book['id']); ?>">Delete</a></button>
                        </div>
                    </div>
                  </fieldset>
                </form>
            </div>

            <div class="col-sm-10 form">
                <form class="form-horizontal" action="edit.php?page=<?php echo urlencode($the_selected_page['id']); ?>" method="post">
                    <fieldset>
                    <legend>Edit Page Contents</legend>
                    <div class="form-group">
                        <label for="" class="col-lg-2 control-label">Page title</label>
                        <div class="col-lg-10">
                          <input type="text" class="form-control" name="page_title" id="" placeholder="Page" value="<?php echo $the_selected_page['page_title']; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="textArea" class="col-lg-2 control-label">Page content</label>
                        <div class="col-lg-10">
                            <textarea class="form-control" rows="3" id="textArea" name="page_content" placeholder="Page content" ><?php echo $the_selected_page['page_content']; ?></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-lg-2 control-label">Page number</label>
                        <div class="col-lg-10">
                            <input type="number" min="1" name="page_number" value="<?php echo $the_selected_page['page_number']; ?>">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="" class="col-lg-2 control-label">Page's book</label>
                        <div class="col-xs-1">
                            <input type="number" name="page_book_id" min="1" max="<?php $books = mysqli_fetch_array(get_all_books()); echo count($books);?>" value="<?php echo $the_selected_page['book_id']; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <button type="reset" class="btn btn-default"><a href="view_contents.php" />Cancel</a></button>
                            <button type="submit" class="btn btn-primary">Edit page</button>
                            <button type="delete" class="btn btn-danger"><a href="delete.php?page=<?php echo urlencode($the_selected_page['id']); ?>">Delete</a></button>
                        </div>
                    </div>
                  </fieldset>
                </form>
            </div>
        </section>
        <footer><?php include("../includes/footer.php"); ?></footer>
    </body>
</html>
 
