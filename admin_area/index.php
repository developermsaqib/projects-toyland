<?php
include_once('../includes/connection.php');
@session_start();
if (!isset($_SESSION['admin_user_name'])) {
    echo "<script>window.open('./admin_login.php','_self')</script>";
} else {
    $admin_user_name = $_SESSION['admin_user_name'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Dashboard</title>
    <!-- Bootstrap css link -->
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/bootstrap.css.map">
    <!-- custom css link -->
    <link rel="stylesheet" href="../style.css">
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />


</head>

<body>
    <div class="container-fluid">


        <!-- Navbar start  -->
        <div class="row p-0 bg-info">
            <div class="col-md-9 px-4">
                <div class="containerfluid">
                    <nav class="navbar navbar-expand-lg navbar-light bg-info">
                        <img src="../images/logo.png" alt="ToyLand" class="logo pt-2">
                    </nav>

                </div>
            </div>
            <div class="col-md-3 p-2 px-3">

                <nav class="navbar navbar-expand-lg navbar-light bg-info">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link text-light" href="#">
                                <?php $select_admin = "SELECT * FROM `admins_table` WHERE admin_user_name = '$admin_user_name'";
                                $result_select_admin = mysqli_query($conn, $select_admin);
                                $fetch_admin_data = mysqli_fetch_assoc($result_select_admin);
                                $fetch_admin_name = $fetch_admin_data['admin_name'];
                                $fetch_admin_image = $fetch_admin_data['admin_image'];
                                ?>
                                <h5>Welcome <span class="small"><?php echo $fetch_admin_name; ?></span></h5>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- Navbar end  -->
        <div class="row bg-light">
            <div class="col-md-12">
                <h3 class="text-center p-2">Manage Details</h3>
            </div>
        </div>
        <div class="row bg-secondary p-1 d-flex align-items-center">


            <div class="col-md-3">
                <div>
                    <img src="./admin_images/<?php echo $fetch_admin_image; ?>" alt="Admin_Name" class="admin_image"><br>
                    <span class="text-light text-center small"> &nbsp;<?php echo $fetch_admin_name; ?></span>
                </div>
            </div>

            <div class="col-md-9">
                <div class="button text-center ">
                    <button class="btn btn-info m-1"><a href="./insert_product.php" class="nav-link text-light bg-info my-1">Insert Products</a></button>
                    <button class="btn btn-info m-1"><a href="./index.php?view_products" class="nav-link text-light bg-info my-1">View Products</a></button>
                    <button class="btn btn-info m-1"><a href="./index.php?insert_categories" class="nav-link text-light bg-info my-1">Insert Categories</a></button>
                    <button class="btn btn-info m-1"><a href="./index.php?view_categories" class="nav-link text-light bg-info my-1"> View Categories</a></button>
                    <button class="btn btn-info m-1"><a href="./index.php?all_orders" class="nav-link text-light bg-info my-1">All Orders</a></button>
                    <button class="btn btn-info m-1"><a href="./index.php?list_users" class="nav-link text-light bg-info my-1">List Users</a></button>
                    <button class="btn btn-info m-1"><a href="./admin_logout.php" class="nav-link text-light bg-info my-1">Logout</a></button>
                </div>

            </div>

        </div>
        <div class="container my-3">
            <?php
            // insert category file
            if (isset($_GET['insert_categories'])) {
                include('insert_categories.php');
            }
            if (isset($_GET['view_categories'])) {
                include('view_categories.php');
            }
            if (isset($_GET['view_products'])) {
                include('view_products.php');
            }
            if (isset($_GET['edit_category'])) {
                include('edit_category.php');
            }

            if (isset($_GET['delete_category'])) {
                include('delete_category.php');
            }

            if (isset($_GET['edit_product'])) {
                include('edit_product.php');
            }
            if (isset($_GET['delete_product'])) {
                include('delete_product.php');
            }
            if (isset($_GET['all_orders'])) {
                include('all_orders.php');
            }
            if (isset($_GET['list_users'])) {
                include('list_users.php');
            }
            if (isset($_GET['manage_order'])) {
                include('pending_order_details.php');
            }
            ?>
        </div>

    </div>
    <!-- bootstrap js link -->
    <script src="../js/bootstrap.js"></script>
</body>

</html>