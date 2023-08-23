<?php

function displaying_products()
{
  global $conn;

  if (!isset($_GET['category_title'])) {
    if (!isset($_GET['sort'])) {


      // select product from the database
      $select_product_query = "SELECT * FROM `products` order by product_title LIMIT 0,9";
      $result_select_produt_query = mysqli_query($conn, $select_product_query);

      // fetching product dynamic data
      if (isset($result_select_produt_query)) {


        while ($result_row = mysqli_fetch_assoc($result_select_produt_query)) {
          $product_id = $result_row['product_id'];
          $product_title = $result_row['product_title'];
          $product_title = substr($product_title, 0, 29);
          $category_title = $result_row['category_title'];
          $product_description = $result_row['product_description'];
          $product_description = substr($product_description, 0, 80);
          $age = $result_row['age'];
          $product_image1 = $result_row['product_image1'];
          $product_price = $result_row['product_price'];
          $shipping_price = $result_row['shipping_price'];
          $product_quantity = $result_row['product_quantity'];
          if ($product_quantity > 0) {
            // displaying dynamic product card
            echo "<div class='col-md-4 mb-2'>
          <div class='card m-2'>
          <h5 class='bg-success text-center text-light p-1'>Cat:&nbsp;<span class= 'small'>$category_title<span></h5>
            <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
            <div class='card-body'>
              <h5 class='card-title'>$product_title...</h5>
              <p class='card-text p-1'>For Upto $age Year Old</p>
              <p class='card-text p-1'>Price: &#8360;. $product_price/-</p>
              <p class='card-text p-1'>Shipping&nbsp;Price: &#8360;. $shipping_price/-</p>
              <p class='card-text p-1 mb-4'>$product_description...</p>
              <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to Cart</a>
              <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View More...</a>";
            if ($product_quantity <= 5) {
              echo "<p class='card-text text-danger small p-1'>Only $product_quantity items in the stock</p>";
            }
            echo "
              </div>
            </div>
          </div>";
          }
        }
      }
    }
  }
}

function displaying_all_products()
{
  global $conn;

  if (!isset($_GET['category_title'])) {
    if (!isset($_GET['sort'])) {


      // select product from the database
      $select_product_query = "SELECT * FROM `products` order by rand()";
      $result_select_produt_query = mysqli_query($conn, $select_product_query);

      // fetching product dynamic data
      if (isset($result_select_produt_query)) {
        while ($result_row = mysqli_fetch_assoc($result_select_produt_query)) {
          $product_id = $result_row['product_id'];
          $product_title = $result_row['product_title'];
          $product_title = substr($product_title, 0, 25);
          $category_title = $result_row['category_title'];
          $product_description = $result_row['product_description'];
          $product_description = substr($product_description, 0, 55);
          $age = $result_row['age'];
          $product_image1 = $result_row['product_image1'];
          $product_price = $result_row['product_price'];
          $shipping_price = $result_row['shipping_price'];
          $product_quantity = $result_row['product_quantity'];
          if ($product_quantity > 0) {
            // displaying dynamic product card
            echo "<div class='col-md-4 mb-2'>
          <div class='card m-2'>
          <h5 class='bg-success text-center text-light p-1'>Cat:&nbsp;<span class= 'small'>$category_title<span></h5>
            <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
            <div class='card-body'>
              <h5 class='card-title'>$product_title...</h5>
              <p class='card-text p-1'>For Upto $age Year Old</p>
              <p class='card-text p-1'>Price: &#8360;. $product_price/-</p>
              <p class='card-text p-1'>Shipping&nbsp;Price: &#8360;. $shipping_price/-</p>
              <p class='card-text p-1 mb-4'>$product_description...</p>
              <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to Cart</a>
              <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View More...</a>";
            if ($product_quantity <= 5) {
              echo "<p class='card-text text-danger small p-1'>Only $product_quantity items in the stock</p>";
            }
            echo "
              </div>
            </div>
          </div>";
          }
        }
      }
    }
  }
}


