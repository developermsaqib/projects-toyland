<!-- connection file -->
<?php
include('./includes/connection.php');
include('./functions/common_functions.php');
@session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Toy Land || Prodcts</title>
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="style.css">
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
              <a class="nav-link active" aria-current="page" href="./index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link " href="#">Products</a>
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
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="cart_details.php"><img src="./images/icons/cart.png" alt="Cart" class="cart"><sup> 2</sup></a>
              </li>
            </ul>

          </ul>
          <form action="search_products.php" class="d-flex" method="get">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search">
            <!-- <button class="btn btn-outline-light" type="submit">Search</button> -->
            <input type="submit" value="search" class="btn btn-outline-light" name="search_products">
          </form>
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
    <div class="bg-light">
      <h3 class="text-center">ToyLand</h3>
      <p class="text-center">Toy Land will be a web Application having different variety of toys</p>
    </div>

    <!-- forth child -->
    <div class="row p-2">
      <!-- products start -->
      <div class="col-md-10">
        <div class="row">
          <!-- products to be displayed -->
          <?php
          displaying_all_products();
          sort_products();
          get_unique_category();
          ?>
        </div>
      </div>
      <!-- product end -->

      <!-- sort start-->
      <div class="col-md-2 p-0">

        <!-- sort sidenav start -->
        <ul class="navbar-nav me-auto text-center">
          <li class="nav-item bg-info ">
            <h4 class="nav-link text-light">Sort Products</h4>
          </li>
          <div class="container-fluid bg-secondary p-0">
            <!-- sort dropdown start -->
            <form action="" method="get">
              <select class="form-select bg-secondary text-center text-light mt-2 mb-2" aria-label="Default select example" name="sort">
                <!-- <option value="rand()" selected>Sort randomly</option> -->
                <option value="product_title">Sort by Name</option>
                <option value="product_price">Sort by Price</option>
                <option value="age">Sort by Age</option>
                <option value="category_title">Sort by Product Type</option>
              </select>
              <button type="submit" class="btn btn-info m-2 p-2 mb-5">Click to sort</button>
            </form>

            <!-- sort dropdown end -->
          </div>
        </ul>
        <!-- sort sidenav end -->

        <!-- categories sidenav start -->
        <ul class="navbar-nav me-auto text-center">
          <li class="nav-item bg-info ">
            <a class="nav-link text-light" aria-current="page" href="#">
              <h4>Categories</h4>
            </a>
          </li>
          <div class="container-fluid bg-secondary p-0">
            <?php
            displaying_categories_sidenav();
            ?>
          </div>
        </ul>
        <!-- categories sidenav end -->
      </div>
    </div>
    <!-- sidenav end -->

    <!-- footer start -->

    <?php
    include('./footer.php');
    ?>
    <!-- footer end -->

  </div>

  <!-- bootstrap css  -->
  <script src="js/bootstrap.js"></script>

</body>

</html>