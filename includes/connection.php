<?php
    require("constants.php");

    // Make database connection and select a database.
    $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
    if (mysqli_connect_errno($connection)) {
        # code...
        echo "Database connection failed: " . mysqli_connect_error();
    }
?>