function sort_products()
{
  global $conn;

  if (isset($_GET['sort'])) {
    $sort = $_GET['sort'];
    // select product from the database
    $select_product_query = "SELECT * FROM `products` order by $sort";
    if (isset($_GET['category_title'])) {
      $cat_title = $_GET['category_title'];
      $select_product_query = "SELECT * FROM `products` where category_title = $cat_title";
    }
    $result_select_produt_query = mysqli_query($conn, $select_product_query);

    // fetching product dynamic data
    if (isset($result_select_produt_query)) {
      while ($result_row = mysqli_fetch_assoc($result_select_produt_query)) {
        $product_id = $result_row['product_id'];
        $product_title = $result_row['product_title'];
        $product_title = substr($product_title, 0, 29);
        $category_title = $result_row['category_title'];
        $product_description = $result_row['product_description'];
        $product_description = substr($product_description, 0, 80);
        $age = $result_row['age'];
        $product_image1 = $result_row['product_image1'];
        $product_price = $result_row['product_price'];
        $shipping_price = $result_row['shipping_price'];
        $product_quantity = $result_row['product_quantity'];
        if ($product_quantity > 0) {
          // displaying dynamic product card
          echo "<div class='col-md-4 mb-2'>
          <div class='card m-2'>
          <h5 class='bg-success text-center text-light p-1'>Cat:&nbsp;<span class= 'small'>$category_title<span></h5>
            <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
            <div class='card-body'>
              <h5 class='card-title'>$product_title...</h5>
              <p class='card-text p-1'>For Upto $age Year Old</p>
              <p class='card-text p-1'>Price: &#8360;. $product_price/-</p>
              <p class='card-text p-1'>Shipping&nbsp;Price: &#8360;. $shipping_price/-</p>
              <p class='card-text p-1 mb-4'>$product_description...</p>
              <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to Cart</a>
              <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View More...</a>";
          if ($product_quantity <= 5) {
            echo "<p class='card-text text-danger small p-1'>Only $product_quantity items in the stock</p>";
          }
          echo "
              </div>
            </div>
          </div>";
        }
      }
    }
  }
}


function get_unique_category()
{

  global $conn;

  if (isset($_GET['category_title'])) {
    $cat_title = $_GET['category_title'];
    $select_product_query = "SELECT * FROM `products` where category_title = '$cat_title'";

    $result_select_produt_query = mysqli_query($conn, $select_product_query);

    $num_row_select = mysqli_num_rows($result_select_produt_query);

    // fetching product dynamic data
    if ($num_row_select <= 0) {
      echo "<h2 class='text-center text-danger'>No Products Available for this Category</h2>";
    }
    while ($result_row = mysqli_fetch_assoc($result_select_produt_query)) {
      $product_id = $result_row['product_id'];
      $product_title = $result_row['product_title'];
      $product_title = substr($product_title, 0, 29);
      $category_title = $result_row['category_title'];
      $product_description = $result_row['product_description'];
      $product_description = substr($product_description, 0, 80);
      $age = $result_row['age'];
      $product_image1 = $result_row['product_image1'];
      $product_price = $result_row['product_price'];
      $shipping_price = $result_row['shipping_price'];
      $product_quantity = $result_row['product_quantity'];
      if ($product_quantity > 0) {
        // displaying dynamic product card
        echo "<div class='col-md-4 mb-2'>
          <div class='card m-2'>
          <h5 class='bg-success text-center text-light p-1'>Cat:&nbsp;<span class= 'small'>$category_title<span></h5>
            <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
            <div class='card-body'>
              <h5 class='card-title'>$product_title...</h5>
              <p class='card-text p-1'>For Upto $age Year Old</p>
              <p class='card-text p-1'>Price: &#8360;. $product_price/-</p>
              <p class='card-text p-1'>Shipping&nbsp;Price: &#8360;. $shipping_price/-</p>
              <p class='card-text p-1 mb-4'>$product_description...</p>
              <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to Cart</a>
              <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View More...</a>";
        if ($product_quantity <= 5) {
          echo "<p class='card-text text-danger small p-1'>Only $product_quantity items in the stock</p>";
        }
        echo "
              </div>
            </div>
          </div>";
      }
    }
  }
}


//display sideNav Categories function
function displaying_categories_sidenav()
{
  global $conn;
  $select_categories = "SELECT * FROM categories";
  $result_select = mysqli_query($conn, $select_categories);
  $num_rows_affected = mysqli_num_rows($result_select);
  if ($num_rows_affected > 0) {
    while ($rows_categories = mysqli_fetch_assoc($result_select)) {
      $category_title = $rows_categories['category_title'];
      $category_id = $rows_categories['category_id'];
      echo "<li class='nav-item  '>
      <a class='nav-link text-light' aria-current='page' href='index.php?category_title=$category_title'>$category_title</a>
            </li>";
    }
  } else {
    echo "<li class='nav-item'>
    <a class='nav-link text-light' aria-current='page' href='#'>Category Not Available</a>
          </li>";
  }
}


