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
  <title>Toy Land || Cart Details</title>
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="style.css">
  <style>
    body {
      overflow-x: hidden !important;
    }
  </style>
</head>

<?php
// Removing item to Cart php code 

if (isset($_REQUEST['remove_item_btn'])) {
  $product_id = $_REQUEST['product_id'];
  $ip = get_ip_address();
  $delete_cart_sql = "DELETE FROM `cart_details` WHERE product_id ='$product_id' AND ip_address ='$ip'";
  $result_delete_cart = mysqli_query($conn, $delete_cart_sql);
}
?>


<?php
add_to_cart();

// Updating Cart php code 

if (isset($_REQUEST['update_cart'])) {
  $update_qty = $_REQUEST['update_quantity'];
  $product_id = $_REQUEST['product_id'];
  // check product qty in products table 
  $select_product_qty = "SELECT * FROM `products` WHERE product_id = '$product_id'";
  $result_select_produt_qty = mysqli_query($conn, $select_product_qty);
  $fetch_data_qty = mysqli_fetch_assoc($result_select_produt_qty);
  $product_quantity_in_table = $fetch_data_qty['product_quantity'];

  $ip = get_ip_address();
  if ($product_quantity_in_table < $update_qty) {
    echo "<script>alert('Only $product_quantity_in_table items in the stocks')</script>";
  } else {
    $sql_update_qty = "UPDATE `cart_details` SET `quantity` = '$update_qty' WHERE `ip_address` = '$ip' AND product_id = '$product_id'";
    $result_sql_update_qty = mysqli_query($conn, $sql_update_qty);
    echo "<script>alert('Quantity updated')</script>";
  }
}
?>

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
              <a class="nav-link active" aria-current="page" href="cart_details.php"><img src="./images/icons/cart.png" alt="Cart" class="cart"><sup> <b><?php echo count_items_cart(); ?></b></sup></a>
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
    <div class="my-4">
      <h3 class="text-center text-info py-3">Cart Details</h3>
    </div>

    <div class="container text-center">
      <div class="row">
        <table class="table mb-5 table-bordered">
          <thead>

            <?php
            global $conn;
            $ip = get_ip_address();
            $grand_total = 0;
            $s_no = 0;
            $cart_qty = 1;
            $no_product_msg = "";
            $select_cart = "SELECT * FROM `cart_details` WHERE ip_address='$ip'";
            $result_select_cart = mysqli_query($conn, $select_cart);
            $num_rows = mysqli_num_rows($result_select_cart);
            if ($num_rows == 0) {
              $no_product_msg = "NO Products Added to the Cart Yet";
            } else {

              echo "
 
    <tr>
      <th scope='col'>#</th>
      <th scope='col'>Product Title</th>
      <th scope='col'>Image</th>
      <th scope='col'>Quantity</th>
      <th scope='col'>Product&nbsp;Price</th>
      <th scope='col'>Shipping&nbsp;Price</th>
      <th scope='col'>Total&nbsp;Price</th>
      <th scope='col' colspan='2'>Operations</th>
    </tr>";
            }
            while ($rows_in_cart = mysqli_fetch_assoc($result_select_cart)) {
              $product_id = $rows_in_cart['product_id'];
              $cart_qty = $rows_in_cart['quantity'];
              $select_product = "SELECT * FROM `products` WHERE product_id = $product_id";
              $result_select_product = mysqli_query($conn, $select_product);
              $total_price = 0;

              while ($rows_in_product = mysqli_fetch_assoc($result_select_product)) {
                $product_id = $rows_in_product['product_id'];
                $product_title =  $rows_in_product['product_title'];
                $product_image1 =  $rows_in_product['product_image1'];
                $product_price = $rows_in_product['product_price'];
                $shipping_price = $rows_in_product['shipping_price'];
                $shipping_price = $shipping_price * $cart_qty;
                $product_price_qty = $product_price * $cart_qty;
                $total_price = $total_price + $product_price_qty + $shipping_price;
                $grand_total += $total_price;
                $s_no++;
            ?>
          </thead>
          <tbody>
            <tr>
              <form action="" method="post">
                <th scope="row">
                  <p class="my-3"><?php echo $s_no; ?></p>
                </th>
                <td>
                  <p class="my-3 small"><?php echo $product_title; ?></p>
                </td>
                <td><img src="./admin_area/product_images/<?php echo $product_image1; ?>" alt="" class="cart-img"></td>
                <td><input type="number" min="1" class="m-auto form-control text-center" name="update_quantity" value="<?php echo $cart_qty; ?>"></td>
                <td>
                  <p class="text-center  my-3"><strong>Rs:&nbsp;<?php echo $product_price; ?>&nbsp;/-</strong></p>
                </td>
                <td>
                  <p class="text-center my-3"><strong>Rs:&nbsp;<?php echo $shipping_price; ?>&nbsp;/-</strong></p>
                </td>
                <td>
                  <p class="text-center my-3"><strong>Rs:&nbsp;<?php echo $total_price; ?>&nbsp;/-</strong></p>
                </td>
                <!-- <td><input type="checkbox" name="remove_cart[]" value="" class="m-4"></td> -->
                <!-- <button class="btn btn-info text-light p-1 border-0 ">Update Cart</button>-->
                <td>
                  <input type="submit" name="update_cart" id="update_cart" value="Update Cart" class="btn btn-info text-light p-1 border-0 my-3">
                </td>
                <!-- <td><button class="btn btn-danger text-light p-1 border-0">Remove Item</button></td> -->
                <td>
                  <input type="submit" name="remove_item_btn" id="remove_item-btn" value="Remove Item" class="btn btn-danger text-light p-1 border-0 my-3">
                </td>
                <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">

              </form>
            </tr>

        <?php
              }
            }

        ?>

          </tbody>
        </table>

        <?php
        echo "<h4 class='text-danger text-center my-2 mb-5'>$no_product_msg</h4>";
        ?>

        <div class="d-flex mb-4">

          <?php
          if ($num_rows > 0) {
            echo "
<h5 class='p-2'>Subtotal: <strong class='text-info'>$grand_total/-</strong></h5>
  ";
          }
          ?>

          <a href="index.php"><button class="btn btn-info p-2 border-0 mx-2 ">Continue Shopping</button></a>
          <?php

          if ($num_rows > 0) {
            echo "
  <a href='./checkout.php'><button class='btn btn-secondary text-light p-2 border-0 mx-2'>Checkout</button></a>";
          }
          ?>

        </div>
      </div>
    </div>




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