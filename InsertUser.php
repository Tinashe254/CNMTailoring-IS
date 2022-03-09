<?php
session_start();
$username = "";
$email = "";
$errors = [];

$conn = new mysqli('localhost', 'root', '', 'cnmtailoring_is');

// SIGN UP USER
if (isset($_POST['signup-btn'])) {
    if (empty($_POST['name'])) {
        $errors['name'] = 'Username required';
    }
    if (empty($_POST['email'])) {
        $errors['email'] = 'Email required';
    }
    if (empty($_POST['phoneno'])) {
        $errors['phoneno'] = 'phoneno required';
    }
    if (empty($_POST['gender'])) {
        $errors['gender'] = 'gender required';
    }
    if (empty($_POST['county'])) {
        $errors['county'] = 'county required';
    }
    if (empty($_POST['password'])) {
        $errors['password'] = 'Password required';
    }
//    if (isset($_POST['password']) && $_POST['password'] !== $_POST['passwordConf']) {
//        $errors['passwordConf'] = 'The two passwords do not match';
//    }

    $name = $_POST['name'];
    $email = $_POST['email'];
//    $token = bin2hex(random_bytes(50)); // generate unique token
    $phoneno = $_POST['phoneno'];
    $gender = $_POST['gender'];
    $county = $_POST['county'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); //encrypt password

    // Check if email already exists
    $sql = "SELECT * FROM customer WHERE email='$email' LIMIT 1";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $errors['email'] = "Email already exists";
    }

    if (count($errors) === 0) {
        $query = "INSERT INTO customer SET name=?, email=?, phoneno=?, gender=?, county=?, password=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ssss', $name, $email, $phoneno, $gender, $county, $password);
        $result = $stmt->execute();

        if ($result) {
            $user_id = $stmt->insert_id;
            $stmt->close();

            // TO DO: send verification email to user
            // sendVerificationEmail($email, $token);

            $_SESSION['custid'] = $user_id;
            $_SESSION['name'] = $name;
            $_SESSION['email'] = $email;
            $_SESSION['phoneno'] = $phoneno;
            $_SESSION['gender'] = $gender;
            $_SESSION['county'] = $county;
            $_SESSION['password'] = $password;
            $_SESSION['message'] = 'You are logged in!';
            $_SESSION['type'] = 'alert-success';
            header('location: Login.php');
        } else {
            $_SESSION['error_msg'] = "Database error: Could not register user";
        }
    }
}

// LOGIN
if (isset($_POST['login-btn'])) {
    if (empty($_POST['name'])) {
        $errors['name'] = 'Username or email required';
    }
    if (empty($_POST['password'])) {
        $errors['password'] = 'Password required';
    }
    $name = $_POST['name'];
    $password = $_POST['password'];

    if (count($errors) === 0) {
        $query = "SELECT * FROM customer WHERE name=? OR email=? LIMIT 1";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ss', $name, $password);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) { // if password matches
                $stmt->close();

                $_SESSION['custid'] = $user['id'];
                $_SESSION['name'] = $user['name'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['phoneno'] = $user['phoneno'];
                $_SESSION['gender'] = $user['gender'];
                $_SESSION['county'] = $user['county'];
                $_SESSION['message'] = 'You are logged in!';
                $_SESSION['type'] = 'alert-success';
                header('location: Index.php');
                exit(0);
            } else { // if password does not match
                $errors['login_fail'] = "Wrong username / password";
            }
        } else {
            $_SESSION['message'] = "Database error. Login failed!";
            $_SESSION['type'] = "alert-danger";
        }
    }
}

//if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['phoneno']) && isset($_POST['gender']) && isset($_POST['county']) && isset($_POST['password'])) {
//
//// CHECK IF FIELDS ARE NOT EMPTY
//    if (!empty(trim($_POST['name'])) && !empty(trim($_POST['email'])) && !empty(trim($_POST['phoneno'])) && !empty(trim($_POST['gender'])) && !empty(trim($_POST['county'])) && !empty($_POST['password'])) {
//
//// Escape special characters.
//        $name = mysqli_real_escape_string($conn, htmlspecialchars($_POST['name']));
//        $email = mysqli_real_escape_string($conn, htmlspecialchars($_POST['email']));
//        $phoneno = mysqli_real_escape_string($conn, htmlspecialchars($_POST['phoneno']));
//        $gender = mysqli_real_escape_string($conn, htmlspecialchars($_POST['gender']));
//        $county = mysqli_real_escape_string($conn, htmlspecialchars($_POST['county']));
//
//
////IF EMAIL IS VALID
//        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
//
//// CHECK IF EMAIL IS ALREADY REGISTERED
//            $check_email = mysqli_query($conn, "SELECT * FROM `customer` WHERE email = '$email'");
//
//            if (mysqli_num_rows($check_email) > 0) {
//                $error_message = "This Email Address is already registered. Please Try another.";
//            } else {
//
//
//// IF EMAIL IS NOT REGISTERED
//                $user_hash_password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);
////                echo $user_hash_password;
//
//// INSER USER INTO THE DATABASE
//
//                $insert_user = mysqli_query($conn, "INSERT INTO `customer` (name, email, phoneno, gender, county, password) VALUES ('$name', '$email','$phoneno','$gender','$county', '$user_hash_password')");
//
//                if ($insert_user === TRUE) {
//                    $success_message = "Thanks! You have successfully signed up.";
//                } else {
//                    $error_message = "Oops! something wrong.";
//                }
//            }
//        } else {
//// IF EMAIL IS INVALID
//            $error_message = "Invalid email address";
//        }
//    } else {
//// IF FIELDS ARE EMPTY
//        $error_message = "Please fill in all the required fields.";
//    }
//}

