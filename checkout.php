<!-- connection file -->
<?php
include_once('./includes/connection.php');
include_once('./functions/common_functions.php');
@session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Toy Land || Checkout</title>
  <link rel="stylesheet" href="./css/bootstrap.css">
  <link rel="stylesheet" href="./style.css">
  <style>
    body {
      overflow-x: hidden !important;
    }
  </style>
</head>

<body>
  <!-- Navbar primary -->
  <div class="container-fluid p-0">
    <nav class="navbar navbar-expand-lg navbar-light bg-info">
      <div class="container-fluid">
        <!-- first child -->

        <img src="./images/logo.png" alt="ToyLand" class="logo">

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="./index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link " href="display_all.php">Products</a>
            </li>
            <!-- Categories to be displayed -->

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle " href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Categories
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <?php
                // selecting categories from database
                $select_categories = "SELECT * FROM categories";
                $result_select = mysqli_query($conn, $select_categories);
                $num_rows_affected = mysqli_num_rows($result_select);
                if ($num_rows_affected > 0) {
                  // fetching categories from database
                  while ($rows_categories = mysqli_fetch_assoc($result_select)) {
                    $category_title = $rows_categories['category_title'];
                    $category_id = $rows_categories['category_id'];
                    //  displaying categories
                    echo "<li><a class='dropdown-item' href='index.php?category_title=$category_title'>$category_title</a></li>";
                  }
                } else {
                  echo "<li><a class='dropdown-item' href='#'>Category NOT Available</a></li>";
                }
                ?>
              </ul>
            </li>

            <li class="nav-item">
              <?php
              if (isset($_SESSION['user_name'])) {
                echo "<a class='nav-link ' aria-current='page' href='./users_area/user_profile.php'>My&nbsp;Account</a>";
              } else {
                echo "<a class='nav-link ' aria-current='page' href='./users_area/user_registeration.php'>Register</a>";
              }
              ?>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="./cart_details.php"><img src="./images/icons/cart.png" alt="Cart" class="cart"><sup> <b><?php echo count_items_cart(); ?></b></sup></a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- navbar secondary -->

    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">

      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <div class="d-flex">
            <a class="nav-link active" aria-current="page" href="#">Welcome
              <?php
              if (isset($_SESSION['user_name'])) {
                echo "<a class='nav-link active' aria-current='page' href ='./users_area/user_profile.php'>" . $_SESSION['user_name'] . "</a>";
              } else {
                echo "Guest";
              }
              ?>
            </a>
          </div>

        </li>
        <?php
        if (isset($_SESSION['user_name'])) {
          echo "<li class='nav-item'>
          <a class='nav-link active' aria-current='page' href='./users_area/user_logout.php'>Logout</a>
        </li>";
        } else {
          echo "<li class='nav-item'>
          <a class='nav-link active' aria-current='page' href='./users_area/user_login.php'>Login</a>
        </li>";
        }
        ?>
      </ul>

    </nav>
    <!-- third child -->
    <div class="bg-light m-0">
      <h3 class="text-center">ToyLand</h3>
      <p class="text-center">Toy Land will be a web Application having different variety of toys</p>
    </div>
    <?php
    if (!isset($_SESSION['user_name'])) {
      include('./users_area/checkout_login.php');
    } else {

      echo "<script>window.open('./users_area/user_order.php','_self')</script>";
    }
    ?>





    <!-- footer start -->

    <?php
    include('./footer.php');
    ?>
    <!-- footer end -->

  </div>

  <!-- bootstrap css  -->
  <script src="./js/bootstrap.js"></script>

</body>

</html>