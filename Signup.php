
<?php
include 'InsertUser.php';
//session_start();
//require 'Db_Connect.php';
//require 'InsertUser.php';
//// IF USER LOGGED IN
//if(isset($_SESSION['user_email'])){
//    header('Location: home.php');
//    exit;
//}
//?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up </title>
    <link rel="stylesheet" href="assets/css/style.css" media="all" type="text/css">

</head>

<body>

<form id="form1" action="" method="post">
    <h2>Create an account</h2>

    <div class="container">
        <label for="username"><b>Username</b></label>
        <input type="text" placeholder="e.g Muturi Christine Njeri" id="username" name="name" autocomplete="" required>

        <label for="email"><b>Email</b></label>
        <input type="email" placeholder="e.g mcn@gmail.com" id="email" name="email" autocomplete="" required> <br><br>

        <label for="pno"><b>Phone number</b></label><br><br>
        <input type="number" placeholder=" e.g +254745678976" id="pno" name="phoneno" autocomplete="" required> <br><br>

        <label for="Gender"><b>Gender</b></label><br><br>
        <input type="radio" id="gender" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?> value="female">Female
        <input type="radio" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?> value="male">Male
        <input type="radio" name="gender" <?php if (isset($gender) && $gender=="other") echo "checked";?> value="other">Other<br><br>

        <label for="County"><b>County</b></label>
        <input type="text" placeholder="e.g Taita-Taveta" id="County" name="county" autocomplete="" required><br><br>

        <label for="pass-w"><b>Password</b></label>
        <input type="password" placeholder="Create your password" id="pass-w" name="password"  autocomplete="" required> <br><br>


        <button type="submit">Sign Up</button>
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
        <a href="Login.php"><button type="button" class="Regbtn">Login</button></a>
    </div>
</form>
</body>
</html>