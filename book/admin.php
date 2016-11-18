<!DOCTYPE html>
<html>

<head>
    <title>BookCrud - Content</title>
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
        <div class="row">
            <div class="col-sm-4 col-md-3 sidebar">
                <div class="mini-submenu">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </div>
                <div class="list-group">
                    <span href="#" class="list-group-item active">
                        Books
                        <span class="pull-right" id="slide-submenu">
                            <i class="fa fa-times"></i>
                        </span>
                    </span>
                    <a href="create_book.php" class="list-group-item">
                        <i class="fa fa-user"></i> Add a book
                    </a>
                    <a href="#" class="list-group-item">
                        <i class="fa fa-folder-open-o"></i> Lorem ipsum <span class="badge">14</span>
                    </a>
                    <a href="#" class="list-group-item">
                        <i class="fa fa-envelope"></i> Lorem ipsum
                    </a>
                </div>
            </div>
        </div>
    </section>
    <footer>
        <?php include("../includes/footer.php"); ?>
    </footer>
</body>

</html>
