<?php
// change order status code
if (isset($_GET['change_status'])) {
    $change_status = $_GET['change_status'];
    $order_processing = "Processing";
    $order_shipped = "Shipped";
    $order_delivered = "Delivered";
    $order_id = $_GET['order_id'];
    if ($change_status === "Pending") {
        $select_order = "UPDATE `orders` SET order_status = '$order_processing' WHERE order_id = '$order_id'";
        $result_select_order = mysqli_query($conn, $select_order);
        if (isset($result_select_order)) {
            echo "<script>alert('Order status change to processing')</script>";
        }
    } elseif ($change_status === "Processing") {
        $shipped_date = date("Y-m-d H:i:s");
        $select_order = "UPDATE `orders` SET order_status = '$order_shipped',shipped_date = '$shipped_date' WHERE order_id = '$order_id'";
        $result_select_order = mysqli_query($conn, $select_order);
        if (isset($result_select_order)) {
            echo "<script>alert('Order status change to Shipped')</script>";
        }
    } elseif ($change_status === "Shipped") {
        $delivered_date = date("Y-m-d H:i:s");
        $select_order = "UPDATE `orders` SET order_status = '$order_delivered', delivered_date = '$delivered_date' WHERE order_id = '$order_id'";
        $result_select_order = mysqli_query($conn, $select_order);
        if (isset($result_select_order)) {
            echo "<script>alert('Order status change to Delivered')</script>";
        }
    }
}
?>

