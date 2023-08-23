<?php
if (!isset($_SESSION['user_name'])) {
    echo "<script>window.open('../index.php','_self')</script>";
}
$user_name = $_SESSION['user_name'];
$wrong_password = "";
$password_not_match = "";
if (isset($_POST['change_password'])) {
    $old_password = $_POST['old_password'];

    $get_user_password = "SELECT * FROM `users_table` WHERE user_name = '$user_name'";
    $result_get_password = mysqli_query($conn, $get_user_password);
    $fetch_passwords = mysqli_fetch_assoc($result_get_password);
    $user_password = $fetch_passwords['user_password'];
    if (password_verify($old_password, $user_password)) {
        if (($_POST['new_password']) == ($_POST['confirm_new_password'])) {
            $new_password = $_POST['new_password'];
            $new_hash_password = password_hash($new_password, PASSWORD_BCRYPT);
            $update_password = "UPDATE `users_table` SET `user_password`='$new_hash_password'";
            $result_update_password = mysqli_query($conn, $update_password);
            if (isset($result_update_password)) {
                echo "<script>alert('Password Changed Successfully')</script>";
                echo "<script>window.open('./user_profile.php?change_password','_self')</script>";
            }
        } else {
            $password_not_match = "Passwords Not Matched";
        }
    } else {
        $wrong_password = "Old Password is wrong";
    }
}
?>

<h2 class="text-center my-3">Change Password</h2>
<!-- form -->
<form action="" class="form-group w-50 m-auto" method="post" enctype="multipart/form-data">
    <!-- Old Password -->
    <div class="form-outline mb-4">
        <label for="old_password" class="form-label">Old Password</label>
        <input type="password" id="old_password" class="form-control" placeholder="Enter Your Old Password" name="old_password" required>
        <p class="small text-danger"><?php echo $wrong_password; ?></p>
    </div>
    <!-- New Password -->
    <div class="form-outline mb-4">
        <label for="new_password" class="form-label">New Password</label>
        <input type="password" id="new_password" class="form-control" placeholder="Enter a Strong New Password" name="new_password" required>
    </div>
    <p class="small text-danger"><?php echo $password_not_match; ?></p>
    <!-- Confirm New Password -->
    <div class="form-outline mb-4">
        <label for="confirm_new_password" class="form-label">Confirm New Password</label>
        <input type="password" id="confirm_new_password" class="form-control" placeholder="Enter New Password Again" name="confirm_new_password" required>
    </div>
    <!-- Submit Button -->
    <div class="form-outline mb-4">
        <input type="submit" name="change_password" value="Change Password" class="btn btn-info">
    </div>
</form>