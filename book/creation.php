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
    // Book Query
    form_validation();
    if (empty($errors)) {
        # code...
        $book_title = $_POST['book_title'];
    }else{
        redirect_to("books.php");
    }

    if (isset($book_title)) {
        # code...
        $query = "INSERT INTO books (
        book_title
        ) VALUES (
            '{$book_title}'
        )";
        if (mysqli_query($connection, $query)) {
            # code...
            redirect_to("view_contents.php");
        }   else {
            echo "Book creation failed: " . mysqli_error();
        }
    }
?>

<?php mysqli_close($connection) ?>
