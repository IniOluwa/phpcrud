<?php
    require_once("includes/session.php");
    require_once("includes/connection.php");
    require_once("includes/book_functions.php");
?>
<?php confirm_logged_in(); ?>
<?php
    // Four steps to closing a session.

    // 1. Find the session
    // session_start();

    // 2. Unset all session variables
    $_SESSION = array();

    // 3. Destroy the session cookie
    if (isset($_COOKIE[session_name()])) {
        # code...
        setcookie(session_name(), '', time()-42000, '/');
    }

    // 4. Destroy the session
    session_destroy();

    redirect_to("login.php")
?>