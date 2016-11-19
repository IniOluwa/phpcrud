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
    <?php include("../includes/header.php"); ?>
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
                        <li><a href="#"></a></li>
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
        <div class="row">
            <div class="col-sm-4 col-md-3 sidebar">
                <div class="list-group">
                    <span href="#" class="list-group-item active">
                        Books
                        <span class="pull-right" id="slide-submenu"></span>
                    </span>
                    <!-- <a href="#" class="list-group-item"><span class="glyphicon glyphicon-book"></span> -->
                    <ul class="nav nav-sidebar"> <?php navigation($the_selected_book, $the_selected_page)?> </ul>
                    <a href="books.php" class="list-group-item"><span class="glyphicon glyphicon-plus"></span> Add a book or page</a>
                </div>
            </div>

            <div class="row">
                <div class="jumbotron col-lg-8 col-md-4" id="book-title">
                    <?php
                        if (isset($the_selected_book)) {
                            # code...
                            echo $the_selected_book['book_title'] . "<br/>";
                            echo "<a href=\"edit.php?book=" . urlencode($the_selected_book['id']) . "\">Edit Book</a>";
                        }elseif (isset($the_selected_page)) {
                            # code...
                            echo $the_selected_page['page_title'] . "<br/>";
                            echo "<a href=\"edit.php?page=" . urlencode($the_selected_page['id']) . "\">Edit Page</a>";
                        }else{
                            echo "Select a Book";
                        }
                    ?>
                </div>
                <div class="col-lg-8 col-md-4" id="page-content">
                    <?php
                        if (isset($the_selected_page)) {
                            # code...
                            echo "<b>Title: </b>" . $the_selected_page['page_title'] . "<br/>";
                            echo "<b>Content: </b>" . $the_selected_page['page_content'] . "<br/>";
                            echo "<b>Number: </b>" .$the_selected_page['page_number'] . "<br/>";
                        }
                    ?>
                </div>
            </div>
        </div>
    </section>
    <footer>
        <?php include("../includes/footer.php"); ?>
    </footer>
</body>

</html>
