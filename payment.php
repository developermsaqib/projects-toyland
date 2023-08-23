<?php
$ip = get_ip_address();
$user_name;
if (isset($_SESSION['user_name'])) {
  $user_name = $_SESSION['user_name'];
} else {
  echo "<script>window.open('../checkout.php','_self')</script>";
}
$select_cart = "SELECT * FROM `cart_details` WHERE user_name='$user_name' or ip_address = '$ip'";
$result_select_cart = mysqli_query($conn, $select_cart);
$num_rows = mysqli_num_rows($result_select_cart);
if ($num_rows <= 0) {
  echo "<script>window.open('../index.php','_self')</script>";
}
?>


<div class="row">
  <div class="col-md-12 text-center my-4">
    <h2>Checkout</h2>
  </div>
</div>
<div class="div container-fluid px-5">

  <div class="row">
    <div class="col-md-3">
      <h4>Billing Address</h4>
      <p class="small text-success">You can change the billing information as Your requirements</p>
      <!-- form -->
      <form action="" class="form-group" method="post" enctype="multipart/form-data">
        <!-- displaying form data php code -->
        <?php
        $get_user_details = "SELECT * FROM `users_table` WHERE user_name = '$user_name'";
        $result_get_users = mysqli_query($conn, $get_user_details);
        $fetch_users_details = mysqli_fetch_assoc($result_get_users);
        $user_id = $fetch_users_details['user_id'];
        $user_email = $fetch_users_details['user_email'];
        $user_address = $fetch_users_details['user_address'];
        $user_city = $fetch_users_details['user_city'];
        $user_mobile = $fetch_users_details['user_mobile'];
        $user_zip_code = $fetch_users_details['user_zip_code'];

        ?>

        <!-- username -->
        <div class="form-outline mb-4">
          <label for="user_name" class="form-label small">Username</label>
          <input type="text" id="user_name" class="form-control" name="user_name" disabled value="<?php echo $user_name; ?>" autocomplete="off">
        </div>

        <!-- user_email -->
        <div class="form-outline mb-4">
          <label for="user_email" class="form-label small">Email Address</label>
          <input type="text" name="user_email" id="user_email" class="form-control" value="<?php echo $user_email; ?>" disabled>
        </div>
        <!-- Address -->
        <div class="form-outline mb-4">
          <label for="user_address" class="form-label small">Address</label>
          <input type="text" name="user_address" id="user_address" class="form-control" value="<?php echo $user_address; ?>">
        </div>

        <!-- User city -->
        <div class="form-outline mb-4">
          <label for="user_city" class="form-label small">City</label>
          <input type="text" name="user_city" id="user_city" class="form-control" value="<?php echo $user_city; ?>">
        </div>
        <!-- User mobile -->
        <div class="form-outline mb-4">
          <label for="user_mobile" class="form-label small">Mobile</label>
          <input type="text" name="user_mobile" id="user_mobile" class="form-control" value="<?php echo $user_mobile; ?>">
        </div>
        <!-- User zipcode -->
        <div class="form-outline mb-4">
          <label for="user_zip_code" class="form-label small">Zip Code/Postal Code</label>
          <input type="text" name="user_zip_code" id="user_zip_code" class="form-control" value="<?php echo $user_zip_code; ?>">
        </div>
        <h4>Select Payment Method</h4>
        <div class="container-fluid">
          <div class="form-check">
            <input class="form-check-input" type="radio" name="payment_method" id="visa_card" value="VisaCard">
            <label class="form-check-label" for="visa_card">
              Visa Card
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="payment_method" id="cash_on_delivery" value="Cash On Delivery" checked>
            <label class="form-check-label" for="cash_on_delivery">
              Cash on Delivery
            </label>



          </div>
        </div>
    </div>
    <div class="col-md-9 ">
      <h3 class="text-center">Review Order</h3>
      <table class="table mb-5 text-center">
        <thead>

          <?php
          global $conn;
          $ip = get_ip_address();
          $grand_total = 0;
          $s_no = 0;
          $cart_qty = 1;
          $no_product_msg = "";
          $select_cart = "SELECT * FROM `cart_details` WHERE user_name='$user_name' or ip_address = '$ip'";
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
          <?php
              echo "
          <tr>
            <th scope='row'>
              <p class='my-2 small'>$s_no</p>
            </th>
            <td>
              <p class='my-3 small'>$product_title</p>
            </td>
            <td><img src='../admin_area/product_images/$product_image1' alt='' class='order-img my-3'></td>
            <td><p>$cart_qty</p></td>
            <td>
              <p class='text-center  my-3'><strong>Rs:&nbsp;$product_price&nbsp;/-</strong></p>
            </td>
            <td>
              <p class='text-center my-3'><strong>Rs:&nbsp;$shipping_price&nbsp;/-</strong></p>
            </td>
            <td>
              <p class='text-center my-3'><strong>Rs:&nbsp;$total_price&nbsp;/-</strong></p>
            </td>
            <td>
