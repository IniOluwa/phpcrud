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
    form_validation();
    if (empty($errors)) {
        # code...
        $menu_name = $_POST['menu_name'];
        $position = $_POST['position'];
        $visible = $_POST['visible'];
    }else{
        redirect_to("new-subject.php");
    }
?>

<?php
    $query = "INSERT INTO subjects (
        menu_name, position, visible
        ) VALUES (
            '{$menu_name}', {$position}, {$visible}
    )";
    if (mysqli_query($connection, $query)) {
        # code...
        redirect_to("content.php");
    }   else {
        echo "Subject creation failed: " . mysqli_error();
    }
?>

<?php mysqli_close() ?>
