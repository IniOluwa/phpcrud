<?php
    require_once("../includes/session.php");
    require_once("../includes/connection.php");
    require_once("../includes/functions.php");
?>
<?php
    confirm_logged_in();
    find_selected();
?>

<?php
    // Delete Book
    $book_id = $_GET['book'];
    if (isset($book_id)) {
        # code...
        $query = "DELETE FROM books WHERE id = {$book_id} LIMIT 1";
        $result = mysqli_query($connection, $query);
        if ($result) {
            # code...
            redirect_to("view_contents.php");
        }else{
            echo mysqli_error($connection);
        }
    }
?>

<?php
    // Delete Page
    $page_id = $_GET['page'];
    if (isset($page_id)) {
        # code...
        $query = "DELETE FROM pages WHERE id = {$page_id} LIMIT 1";
        $result = mysqli_query($connection, $query);
        if ($result) {
            # code...
            redirect_to("view_contents.php");
        }else{
            echo mysqli_error($connection);
        }
    }
?>
<?php mysqli_close($connection) ?>