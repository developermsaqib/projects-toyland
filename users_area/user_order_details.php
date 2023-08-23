<?php
@session_start();
// user not login redirection
if (!isset($_SESSION['user_name'])) {
    echo "<script>window.open('../index.php','_self')</script>";
}
$user_name = $_SESSION['user_name'];
$select_user_id = "SELECT * FROM `users_table` WHERE user_name= '$user_name'";
$result_select_user = mysqli_query($conn, $select_user_id);
$fetch_user_id = mysqli_fetch_assoc($result_select_user);
$user_id = $fetch_user_id['user_id'];

$select_order = "SELECT * FROM `orders` WHERE user_id= '$user_id' ORDER BY order_id DESC";
$result_select_order = mysqli_query($conn, $select_order);
$num_row_order = mysqli_num_rows($result_select_order);
?>
<div class="container-fluid p-0">
    <h2 class="text-dark mb-3">My Orders</h2>
    <hr>

    <?php

    if ($num_row_order >= 1) {
        while ($order_rows = mysqli_fetch_assoc($result_select_order)) {
            //fetching order details form order table
            $order_id = $order_rows['order_id'];
            $invoice_number = $order_rows['invoice_number'];

            // pickup and deliver date operations
            // Shipped date calculations
            $order_date = $order_rows['order_date'];
            $shipped_date = $order_rows['shipped_date'];
            $create_shipped_date_only = date_create($shipped_date);
            $make_shipped_date_format = date_format($create_shipped_date_only, "d-m-Y");

            // Delivered date calculation
            $delivered_date = $order_rows['delivered_date'];
            $create_deliver_date_only = date_create($delivered_date);
            $make_deliver_date_format = date_format($create_deliver_date_only, "d-m-Y");

            //expected delivery date calculations 
            $order_date_obj = date_create($order_date);
            $make_date = date_format($order_date_obj, "d-m-Y H:i A");
            $make_pickup_date = date_format($order_date_obj, "D j M");
            $create_deliver_date = date_add($order_date_obj, date_interval_create_from_date_string("7 days"));
            $make_deliver_date = date_format($create_deliver_date, "D j M");

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
                    <p class='text-secondary small'>Placed on $make_date</p>

                </div>
                <div class='col-md-2'>
                    <a href='./user_profile.php?manage_order=$order_id' class='text-info'>MANAGE</a>
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
                    <p class='small'>Total Price: Rs:$total_amount/-</p>
                </div>
                <div class='col-md-1 mt-4'><span class='small text-secondary'> Qty:</span><span class='small'> $product_quantity</span> </div>";
            if ($order_status === "Pending") {
                echo "
                                    <div class='col-md-2 mt-4'><span class='small text-success p-1 btn btn-warning'>$order_status</span></div>";
            }
            if ($order_status === "Processing") {
                echo "
                                    <div class='col-md-2 mt-4'><span class='small p-1 btn btn-info'>$order_status</span></div>";
            }
            if ($order_status === "Shipped") {
                echo "
                                    <div class='col-md-2 mt-4'><span class='small text-success p-1 btn btn-success text-white'>$order_status</span></div>";
            }
            if ($order_status === "Delivered") {
                echo "
                                    <div class='col-md-2 mt-4'><span class='small text-success p-1 btn btn-danger text-white'>$order_status</span></div>";
            }
            echo "<div class='col-md-2 mt-4'><span class='small text-secondary'>$payment_method</span></div>";
            if ($order_status === "Delivered") {
                echo "<div class='col-md-2 mt-4'><span class='text-success small'>Delivered On  $make_deliver_date_format </span></div>";
            } elseif ($order_status === "Shipped") {
                echo "<div class='col-md-2 mt-4'><span class='text-success small'>Shipped On $make_shipped_date_format </span></div>";
            } else {

                echo "<div class='col-md-2 mt-4'><span class='text-success small'>Get By $make_pickup_date - $make_deliver_date </span></div>";
            }
            echo "</div>;
        </div>";
        }
    } else {
        echo "<h3 class='text-danger pt-4 mb-5'>No Orders Yet</h3>
        <a href='../index.php'><button class='btn btn-info p-2 border-0 mt-3 '>Continue Shopping</button></a>";
    }
    ?>

</div>
</div>