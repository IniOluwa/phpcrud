<?php
    // File for basic functions

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

    function redirect_to($location = NULL) {
        if ($location != NULL) {
            # code...
            header("Location: {$location}");
            exit;
        }
    }

    function confirm_query($results) {
        global $connection;
        if (!$results) {
            printf("Error: %s\n", mysqli_error($connection));
            exit();
        }
    }

    function get_all_subjects() {
        global $connection;
        $subject_query = "SELECT * 
                        FROM subjects 
                        ORDER BY position ASC";
        $subjects_set = mysqli_query($connection, $subject_query);
        confirm_query($subjects_set);
        return $subjects_set;
    }

    function get_all_pages($subject_id) {
        global $connection;
        $pages_query = "SELECT * 
                        FROM pages 
                        WHERE subject_id = {$subject_id} 
                        ORDER BY position ASC";
        $pages_set = mysqli_query($connection, $pages_query);
        confirm_query($pages_set);
        return $pages_set;
    }

    function get_subject_by_id($subject_id) {
        global $connection;
        $query = "SELECT * FROM subjects WHERE id = {$subject_id} LIMIT 1";


        $results = mysqli_query($connection, $query);
        confirm_query($results);
        // $subject = mysqli_fetch_array($results);
        // If no rows are returned, fetch_array will return false
        if ($subject = mysqli_fetch_array($results)) {
            # code...
            return $subject;
        } else {
            return NULL;
        }
    }

    function get_page_by_id($page_id) {
        global $connection;
        $query = "SELECT * FROM pages WHERE id = {$page_id} LIMIT 1";


        $results = mysqli_query($connection, $query);
        confirm_query($results);
        // $page = mysqli_fetch_array($results);
        // If no rows are returned, fetch_array will return false
        if ($page = mysqli_fetch_array($results)) {
            # code...
            return $page;
        } else {
            return NULL;
        }
    }

    function find_selected() {
        global $selected_subject;
        global $selected_page;
        global $the_selected_subject;
        global $the_selected_page;
        if(isset($_GET['subj'])){
            $selected_subject = $_GET['subj'];
            $the_selected_subject = get_subject_by_id($selected_subject);
            $selected_page = "";
        }elseif(isset($_GET['page'])){
            $selected_page = $_GET['page'];
            $the_selected_page = get_page_by_id($selected_page);
            $selected_subject = "";
        }else{
            $selected_subject = "";
            $selected_page = "";
        }
    }

    function navigation($the_selected_subject, $the_selected_page) {
        // Make database queries.
        $subjects_set = get_all_subjects();

        // Use returned data.
        while ($subject = mysqli_fetch_array($subjects_set)) {
            # code...
            $subject_menu = $subject["menu_name"];
            $position = $subject["position"];
            $subject_id = $subject["id"];
            echo "<li";
            if ($subject_id == $the_selected_subject['id']) {
                // echo "class=\"selected\""; 
            }
            echo "><a href=\"edit-subject.php?subj=" . urlencode($subject_id) . "\">$subject_menu</a></li>";

            // Make database queries.
            $pages_set = get_all_pages($subject_id);

            // Use returned data.
            while ($page = mysqli_fetch_array($pages_set)) {
                # code...
                $page_menu_name = $page["menu_name"];
                $page_content = $page["content"];
                $page_id = $page["id"];
                echo "<li";
                if ($page_id == $the_selected_page['id']){
                    // echo "class=\"selected\""; 
                }                                    
                echo "><a href=\"content.php?page=" . urlencode($page_id) . "\">$page_menu_name</a></li>";
            }
       }
    }

    function form_validation() {
        $errors = array();
        $required_fields = array('menu_name', 'position', 'visible');
        foreach ($required_fields as $fieldname) {
            # code...
            if (!isset($_POST[$fieldname])) {# || (empty($_POST[$fieldname]) && !is_int($_POST[$fieldname]))) {
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

    // function display_errors() {
    //    form_validation();
       // if (!empty(errors)) {
       //     # code...
       //      echo "Please review the folllowing fields: ";
       //      foreach ($errors as $error) {
       //          # code...
       //          echo "> " . $error;
       //      }
       // }
    // }

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