";
              // remove btn disabled when product is 1
              if ($num_rows <= 1) {
                // echo "<input type='submit' name='remove_item_btn' id='remove_item-btn' value='Remove' class='btn btn-danger text-light p-1 border-0 my-3' disabled>";

                echo "<a href= '#' class='btn btn-danger text-light p-1 border-0 my-3'>Remove</a>";
              } else {
                // echo "<input type='submit' name='remove_item_btn' id='remove_item-btn' value='Remove' class='btn btn-danger text-light p-1 border-0 my-3'>";

                echo "<a href= './user_order.php?remove_item_btn=$product_id' class='btn btn-danger text-light p-1 border-0 my-3'>Remove</a>";
              }
          ?>
          </td>

          </tr>

      <?php
            }
          }

      ?>
        </tbody>
      </table>
      <h6 class="p-2">Total Products : <?php echo $num_rows; ?></h6>
      <h5 class="p-2">Subtotal = Rs:&nbsp; <strong class="text-info"><?php echo $grand_total; ?>/-</strong></h5>
      <div class="d-flex">
        <a href="../index.php"><button class="text-right btn btn-info p-2 border-0 mx-2 ">Continue Shopping</button></a>
        <!-- <a href="../checkout.php"><button class="btn btn-success text-light p-2 border-0 mx-2">Confirm Order</button></a> -->
        <input type="submit" name="order_confirm" id="order_confirm" class="btn btn-success text-light p-2 border-0 mx-2" value="Confirm Order">
        </form>
      </div>

    </div>
  </div>

</div>

<!-- Order confirmation php code -->

<?php
if (isset($_REQUEST['order_confirm'])) {
  $user_address = $_POST['user_address'];
  $user_city = $_REQUEST['user_city'];
  $user_mobile = $_REQUEST['user_mobile'];
  $user_zip_code = $_REQUEST['user_zip_code'];
  $payment_method = $_REQUEST['payment_method'];

  $select_cart_items = "SELECT * FROM `cart_details` WHERE user_name='$user_name' or ip_address = '$ip'";
  $result_select_cart_items = mysqli_query($conn, $select_cart_items);
  $num_rows = mysqli_num_rows($result_select_cart_items);
  if ($num_rows > 0) {
    while ($fetch_products = mysqli_fetch_assoc($result_select_cart_items)) {
      $product_id = $fetch_products['product_id'];
      $product_quantity = $fetch_products['quantity'];
      $select_product_table = "SELECT * FROM `products` WHERE product_id = '$product_id'";
      $result_product_table = mysqli_query($conn, $select_product_table);
      $fetch_products_table = mysqli_fetch_assoc($result_product_table);
      $product_price = $fetch_products_table['product_price'];
      $product_shipping_price = $fetch_products_table['shipping_price'];
      $product_table_quantity = $fetch_products_table['product_quantity'];

      $total_amount = $product_price * $product_quantity;
      $total_amount += $product_shipping_price;
      $invoice_number = mt_rand();
      $insert_order = "INSERT INTO `orders`(`unit_price`,`total_amount`, `user_id`, `user_address`, `user_mobile`, `user_city`, `user_zip_code`, `product_id`, `product_quantity`, `invoice_number`, `payment_method`, `order_date`, `order_status`) VALUES ('$product_price','$total_amount','$user_id','$user_address','$user_mobile','$user_city','$user_zip_code','$product_id','$product_quantity','$invoice_number','$payment_method',NOW(),'Pending')";
      $result_insert_order = mysqli_query($conn, $insert_order);
      // product quatity reducing after ordering the products
      $product_table_quantity -= $product_quantity;

      if ($product_table_quantity >= 0) {
        $update_product_qty_sql = "UPDATE `products` SET product_quantity= '$product_table_quantity' WHERE product_id = '$product_id'";
        $result_update_product_qty = mysqli_query($conn, $update_product_qty_sql);
      }

      if (isset($result_insert_order)) {
        $delete_cart_items = "DELETE FROM `cart_details` WHERE product_id='$product_id'";
        $result_delete = mysqli_query($conn, $delete_cart_items);
        if (isset($result_delete)) {
          echo "<script>alert('Order Confirmed')</script>";
          echo "<script>window.open('./user_profile.php','_self')</script>";
        }
      }
    }
  }
}
if (isset($_GET['remove_item_btn'])) {
  $product_id = $_GET['remove_item_btn'];
  $delete_order_item = "DELETE FROM `cart_details` WHERE (product_id = '$product_id' AND (user_name= '$user_name' or ip_address = '$ip'))";
  $result_delete_order = mysqli_query($conn, $delete_order_item);
  if (isset($result_delete_order)) {
    echo "<script>alert('product deleted')</script>";
    echo "<script>window.open('../checkout.php','_self')</script>";
  }
}

?>