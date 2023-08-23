<?php
$wrong_user = "";
$wrong_password = "";

if(isset($_POST['user_login'])){
    $user_name = $_POST['user_name'];
    $user_password = $_POST['user_password'];

    $select_user = "SELECT * FROM `users_table` WHERE user_name ='$user_name'";
    $result_select = mysqli_query($conn,$select_user);
    $fetch_user_name = "";
    $fetch_user_password ="";
    if(isset($result_select)){
   $fetch_user_data = mysqli_fetch_assoc($result_select);
    $fetch_user_name = $fetch_user_data['user_name'];
    $fetch_user_password = $fetch_user_data['user_password'];
   
}
    if($fetch_user_name!=$user_name){
        $wrong_user = "This username is Not Registered";
    }elseif(!(password_verify($user_password,$fetch_user_password))){
        $wrong_password = "Wrong Password";
    }else{
        $_SESSION['user_name'] = $fetch_user_name;
        echo "<script>alert('Login Successfull')</script>";
        echo "<script>window.open('./users_area/user_order.php','_self')</script>";
    }

}
?>
    <div class="container mt-5">

    
    <h2 class="text-center">Login Form</h2>
    <!-- form -->
    <form action="" class="form-group w-50 m-auto" method="post" enctype="multipart/form-data">
        <!-- username -->
        <div class="form-outline mb-4">
            <label for="user_name" class="form-label">Username</label>
            <input type="text" id="user_name" class="form-control" placeholder="Enter Username " name="user_name" required autocomplete="off">
            <p class= "small text-danger"><?php echo $wrong_user; ?></p>
        </div>

        <!-- Password -->
        <div class="form-outline mb-4">
            <label for="user_password" class="form-label">Password</label>
            <input type="password" name="user_password" id="user_password" class="form-control" placeholder="Enter a Strong Passwrod" required>
            <p class= "small text-danger"><?php echo $wrong_password; ?></p>
        </div>
        <!-- Submit Button -->
        <div class="form-outline mb-4">
            <input type="submit" name="user_login" value="Login" class="btn btn-info">
        </div>
        <p class="small">Don't have an Account ? <a href="./users_area/checkout_registeration.php" class="text-danger"> Register</a></p>

    </form>
</div>