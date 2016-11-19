<?php
    // File for basic functions
    
    //Function to format input properly prior to database entry
    // Currently not being used
    function mysqli_prep( $value) {
        $magic_quotes_active = get_magic_quotes_gpc();
        $new_enough_php = function_exists("mysqli_real_escape_string");

        if ($new_enough_php) {
            # code...
            if ($magic_quotes_active) {
                # code...
                $value = stripslashes($value);
            }
            $value = mysqli_real_escape_string($value);
        }elseif (!$magic_quotes_active) {
            # code...
            $value = addslashes($value);
        }
        return $value;
    }

    // Page redirection
    function redirect_to($location = NULL) {
        if ($location != NULL) {
            # code...
            header("Location: {$location}");
            exit;
        }
    }

    // Extra error check for queries
    function confirm_query($results) {
        global $connection;
        if (!$results) {
            printf("Error: %s\n", mysqli_error($connection));
            exit();
        }
    }

    // Get all books from database
    function get_all_books() {
        global $connection;
        $books_query = "SELECT * 
                        FROM books
                        ORDER BY id ASC";
        $books_list = mysqli_query($connection, $books_query);
        confirm_query($books_list);
        return $books_list;
    }

    // Get all book pages from database
    function get_all_pages($book_id) {
        global $connection;
        $pages_query = "SELECT * 
                        FROM pages 
                        WHERE book_id = {$book_id} 
                        ORDER BY page_number ASC";
        $pages_set = mysqli_query($connection, $pages_query);
        confirm_query($pages_set);
        return $pages_set;
    }

    // Get a book by its id from database
    function get_book_by_id($book_id) {
        global $connection;
        $query = "SELECT * FROM books WHERE id = {$book_id} LIMIT 1";

        $results = mysqli_query($connection, $query);
        confirm_query($results);
        // If no rows are returned, fetch_array will return false
        if ($book = mysqli_fetch_array($results)) {
            # code...
            return $book;
        } else {
            return NULL;
        }
    }

    // Get a book page by its id from database
    function get_page_by_id($page_id) {
        global $connection;
        $query = "SELECT * FROM pages WHERE id = {$page_id} LIMIT 1";

        $results = mysqli_query($connection, $query);
        confirm_query($results);
        // If no rows are returned, fetch_array will return false
        if ($page = mysqli_fetch_array($results)) {
            # code...
            return $page;
        } else {
            return NULL;
        }
    }

    // Get id of currently selected record
    function find_selected() {
        global $selected_book;
        global $selected_page;
        global $the_selected_book;
        global $the_selected_page;
        if(isset($_GET['book'])){
            $selected_book = $_GET['book'];
            $the_selected_book = get_book_by_id($selected_book);
            $selected_page = "";
        }elseif(isset($_GET['page'])){
            $selected_page = $_GET['page'];
            $the_selected_page = get_page_by_id($selected_page);
            $selected_book = "";
        }else{
            $selected_book = "";
            $selected_page = "";
        }
    }

    // Returning data records
    function navigation($the_selected_book, $the_selected_page) {
        // Make database queries.
        $books_list = get_all_books();

        // Use returned data.
        while ($book = mysqli_fetch_array($books_list)) {
            # code...
            $book_id = $book["id"];
            $book_title = $book["book_title"];
            echo "<li";
            if ($book_id == $the_selected_book['id']) {
                // echo "class=\"selected\""; 
            }
            echo "><a href=\"view_contents.php?book=" . urlencode($book_id) . "\"><span class=\"glyphicon glyphicon-book\"></span> $book_title</a></li>";

            // Make database queries.
            $pages_set = get_all_pages($book_id);

            // Use returned data.
            while ($page = mysqli_fetch_array($pages_set)) {
                # code...
                $page_id = $page["id"];
                $page_title = $page["page_title"];
                $page_content = $page["page_content"];
                $page_number = $page["page_number"];
                echo "<li";
                if ($page_id == $the_selected_page['id']){
                    // echo "class=\"selected\""; 
                }                                    
                echo "><a href=\"view_contents.php?page=" . urlencode($page_id) . "\"><span class=\"glyphicon glyphicon-duplicate\"></span> $page_title</a></li>";
            }
       }
    }

    function index_navigation($the_selected_book, $the_selected_page) {
        // Make database queries.
        $books_list = get_all_books();

        // Use returned data.
        while ($book = mysqli_fetch_array($books_list)) {
            # code...
            $book_id = $book["id"];
            $book_title = $book["book_title"];
            echo "<li";
            if ($book_id == $the_selected_book['id']) {
                // echo "class=\"selected\""; 
            }
            echo "><a href=\"index.php?book=" . urlencode($book_id) . "\"><span class=\"glyphicon glyphicon-book\"></span> $book_title</a></li>";

            // Make database queries.
            $pages_set = get_all_pages($book_id);

            // Use returned data.
            while ($page = mysqli_fetch_array($pages_set)) {
                # code...
                $page_id = $page["id"];
                $page_title = $page["page_title"];
                $page_content = $page["page_content"];
                $page_number = $page["page_number"];
                echo "<li";
                if ($page_id == $the_selected_page['id']){
                    // echo "class=\"selected\""; 
                }                                    
                echo "><a href=\"index.php?page=" . urlencode($page_id) . "\"><span class=\"glyphicon glyphicon-duplicate\"></span> $page_title</a></li>";
            }
       }
    }

    // Book Validation
    function book_form_validation(){
        $fields_with_length = array('book_title' => 30);
        foreach ($fields_with_length as $fieldname => $maxlength) {
            # code...
            if (!isset($_POST[$fieldname]) || strlen(trim($_POST[$fieldname])) > $maxlength) {
                # code...
                $errors[] = $fieldname;
            }
        }
    }

    // Page Validation
    function form_validation() {
        $errors = array();
        $required_fields = array('page_title', 'page_title', 'page_content', 'page_number', 'book_id');
        foreach ($required_fields as $fieldname) {
            # code...
            if (!isset($_POST[$fieldname])) {
                # code...
                $errors[] = $fieldname;
            }
        }

        $fields_with_length = array('menu_name' => 30);
        foreach ($fields_with_length as $fieldname => $maxlength) {
            # code...
            if (!isset($_POST[$fieldname]) || strlen(trim($_POST[$fieldname])) > $maxlength) {
                # code...
                $errors[] = $fieldname;
            }
        }
    }

    // Displaying errors
    function display_errors() {
       form_validation();
       if (!empty(errors)) {
           # code...
            echo "Please review the folllowing fields: ";
            // foreach ($errors as $error) {
            //     # code...
            //     echo "> " . $error;
            // }
            for ($iter=0; $iter <= count($errors); $iter++) { 
                # code...
                echo "> " . $errors[$iter];
            }
       }
    }

    // Authentication form validation
    function authentication_form_validation() {
        $errors = array();
        $required_fields = array('username', 'password');
        foreach ($required_fields as $fieldname) {
            # code...
            if (!isset($_POST[$fieldname]) || empty($_POST[$fieldname])) {
                # code...
                $errors[] = $fieldname;
            }
        }

        $fields_with_length = array('username' => 30);
        foreach ($fields_with_length as $fieldname => $maxlength) {
            # code...
            if (strlen(trim($_POST[$fieldname])) > $maxlength) {
                # code...
                $errors[] = $fieldname;
            }
        }
    }
?>
