<?php
if (!isset($_SESSION['user_name'])) {
    echo "<script>window.open('../index.php','_self')</script>";
}
$user_name = $_SESSION['user_name'];
$select_user = "SELECT * FROM `users_table` where user_name = '$user_name'";
$result_select = mysqli_query($conn, $select_user);
$fetch_data = mysqli_fetch_assoc($result_select);
$user_image = $fetch_data['user_image'];

// update user information php code
if (isset($_POST['update_account'])) {

    $new_user_address = $_POST['user_address'];
    $new_user_city = $_POST['user_city'];
    $new_user_mobile = $_POST['user_mobile'];
    $new_user_zip_code = $_POST['user_zip_code'];
    $new_user_image_name = $_FILES['user_image']['name'];
    $new_user_image_name;
    $new_user_image_tmp = $_FILES['user_image']['tmp_name'];
    if ($_FILES['user_image']['name'] == "") {
        $new_user_image_name = $user_image;
    } else {
        $new_user_image_name = $_FILES['user_image']['name'];
        $new_user_image_name = mt_rand() . $new_user_image_name;
        move_uploaded_file($new_user_image_tmp, "./user_images/$new_user_image_name");
        unlink("./user_images/$user_image");
    }

    $user_update = "UPDATE `users_table` SET `user_address`='$new_user_address',`user_image`='$new_user_image_name',`user_city`='$new_user_city',`user_mobile`='$new_user_mobile',`user_zip_code`='$new_user_zip_code' WHERE user_name = '$user_name'";
    $result_update = mysqli_query($conn, $user_update);
    if (isset($result_update)) {

        echo "<script>alert('Profile Updated Successfully')</script>";
        echo "<script>window.open('./user_profile.php?update_account','_self')</script>";
    }
}

// fetching old user data 
$select_user = "SELECT * FROM `users_table` where user_name = '$user_name'";
$result_select = mysqli_query($conn, $select_user);
$fetch_data = mysqli_fetch_assoc($result_select);
$user_email = $fetch_data['user_email'];
$user_address = $fetch_data['user_address'];
$user_image = $fetch_data['user_image'];
$user_city = $fetch_data['user_city'];
$user_mobile = $fetch_data['user_mobile'];
$user_zip_code = $fetch_data['user_zip_code'];
?>

<?php





?>


<h2 class="text-center text-info my-3">Edit Account</h2>
<!-- form -->
<div class="container w-50 m-auto">
    <form action="" class="form-group m-auto" method="post" enctype="multipart/form-data">
        <!-- username -->
        <div class="form-outline mb-4">
            <label for="user_name" class="form-label">Username</label>
            <input type="text" id="user_name" class="form-control" name="user_name" value="<?php echo $user_name; ?>" autocomplete="off" disabled>

        </div>

        <!-- user_email -->
        <div class="form-outline mb-4">
            <label for="user_email" class="form-label">Email Address</label>
            <input type="text" name="user_email" id="user_email" value="<?php echo $user_email; ?>" class="form-control" disabled>
        </div>

        <!-- Address -->
        <div class="form-outline mb-4">
            <label for="user_address" class="form-label">Address</label>
            <input type="text" name="user_address" id="user_address" value="<?php echo $user_address; ?>" class="form-control">
        </div>
        <!-- User Image-->
        <div class="form-outline mb-4">
            <label for="user_image" class="form-label">Upload&nbsp;Image</label>
            <div class="d-flex">
                <input type="file" class="form-control m-auto" id="user_image" name="user_image">
                <img src="./user_images/<?php echo $user_image; ?>" alt="" class="order-img">
            </div>
        </div>

        <!-- User city -->
        <div class="form-outline mb-4">
            <label for="user_city" class="form-label">City</label>
            <input type="text" name="user_city" id="user_city" value="<?php echo $user_city; ?>" class="form-control">
        </div>
        <!-- User mobile -->
        <div class="form-outline mb-4">
            <label for="user_mobile" class="form-label">Mobile</label>
            <input type="text" name="user_mobile" id="user_mobile" value="<?php echo $user_mobile; ?>" class="form-control">
        </div>
        <!-- Zip/Postal Code -->
        <div class="form-outline mb-4">
            <label for="user_zip_code" class="form-label">Zip/Postal Code</label>
            <input type="text" name="user_zip_code" id="user_zip_code" value="<?php echo $user_zip_code; ?>" class="form-control">
        </div>
        <!-- Submit Button -->
        <div class="form-outline mb-4">
            <input type="submit" name="update_account" value="Update" class="btn btn-info">
        </div>
    </form>
</div>