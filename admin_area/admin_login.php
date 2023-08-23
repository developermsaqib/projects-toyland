<?php
include('../includes/connection.php');
include('../functions/common_functions.php');
@session_start();
$wrong_user = "";
$wrong_password = "";

if (isset($_POST['admin_login'])) {
    $admin_user_name_or_email = $_POST['admin_user_name_or_email'];
    $admin_password = $_POST['admin_password'];
    $select_admin = "SELECT * FROM `admins_table` WHERE admin_user_name = '$admin_user_name_or_email' OR admin_email= '$admin_user_name_or_email'";
    $result_select = mysqli_query($conn, $select_admin) or die(mysqli_error($conn));
    $select_num_rows = mysqli_num_rows($result_select) or die(mysqli_error($conn));
    if ($select_num_rows <= 0) {
        $wrong_user = "Invalid credentials";
    } elseif ($select_num_rows > 0) {
        $fetch_data = mysqli_fetch_assoc($result_select) or die(mysqli_error($conn));
        $admin_saved_user_name = $fetch_data['admin_user_name'];
        $admin_saved_password = $fetch_data['admin_password'];
        if (!password_verify($admin_password, $admin_saved_password)) {
            $wrong_password = "password is wrong";
        } else {
            $_SESSION['admin_user_name'] = $admin_saved_user_name;
            echo "<script>alert('Login Successful')</script>";
            echo "<script>window.open('./index.php','_self')</script>";
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


        <h2 class="text-center">Admin Login Form</h2>
        <!-- form -->
        <form action="" class="form-group w-50 m-auto" method="post">
            <!-- username or email -->
            <div class="form-outline mb-4">
                <label for="admin_user_name_or_email" class="form-label">Username</label>
                <input type="text" id="admin_user_name_or_email" class="form-control" placeholder="Enter username or email " name="admin_user_name_or_email" required autocomplete="off">
                <p class="small text-danger"><?php echo $wrong_user; ?></p>
            </div>

            <!-- Password -->
            <div class="form-outline mb-4">
                <label for="admin_password" class="form-label">Password</label>
                <input type="password" name="admin_password" id="admin_password" class="form-control" placeholder="Enter Passwrod" required>
                <p class="small text-danger"><?php echo $wrong_password; ?></p>
            </div>
            <!-- Submit Button -->
            <div class="form-outline mb-4">
                <input type="submit" name="admin_login" value="Login" class="btn btn-info">
            </div>
            <p class="small">Don't have an Account ? <a href="admin_registration.php" class="text-danger"> Register</a></p>

        </form>
    </div>
    <!-- bootstrap js link -->
    <script src="../js/bootstrap.js"></script>
</body>

</html>