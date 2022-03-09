<?php
if(isset($_POST['name']) && isset($_POST['password'])){

// CHECK IF FIELDS ARE NOT EMPTY
    if(!empty(trim($_POST['name'])) && !empty(trim($_POST['password']))){

// Escape special characters.
        $name = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['name'])));

        $query = mysqli_query($conn, "SELECT * FROM `customer` WHERE name = '$name'");

        if(mysqli_num_rows($query) > 0){

            $row = mysqli_fetch_assoc($query);
            $user_db_pass = $row['password'];

// VERIFY PASSWORD
            $check_password = password_verify($_POST['password'], $user_db_pass);

            if($check_password === TRUE){

                session_regenerate_id(true);

                $_SESSION['user_name'] = $name;
                header('Location: Index.php');
                exit;

            }
            else{
// INCORRECT PASSWORD
                $error_message = "Incorrect Email Address or Password.";

            }

        }
        else{
// EMAIL NOT REGISTERED
            $error_message = "Incorrect Email Address or Password.";
        }
    }
    else{

// IF FIELDS ARE EMPTY
        $error_message = "Please fill in all the required fields.";
    }

}
?>