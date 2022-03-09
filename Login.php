
<?php
include 'InsertUser.php';
//session_start();
//require 'Db_Connect.php';
//require 'VerifyLogin.php';
//// IF USER LOGGED IN
//if(isset($_SESSION['user_name'])){
//    header('Location: Index.php');
//    exit;
//}
//?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="assets/css/style.css" media="all" type="text/css">
</head>

<body>

<form id="form2" action="" method="post">
    <h2>LOG IN FIRST</h2>

    <div class="container">
        <label for="name"><b>UserName</b></label>
        <input type="text" placeholder="" id="name" name="name" autocomplete="" required>

        <label for="password"><b>Password</b></label>
        <input type="password" placeholder="" id="password" name="password"  autocomplete="" required>

        <button type="submit">Login</button>
    </div>
    <?php
    if(isset($success_message)){
        echo '<div class="success_message">'.$success_message.'</div>';
    }
    if(isset($error_message)){
        echo '<div class="error_message">'.$error_message.'</div>';
    }
    ?>
    <div class="container" style="background-color:#f1f1f1">
        <a href="Signup.php"><button type="button" class="Regbtn">Create an account</button></a>
    </div>
</form>
</body></html>
