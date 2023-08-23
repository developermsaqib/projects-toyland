<?php
  include('../includes/connection.php');
  include('../functions/common_functions.php');
  session_start();
  $user_already_present = "";
  $email_already_present = "";
  $password_not_matched = "";
  if(isset($_POST['user_register'])){
      $user_ip = get_ip_address();
      $user_name = $_POST['user_name'];
      $user_email = $_POST['user_email'];
      
      $user_password = $_POST['user_password'];
      $hash_password = password_hash($user_password,PASSWORD_BCRYPT);
      $cpassword = $_POST['cpassword'];
      $user_address = $_POST['user_address'];
      $user_city = $_POST['user_city'];
      $user_mobile = $_POST['user_mobile'];
      $user_image = $_FILES['user_image']['name'];
      $user_image_tmp = $_FILES['user_image']['tmp_name'];
      
      $select_user = "SELECT * FROM `users_table` WHERE `user_name` = '$user_name' OR `user_email` = '$user_email'";
      $result_select_user = mysqli_query($conn, $select_user);
      $fetch_user_data = mysqli_fetch_assoc($result_select_user);
      $selected_user_name = "";
      $selected_user_email = "";
      if(isset($fetch_user_data)){
        $selected_user_name = $fetch_user_data['user_name'];
        $selected_user_email = $fetch_user_data['user_email'];
      }
      
      //checking if user is already present or not
      if($selected_user_name==$user_name){
        $user_already_present = "This Username is Already Register try a different username";
      }elseif($selected_user_email==$user_email){
        $email_already_present = "This Email is Already present try a different Email";
      }elseif($user_password!=$cpassword){
            $password_not_matched = "Password Does Not Match";
      }
      else{
        // upload user image
        move_uploaded_file($user_image_tmp,"./user_images/$user_image");

        $insert_user = "INSERT INTO `users_table`(`user_name`, `user_email`, `user_password`, `user_ip`, `user_address`, `user_image`, `user_city`, `user_mobile`,`user_zip_code`) VALUES ('$user_name','$user_email','$hash_password','$user_ip','$user_address','$user_image','$user_city','$user_mobile','$user_zip_code') ";
          $result_insert = mysqli_query($conn,$insert_user) or die(mysqli_error($conn));
        if(isset($result_insert)){
            echo "<script>alert('Registeration Successfull!')</script>";
            $_SESSION['user_name'] = $user_name;
            echo "<script>window.open('../checkout.php','_self')</script>";
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
    <title>Registeration Form</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../style.css">

</head>

<body class="bg-light">
    <div class="container mt-5">

    
    <h2 class="text-center">Registration Form</h2>
    <!-- form -->
    <form action="" class="form-group w-50 m-auto" method="post" enctype="multipart/form-data">
        <!-- username -->
        <div class="form-outline mb-4">
            <label for="user_name" class="form-label">Username</label>
            <input type="text" id="user_name" class="form-control" placeholder="Enter Username " name="user_name"  autocomplete="off">
            <p class= "small text-danger"><?php echo $user_already_present; ?></p>
        </div>

        <!-- user_email -->
        <div class="form-outline mb-4">
            <label for="user_email" class="form-label">Email Address</label>
            <input type="text" name="user_email" id="user_email" placeholder="Enter Email Address e.g example@gmail.com" class="form-control" >
            <p class= "small text-danger"><?php echo $email_already_present; ?></p>
        </div>
        <!-- Password -->
        <div class="form-outline mb-4">
            <label for="user_password" class="form-label">Password</label>
            <input type="password" name="user_password" id="user_password" class="form-control" placeholder="Enter a Strong Passwrod" >
        </div>
        <!-- Confirm Password -->
        <div class="form-outline mb-4">
            <label for="cpassword" class="form-label">Confirm Password</label>
            <input type="password" name="cpassword" id="cpassword" class="form-control" placeholder="Enter password again" >
            <p class= "small text-danger"><?php echo $password_not_matched; ?></p>
        </div>
        <!-- Address -->
        <div class="form-outline mb-4">
            <label for="user_address" class="form-label">Address</label>
            <input type="text" name="user_address" id="user_address" class="form-control" placeholder="Enter complete Address" >
        </div>
        <!-- User Image-->
        <div class="form-outline mb-4">
            <label for="user_image" class="form-label" >Upload Image</label>
            <input type="file" class="form-control" id="user_image" name="user_image">
        </div>
        
        <!-- User city -->
        <div class="form-outline mb-4">
            <label for="user_city" class="form-label">City</label>
            <input type="text" name="user_city" id="user_city" class="form-control" placeholder="Enter City" >
        </div>
        <!-- User mobile -->
        <div class="form-outline mb-4">
            <label for="user_mobile" class="form-label">Mobile</label>
            <input type="text" name="user_mobile" id="user_mobile" class="form-control" placeholder="Enter Your Mobile Number" >
        </div>
        <!-- Submit Button -->
        <div class="form-outline mb-4">
            <input type="submit" name="user_register" value="Register" class="btn btn-info">
        </div>
        <p class="small">Already have an Account ? <a href="../checkout.php" class="text-danger"> Login</a></p>
    </form>
</div>
    <!-- bootstrap js link -->
    <script src="../js/bootstrap.js"></script>
</body>
</html>