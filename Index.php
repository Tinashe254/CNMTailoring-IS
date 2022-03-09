<?php
require_once './Db_Connect.php';
require_once './fetch-data.php';
require_once './insert-data.php';
$all_user = array_reverse(fetchUsers($conn));

if (isset($_POST['u_name']) && isset($_POST['design']) && isset($_POST['fabrictype']) && isset($_POST['fabriccolor']) && isset($_POST['description'])) {
    $insert_data = insertData($conn, $_POST['u_name'], $_POST['design'], $_POST['u_name'], $_POST['design'] );
    if ($insert_data === true) {
        header('Location: index.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Page</title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>

<div class="container">
    <header class="header">
        <h1 class="title">PHP CRUD Application</h1>
        <p>By <a href="//www.w3jar.com">w3jar.com</a></p>
    </header>
    <div class="wrapper">
        <div class="form">
            <form method="POST">
                <label for="userName">Full Name</label>
                <input type="text" name="u_name" id="userName" placeholder="Name" autocomplete="" required>

                <label for="design">Choose Design</label>
                <select name="design" id="Design" autocomplete="" required>

                    <option value="Male_Suit">Male_Suit</option>
                    <option value="MaleAnkara_Suit">MaleAnkara_Suit</option>
                    <option value="Casual_Shirt">Casual_Shirt</option>
                    <option value="Africanwear_Male">Africanwear_Male</option>

                    <option value="Female_Suit">Female_Suit</option>
                    <option value="FemaleAnkara_FishTail">FemaleAnkara_FishTail</option>
                    <option value="OfficeWear_Female">OfficeWear_Female</option>

                    <option value="KidJumpsuit_Female">KidJumpsuit_Female</option>
                     <option value="Couple Ankara">Couple Ankara</option>
                </select>
                <label for="fabric">Choose Fabric Type</label>
                <select name="fabric" id="fabric" autocomplete="" required>

                    <option value="Cotton">Cotton</option>
                    <option value="Printed_Cotton">Printed_Cotton</option>
                    <option value="Chiffon">Chiffon</option>
                    <option value="Silk">Silk</option>
                    <option value="Printed_silk">Printed_silk</option>
                    <option value="Leather">Leather</option>
                    <option value="Denim">Denim</option>
                    <option value="African_Print">African_Print</option>
                    <option value="Wool">Wool</option>
                </select>
                <label for="color">Choose Color</label>
                <select name="color" id="color" autocomplete="" required>

                    <option value="White">White</option>
                    <option value="Black">Black</option>
                    <option value="Blue">Blue</option>
                    <option value="Purple">Purple</option>

                </select>
                <label for="descr">Description</label>
                <textarea  name="description" id="descr" rows="5" cols="40" required></textarea><br><br>

                <?php if (isset($insert_data) && $insert_data !== true) {
                    echo '<p class="msg err-msg">' . $insert_data . '</p>';
                }
                ?>
                <input type="submit" value="Submit">
            </form>
        </div>
        <div class="user-list">
            <?php if (count($all_user) > 0) : ?>
                <table>
                    <tbody>
                    <tr>
                        <th>Name</th>
                        <th>Design</th>
                        <th>Fabric Type</th>
                        <th>Fabric Color</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                    <?php foreach ($all_user as $user) :
                        $id = $user['id'];
                        $name = $user['name'];
                        $design = $user['design'];
                        $fabrictype =$user['fabrictype'];
                        $fabriccolor = $user['fabriccolor'];
                        $description = $user['description'];
                        ?>
                        <tr>
                            <td><?php echo $name; ?></td>
                            <td><?php echo $design; ?></td>
                            <td><?php echo $fabrictype; ?></td>
                            <td><?php echo $fabriccolor; ?></td>
                            <td><?php echo $description; ?></td>
                            <td>
                                <a href="edit.php?id=<?php echo $id; ?>" class="edit">Edit</a>&nbsp;|
                                <a href="delete.php?id=<?php echo $id; ?>" class="delete delete-action">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
<!--            --><?php //else : ?>
<!--                <h2>No records found. Please insert some records.</h2>-->
<!--            --><?php //endif; ?>
        </div>
    </div>
</div>

<script>
    var delteAction = document.querySelectorAll('.delete-action');
    delteAction.forEach((el) => {
        el.onclick = function(e) {
            e.preventDefault();
            if (confirm('Are you sure?')) {
                window.location.href = e.target.href;
            }
        }
    });
</script>

</body>

</html>
