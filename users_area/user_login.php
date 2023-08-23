<?php
include('../includes/connection.php');
include('../functions/common_functions.php');
session_start();
$wrong_user = "";
$wrong_password = "";

if (isset($_POST['user_login'])) {
    $user_name = $_POST['user_name'];
    $user_password = $_POST['user_password'];

    $select_user = "SELECT * FROM `users_table` WHERE user_name ='$user_name'";
    $result_select = mysqli_query($conn, $select_user);
    $fetch_user_name = "";
    $fetch_user_password = "";
    if (isset($result_select)) {
        $fetch_user_data = mysqli_fetch_assoc($result_select);
        $fetch_user_name = $fetch_user_data['user_name'];
        $fetch_user_password = $fetch_user_data['user_password'];
    }
    if ($fetch_user_name != $user_name) {
        $wrong_user = "This username is Not Registered";
    } elseif (!(password_verify($user_password, $fetch_user_password))) {
        $wrong_password = "Wrong Password";
    } else {
        $_SESSION['user_name'] = $fetch_user_name;
        $ip = get_ip_address();
        echo "<script>alert('Login Successfull')</script>";

        $check_cart = "SELECT * FROM `cart_details` WHERE user_name = '$fetch_user_name'  or ip_address = '$ip'";
        $result_check_cart = mysqli_query($conn, $check_cart);
        $cart_num_rows = mysqli_num_rows($result_check_cart);
        if ($cart_num_rows > 0) {
            echo "<script>window.open('../checkout.php','_self')</script>";
        } else {
            echo "<script>window.open('../index.php','_self')</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../style.css">

</head>

<body class="bg-light">
    <div class="container mt-5">


        <h2 class="text-center">Login Form</h2>
        <!-- form -->
        <form action="" class="form-group w-50 m-auto" method="post" enctype="multipart/form-data">
            <!-- username -->
            <div class="form-outline mb-4">
                <label for="user_name" class="form-label">Username</label>
                <input type="text" id="user_name" class="form-control" placeholder="Enter Username " name="user_name" required autocomplete="off">
                <p class="small text-danger"><?php echo $wrong_user; ?></p>
            </div>

            <!-- Password -->
            <div class="form-outline mb-4">
                <label for="user_password" class="form-label">Password</label>
                <input type="password" name="user_password" id="user_password" class="form-control" placeholder="Enter a Strong Passwrod" required>
                <p class="small text-danger"><?php echo $wrong_password; ?></p>
            </div>
            <!-- Submit Button -->
            <div class="form-outline mb-4">
                <input type="submit" name="user_login" value="Login" class="btn btn-info">
            </div>
            <p class="small">Don't have an Account ? <a href="./user_registeration.php" class="text-danger"> Register</a></p>

        </form>
    </div>
    <!-- bootstrap js link -->
    <script src="../js/bootstrap.js"></script>
</body>

</html>