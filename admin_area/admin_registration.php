<?php

include('../includes/connection.php');
include('../functions/common_functions.php');
$admin_already_present = "";
$email_already_present = "";
$password_not_matched = "";
if (isset($_POST['admin_register'])) {
    $user_ip = get_ip_address();
    $admin_name = $_POST['admin_name'];
    $admin_user_name = $_POST['admin_user_name'];
    $admin_email = $_POST['admin_email'];
    $admin_password = $_POST['admin_password'];
    $cpassword = $_POST['cpassword'];
    $admin_address = $_POST['admin_address'];
    $admin_mobile = $_POST['admin_mobile'];
    $admin_image = $_FILES['admin_image']['name'];
    $admin_image_tmp = $_FILES['admin_image']['tmp_name'];

    $select_admin = "SELECT * FROM `admins_table` WHERE `admin_user_name` = '$admin_user_name' OR `admin_email` = '$admin_email'";
    $result_select_admin = mysqli_query($conn, $select_admin);
    $fetch_admin_data = mysqli_fetch_assoc($result_select_admin);
    $selected_admin_name = "";
    $selected_admin_email = "";
    $num_rows = mysqli_num_rows($result_select_admin);

    if ($num_rows > 0) {
        $selected_admin_name = $fetch_admin_data['admin_user_name'];
        $selected_admin_email = $fetch_admin_data['admin_email'];
    }

    //checking if user is already present or not
    if ($selected_admin_name == $admin_user_name) {
        $admin_already_present = "This Username is Already Register try a different username";
    } elseif ($selected_admin_email == $admin_email) {
        $email_already_present = "This Email is Already present try a different Email";
    } elseif ($admin_password != $cpassword) {
        $password_not_matched = "Password Does Not Match";
    } else {
        // upload user image
        move_uploaded_file($admin_image_tmp, "./admin_images/$admin_image");
        $hash_password = password_hash($admin_password, PASSWORD_BCRYPT);

        $insert_admin = "INSERT INTO `admins_table`(`admin_name`, `admin_user_name`, `admin_email`, `admin_password`, `admin_image`, `admin_mobile`, `admin_address`) VALUES ('$admin_name','$admin_user_name','$admin_email','$hash_password','$admin_image','$admin_mobile','$admin_address')";
        $result_insert = mysqli_query($conn, $insert_admin) or die(mysqli_error($conn));

        if (isset($result_insert)) {
            echo "<script>alert('Registeration Successfull!')</script>";
            echo "<script>window.open('./admin_login.php','_self')</script>";
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
    <title>Admin | Registeration Form</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../style.css">

</head>

<body class="bg-light">
    <div class="container mt-5">


        <h2 class="text-center">Admin Registration Form</h2>
        <!-- form -->
        <form action="" class="form-group w-50 m-auto" method="post" enctype="multipart/form-data">
            <!-- admin name -->
            <div class="form-outline mb-4">
                <label for="admin_name" class="form-label">Name</label>
                <input type="text" id="admin_name" class="form-control" placeholder="Enter full Name " name="admin_name" autocomplete="off" required>
            </div>
            <!-- username -->
            <div class="form-outline mb-4">
                <label for="admin_user_name" class="form-label">Username</label>
                <input type="text" id="admin_user_name" class="form-control" placeholder="Enter Username " name="admin_user_name" autocomplete="off" required>
                <p class="small text-danger"><?php echo $admin_already_present; ?></p>
            </div>


            <!-- admin_email -->
            <div class="form-outline mb-4">
                <label for="admin_email" class="form-label">Email Address</label>
                <input type="text" name="admin_email" id="admin_email" placeholder="Enter Email Address e.g example@gmail.com" class="form-control" required>
                <p class="small text-danger"><?php echo $email_already_present; ?></p>
            </div>
            <!-- Password -->
            <div class="form-outline mb-4">
                <label for="admin_password" class="form-label">Password</label>
                <input type="password" name="admin_password" id="admin_password" class="form-control" placeholder="Enter a Strong Passwrod" required>
            </div>
            <!-- Confirm Password -->
            <div class="form-outline mb-4">
                <label for="cpassword" class="form-label">Confirm Password</label>
                <input type="password" name="cpassword" id="cpassword" class="form-control" placeholder="Enter password again" required>
                <p class="small text-danger"><?php echo $password_not_matched; ?></p>
            </div>

            <!-- admin Image-->
            <div class="form-outline mb-4">
                <label for="admin_image" class="form-label">Upload Image</label>
                <input type="file" class="form-control" id="admin_image" name="admin_image">
            </div>
            <!-- admin address -->
            <div class="form-outline mb-4">
                <label for="admin_address" class="form-label">Address</label>
                <input type="text" id="admin_address" class="form-control" placeholder="Enter Complete Address " name="admin_address" autocomplete="off">
                <p class="small text-danger">
            </div>
            <!-- admin mobile -->
            <div class="form-outline mb-4">
                <label for="admin_mobile" class="form-label">Mobile</label>
                <input type="text" id="admin_mobile" class="form-control" placeholder="Enter Your Mobile Number " name="admin_mobile" autocomplete="off">
                <p class="small text-danger">
            </div>


            <!-- Submit Button -->
            <div class="form-outline mb-4">
                <input type="submit" name="admin_register" value="Register" class="btn btn-info">
            </div>
            <p class="small">Already have an Account ? <a href="./admin_login.php" class="text-danger"> Login</a></p>
        </form>
    </div>
    <!-- bootstrap js link -->
    <script src="../js/bootstrap.js"></script>
</body>

</html>