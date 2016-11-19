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

    if (isset($_POST['book_title'])) {
        # code...
        book_form_validation();
        if (empty($errors)) {
            # code...
            $book_title = $_POST['book_title'];
        }else{
            redirect_to("books.php");
        }
        $query = "INSERT INTO books (
        book_title
        ) VALUES (
            '{$book_title}'
        )";
        confirm_query($query);
        if (mysqli_query($connection, $query)) {
            # code...
            redirect_to("view_contents.php");
        }   else {
            echo "Book creation failed: " . mysqli_error();
        }
    }
?>

<?php 
    // Page Query

    if (isset($_POST['page_title'])) {
        # code...
        form_validation();
        if (empty($errors)) {
            # code...
            $page_title = $_POST['page_title'];
            $page_content = $_POST['page_content'];
            $page_number = $_POST['page_number'];
            $page_book_id = $_POST['page_book_id'];
        }else{
            redirect_to("books.php");
        }
        $query = "INSERT INTO pages (
        page_title, page_content, page_number, book_id
        ) VALUES (
            '{$page_title}', '{$page_content}', {$page_number}, {$page_book_id}
        )";
        confirm_query($query);
        if (mysqli_query($connection, $query)) {
            # code...
            redirect_to("view_contents.php");
        } else {
            echo "Page creation failed: " . mysqli_error($connection);
        }
    }
?>

<?php mysqli_close($connection) ?>