<div class="row">
    <div class="col-md-6 text-center">
        <h3 class="text-danger">Pending Orders</h3>

        <?php
        @session_start();
        // user not login redirection
        if (!isset($_SESSION['admin_user_name'])) {
            echo "<script>window.open('../index.php','_self')</script>";
        }
        $order_pending = "Pending";
        $order_processing = "Processing";
        $order_shipped = "Shipped";

        $select_order = "SELECT * FROM `orders` WHERE order_status= '$order_pending' OR order_status= '$order_processing' OR order_status= '$order_shipped' ORDER BY order_id DESC";
        $result_select_order = mysqli_query($conn, $select_order);
        $num_row_order = mysqli_num_rows($result_select_order);
        ?>

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
                $order_date = $order_rows['order_date'];
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
                $product_title = substr($product_title, 0, 30);
                $product_image = $fetch_product['product_image1'];

                // Displaying orders
                echo "  <div class='bg-light'>
                                <div class='bg-light mb-4'>
                                    <div class='row bg-white mt-3 mb-2'>
                                        <div class='col-md-10'>
                                            <div class='d-flex  mt-2'>
                                                <h5>Order<span class='text-info'>&nbsp;#$invoice_number</span></h5>
                                            </div>
                                            <p class='text-secondary d-flex small'>Placed on $make_date</p>
                                        </div>
                                    <div class='col-md-2'>
                                        <a href='./index.php?manage_order=$order_id' class='text-info'>MANAGE</a>
                                    </div>
                                </div>
                                <div class='row bg-white mb-2'>
                                    <div class='col-md-2'>
                                        <img src='../admin_area/product_images/$product_image' alt='' class='user-order-img mt-4'>
                                    </div>
                                    <div class='col-md-2 mt-4'>
                                            <p class='small'>$product_title...</p>
                                            <p class='small'>Unit Price: Rs:$unit_price/-</p>
                                            <p class='small'>Total Price: Rs:$total_amount/-</p>
                                     </div>
                                        <div class='col-md-1 mt-4'><span class='small text-secondary'> Qty:</span><span class='small'> $product_quantity</span> </div>";
                if ($order_status === "Pending") {
                    echo "
                                    <div class='col-md-2 mt-4'><span class='small text-success p-1 btn btn-warning'><a href = './index.php?all_orders&&change_status=$order_status&&order_id=$order_id' onclick='return checkdelete()' class='text-decoration-none'>$order_status</a></span></div>";
                }
                if ($order_status === "Processing") {
                    echo "
                                    <div class='col-md-2 mt-4'><span class='small p-1 btn btn-info'><a href = './index.php?all_orders&&change_status=$order_status&&order_id=$order_id' onclick='return checkdelete()' class='text-decoration-none text-white'>$order_status</a></span></div>";
                }
                if ($order_status === "Shipped") {
                    echo "
                                    <div class='col-md-2 mt-4'><span class='small text-success p-1 btn btn-success'><a href = './index.php?all_orders&&change_status=$order_status&&order_id=$order_id' onclick='return checkdelete()' class='text-decoration-none text-white'>$order_status</a></span></div>";
                }
                echo   "<div class='col-md-2 mt-4'><span class='small text-secondary'>$payment_method</span></div>";
                if ($order_status === "Delivered") {
                    echo "<div class='col-md-2 mt-4'><span class='text-success small'>Delivered On  $make_deliver_date_format </span></div>";
                } elseif ($order_status === "Shipped") {
                    echo "<div class='col-md-2 mt-4'><span class='text-success small'>Shipped On $make_shipped_date_format </span></div>";
                } else {

                    echo "<div class='col-md-2 mt-4'><span class='text-success small'>Get By $make_pickup_date - $make_deliver_date </span></div>";
                }
                echo "</div>
                     </div>
                     </div>";
            }
        } else {
            echo "<h3 class='text-secondary text-secondary pt-4 mb-5'>No Pending Orders Yet</h3>";
        }
        ?>
    </div>

    <div class="col-md-6">
        <h3 class="text-center text-success">Completed Orders</h3>

        <?php

        $delivered_orders = "Delivered";

        $select_order = "SELECT * FROM `orders` WHERE order_status= '$delivered_orders' ORDER BY order_id DESC";
        $result_select_order = mysqli_query($conn, $select_order);
        $num_row_order = mysqli_num_rows($result_select_order);
        ?>

        <hr>

        <?php

        if ($num_row_order >= 1) {
            while ($order_rows = mysqli_fetch_assoc($result_select_order)) {
                //fetching order details form order table
                $order_id = $order_rows['order_id'];
                $invoice_number = $order_rows['invoice_number'];

                // Delivered date calculation
                $delivered_date = $order_rows['delivered_date'];
                $create_deliver_date_only = date_create($delivered_date);
                $make_deliver_date_format = date_format($create_deliver_date_only, "d-m-Y");

                // pickup and deliver date operations
                $order_date = $order_rows['order_date'];
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
                $product_title = substr($product_title, 0, 30);
                $product_image = $fetch_product['product_image1'];
                $product_shipping_price = $fetch_product['shipping_price'];

                // Displaying orders
                echo "  <div class='bg-light'>
                                <div class='bg-light mb-4'>
                                    <div class='row bg-white mt-3 mb-2'>
                                        <div class='col-md-10'>
                                            <div class='d-flex  mt-2'>
                                                <h5>Order<span class='text-info'>&nbsp;#$invoice_number</span></h5>
                                            </div>
                                            <p class='text-secondary small'>Placed on $make_date</p>
                                        </div>
                                    <div class='col-md-2'>
                                        <a href='./index.php?manage_order=$order_id' class='text-info'>MANAGE</a>
                                    </div>
                                </div>
                                <div class='row bg-white mb-2'>
                                    <div class='col-md-2'>
                                        <img src='../admin_area/product_images/$product_image' alt='' class='user-order-img mt-4'>
                                    </div>
                                    <div class='col-md-2 mt-4'>
                                            <p class='small'>$product_title...</p>
                                            <p class='small'>Unit Price: Rs:$unit_price/-</p>
                                            <p class='small'>Total Price: Rs:$total_amount/-</p>
                                     </div>
                                        <div class='col-md-1 mt-4'>
                                        <p><span class='small text-secondary'> Qty:</span><span class='small'> $product_quantity</span></p>
                                        <p><span class='small text-secondary'> Shipping <br> Price:</span><span class='small'>&nbsp;$product_shipping_price</span></p> 
                                        </div>";
                if ($order_status === "Delivered") {
                    echo "
                                    <div class='col-md-2 mt-4'><span class='small text-success p-1 btn btn-danger text-white'>$order_status</span></div>";
                }
                echo   "<div class='col-md-2 mt-4'><span class='small text-secondary'>$payment_method</span></div>
                    <div class='col-md-2 mt-4'><span class='text-success small'>Delivered On  $make_deliver_date_format </span></div>
                 </div>
                </div>";
            }
        } else {
            echo "<h3 class='text-secondary text-center pt-4 mb-5'>No Orders Completed Yet</h3>";
        }
        ?>


    </div>
</div>


<script>
    function checkdelete() {
        return confirm("Are you sure to change the order status?");
    }
</script>