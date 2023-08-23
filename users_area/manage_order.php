<?php
@session_start();
// user not login redirection
if (!isset($_SESSION['user_name'])) {
    echo "<script>window.open('../index.php','_self')</script>";
}
if (isset($_GET['manage_order'])) {
    $order_id = $_GET['manage_order'];
    $select_order = "SELECT * FROM `orders` WHERE order_id= '$order_id'";
    $result_select_order = mysqli_query($conn, $select_order);
?>
    <div class='container-fluid p-0'>
        <h2 class='mb-3'>Order Details</h2>
        <hr>

    <?php

    if (isset($result_select_order)) {
        $order_rows = mysqli_fetch_assoc($result_select_order);
        //fetching order details form order table
        $order_id = $order_rows['order_id'];
        $invoice_number = $order_rows['invoice_number'];
        $order_date = $order_rows['order_date'];
        $product_id = $order_rows['product_id'];
        $product_quantity = $order_rows['product_quantity'];
        $unit_price = $order_rows['unit_price'];
        $total_amount = $order_rows['total_amount'];
        $payment_method = $order_rows['payment_method'];
        $order_status = $order_rows['order_status'];
        $user_address = $order_rows['user_address'];
        $user_mobile = $order_rows['user_mobile'];
        $user_city = $order_rows['user_city'];
        $user_zip_code = $order_rows['user_zip_code'];
        // fetching title and image from products
        $select_product = "SELECT * FROM `products` WHERE product_id = '$product_id'";
        $result_select_product = mysqli_query($conn, $select_product);
        $fetch_product = mysqli_fetch_assoc($result_select_product);
        $product_title = $fetch_product['product_title'];
        $product_image = $fetch_product['product_image1'];
        $shipping_price = $fetch_product['shipping_price'];
        // Displaying orders
        echo "<div class='bg-light'>
        <div class='bg-light mb-4'>
            <div class='row bg-white mt-3 mb-2'>
                <div class='col-md-10'>
                    <div class='d-flex  mt-2'>
                        <h5>Order<span class='text-info'>&nbsp;#$invoice_number</span>
                        </h5>
                    </div>
                    <p class='text-secondary small'>Placed on $order_date</p>

                </div>
                <div class='col-md-2'>
                    <p>Total: Rs: $total_amount/-</p>
                </div>
            </div>
            <div class='row bg-white mb-2'>
                <div class='col-md-2'>
                    <img src='../admin_area/product_images/$product_image' alt='' class='user-order-img mt-4'>
                </div>
                <div class='col-md-3 mt-4'>
                    <p class='small'>$product_title</p>
                    <p class='small'>Unit Price: Rs:$unit_price/-</p>
                    <p class='small'>Shipping Price: Rs:$shipping_price/-</p>
                </div>
                <div class='col-md-1 mt-4'><span class='small text-secondary'> Qty:</span><span class='small'> $product_quantity</span> </div>
                <div class='col-md-1 mt-4'><span class='small text-secondary'>$order_status</span></div>
                <div class='col-md-2 mt-4'><span class='small text-secondary'>$payment_method</span></div>
                <div class='col-md-3 mt-4'><span class='text-success small'>Get By $order_date </span></div>
            </div>
            <div class='row bg-white mb-2'>
                <div class='col-md-6 pt-2'>
                    <h4>Shipping Address</h4>
                    <p>$user_address</p>
                    <p>$user_city</p>
                    <p>Postal Code: $user_zip_code</p>
                    <p>$user_mobile</p>
                </div>
                <div class='col-md-6 pt-2'>
                    <h4>Total Summary</h4>
                    <p>= $product_quantity x $unit_price X $shipping_price</p>
                    <p>Subtotal = $total_amount/-</p>
                    <span class='small text-secondary'>Paid by $payment_method</span>
                </div>
            </div>
        </div>

    </div>";
    } else {
        echo "<h3 class='text-danger'>No Orders Yet</h3>
        <a href='../index.php'><button class='btn btn-info p-2 border-0 mx-2 '>Continue Shopping</button></a>";
    }
}


    ?>



    </div>
    </div>


























    </div>