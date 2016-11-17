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
    if (intval($id) == 0) {
        # code...
        redirect_to("content.php");
    }

    $query = "DELETE FROM subjects WHERE id = {$id} LIMIT 1";
    $result = mysqli_query($connection, $query);
    if ($result) {
        # code...
        redirect_to("content.php");
    }else{
        echo "<p>Deletion Failed. </p>";
    }
?>
<?php mysqli_close($connection) ?>