function search_products()
{
  global $conn;

  if (!isset($_GET['category_title'])) {
    if (!isset($_GET['sort'])) {
      if (isset($_GET['search_products'])) {
        $search_products = $_GET['search'];

        // select product from the database
        $select_product_query = "SELECT * FROM `products` WHERE product_keywords LIKE '%$search_products%'";
        $result_select_produt_query = mysqli_query($conn, $select_product_query);
        $num_rows_affected_select = mysqli_num_rows($result_select_produt_query);
        if ($num_rows_affected_select <= 0) {
          echo "<h2 class='text-center text-danger'>Match Not found! Products Not Available for this keywords</h2>";
        }


        while ($result_row = mysqli_fetch_assoc($result_select_produt_query)) {
          $product_id = $result_row['product_id'];
          $product_title = $result_row['product_title'];
          $product_title = substr($product_title, 0, 29);
          $category_title = $result_row['category_title'];
          $product_description = $result_row['product_description'];
          $product_description = substr($product_description, 0, 80);
          $age = $result_row['age'];
          $product_image1 = $result_row['product_image1'];
          $product_price = $result_row['product_price'];
          $shipping_price = $result_row['shipping_price'];
          $product_quantity = $result_row['product_quantity'];
          if ($product_quantity > 0) {
            // displaying dynamic product card
            echo "<div class='col-md-4 mb-2'>
          <div class='card m-2'>
          <h5 class='bg-success text-center text-light p-1'>Cat:&nbsp;<span class= 'small'>$category_title<span></h5>
            <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
            <div class='card-body'>
              <h5 class='card-title'>$product_title...</h5>
              <p class='card-text p-1'>For Upto $age Year Old</p>
              <p class='card-text p-1'>Price: &#8360;. $product_price/-</p>
              <p class='card-text p-1'>Shipping&nbsp;Price: &#8360;. $shipping_price/-</p>
              <p class='card-text p-1 mb-4'>$product_description...</p>
              <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to Cart</a>
              <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View More...</a>";
            if ($product_quantity <= 5) {
              echo "<p class='card-text text-danger small p-1'>Only $product_quantity items in the stock</p>";
            }
            echo "
              </div>
            </div>
          </div>";
          }
        }
      }
    }
  }
}


//getting IP Address function
function get_ip_address()
{
  //whether ip is from the share internet  
  if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
  }
  //whether ip is from the proxy  
  elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
  }
  //whether ip is from the remote address  
  else {
    $ip = $_SERVER['REMOTE_ADDR'];
  }
  return $ip;
}



function add_to_cart()
{
  global $conn;
  if (isset($_GET['add_to_cart'])) {
    $product_id = $_GET['add_to_cart'];
    $ip = get_ip_address();
    if (isset($_SESSION['user_name'])) {
      $user_name = $_SESSION['user_name'];
      $select_cart_query = "SELECT * FROM `cart_details` WHERE product_id = $product_id AND user_name = '$user_name'";
      $result_select_cart_query = mysqli_query($conn, $select_cart_query);
      $num_rows_affected_select = mysqli_num_rows($result_select_cart_query);
      if ($num_rows_affected_select > 0) {
        echo "<script>alert('Product Already in the Cart')</script>";
        echo "<script>window.open('index.php','_self')</script>";
      } else {


        $insert_to_cart_query = "INSERT INTO `cart_details` (product_id, ip_address,user_name, quantity) VALUES ($product_id,'$ip','$user_name','1')";
        $result_insert_cart = mysqli_query($conn, $insert_to_cart_query);
        echo "<script>alert('Product Added to the Cart')</script>";
        echo "<script>window.open('index.php','_self')</script>";
      }
    } else {
      $select_cart_query = "SELECT * FROM `cart_details` WHERE product_id = $product_id AND ip_address = '$ip'";
      $result_select_cart_query = mysqli_query($conn, $select_cart_query);
      $num_rows_affected_select = mysqli_num_rows($result_select_cart_query);
      if ($num_rows_affected_select > 0) {
        echo "<script>alert('Product Already in the Cart')</script>";
        echo "<script>window.open('index.php','_self')</script>";
      } else {


        $insert_to_cart_query = "INSERT INTO `cart_details` (product_id, ip_address, quantity) VALUES ($product_id,'$ip','1')";
        $result_insert_cart = mysqli_query($conn, $insert_to_cart_query);
        echo "<script>alert('Product Added to the Cart')</script>";
        echo "<script>window.open('index.php','_self')</script>";
      }
    }
  }
}


// buy now directly function
function buy_now_cart()
{
  global $conn;
  if (isset($_GET['add_to_cart'])) {
    $product_id = $_GET['add_to_cart'];
    $ip = get_ip_address();
    if (isset($_SESSION['user_name'])) {
      $user_name = $_SESSION['user_name'];
      $select_cart_query = "SELECT * FROM `cart_details` WHERE product_id = $product_id AND user_name = '$user_name'";
      $result_select_cart_query = mysqli_query($conn, $select_cart_query);
      $num_rows_affected_select = mysqli_num_rows($result_select_cart_query);
      if ($num_rows_affected_select > 0) {
        echo "<script>window.open('users_area/user_order.php','_self')</script>";
      } else {


        $insert_to_cart_query = "INSERT INTO `cart_details` (product_id, ip_address,user_name, quantity) VALUES ($product_id,'$ip','$user_name','1')";
        $result_insert_cart = mysqli_query($conn, $insert_to_cart_query);
        echo "<script>window.open('users_area/user_order.php','_self')</script>";
      }
    } else {
      $select_cart_query = "SELECT * FROM `cart_details` WHERE product_id = $product_id AND ip_address = '$ip'";
      $result_select_cart_query = mysqli_query($conn, $select_cart_query);
      $num_rows_affected_select = mysqli_num_rows($result_select_cart_query);
      if ($num_rows_affected_select > 0) {
        echo "<script>window.open('users_area/user_order.php','_self')</script>";
      } else {


        $insert_to_cart_query = "INSERT INTO `cart_details` (product_id, ip_address, quantity) VALUES ($product_id,'$ip','1')";
        $result_insert_cart = mysqli_query($conn, $insert_to_cart_query);
        echo "<script>window.open('users_area/user_order.php','_self')</script>";
      }
    }
  }
}


// Removing item from Cart function

function remove_cart_item()
{
  global $conn;
  // Removing item to Cart php code 
  if (isset($_REQUEST['remove_item_btn'])) {
    $product_id = $_REQUEST['product_id'];
    $ip = get_ip_address();
    $delete_cart_sql = "DELETE FROM `cart_details` WHERE product_id ='$product_id' AND ip_address ='$ip'";
    $result_delete_cart = mysqli_query($conn, $delete_cart_sql);
  }
}


// Updating Cart item function 
function update_cart_item()
{
  global $conn;
  if (isset($_REQUEST['update_cart'])) {
    $update_qty = $_REQUEST['update_quantity'];
    $product_id = $_REQUEST['product_id'];
    $ip = get_ip_address();
    $sql_update_qty = "UPDATE `cart_details` SET `quantity` = '$update_qty' WHERE `ip_address` = '$ip' AND product_id = '$product_id'";
    $result_sql_update_qty = mysqli_query($conn, $sql_update_qty);
  }
}
// Updating order item function 
function update_order_item()
{
  global $conn;
  if (isset($_REQUEST['update_cart'])) {
    $update_qty = $_REQUEST['update_quantity'];
    $product_id = $_REQUEST['update_cart'];
    $ip = get_ip_address();
    $sql_update_qty = "UPDATE `cart_details` SET `quantity` = '$update_qty' WHERE `ip_address` = '$ip' AND product_id = '$product_id'";
    $result_sql_update_qty = mysqli_query($conn, $sql_update_qty);
  }
}

//count the number of items in the cart function\
function count_items_cart()
{
  global $conn;
  $num_rows_affected_select = 0;
  if (isset($_GET['add_to_cart'])) {
    $select_cart_query = "SELECT * FROM `cart_details`";
    $result_select_cart_query = mysqli_query($conn, $select_cart_query);
    $num_rows_affected_select = mysqli_num_rows($result_select_cart_query);
    return $num_rows_affected_select;
  } else {
    $select_cart_query = "SELECT * FROM `cart_details`";
    $result_select_cart_query = mysqli_query($conn, $select_cart_query);
    $num_rows_affected_select = mysqli_num_rows($result_select_cart_query);
    return $num_rows_affected_select;
  }
}


//Total Price calculation of the total number of items in the cart function
function total_cart_price()
{
  global $conn;
  $ip = get_ip_address();
  $grand_total = 0;
  $cart_qty = 1;
  $select_cart = "SELECT * FROM `cart_details` WHERE ip_address='$ip'";
  $result_select_cart = mysqli_query($conn, $select_cart);
  $num_rows = mysqli_num_rows($result_select_cart);
  while ($rows_in_cart = mysqli_fetch_assoc($result_select_cart)) {
    $product_id = $rows_in_cart['product_id'];
    $cart_qty = $rows_in_cart['quantity'];
    $select_product = "SELECT * FROM `products` WHERE product_id = $product_id";
    $result_select_product = mysqli_query($conn, $select_product);
    $total_price = 0;

    while ($rows_in_product = mysqli_fetch_assoc($result_select_product)) {
      $product_price = $rows_in_product['product_price'];

      $shipping_price = $rows_in_product['shipping_price'];
      $shipping_price = $shipping_price * $cart_qty;
      $product_price_qty = $product_price * $cart_qty;
      $total_price = $total_price + $product_price_qty + $shipping_price;
      $grand_total += $total_price;
    }
  }
  return $grand_total;
}
