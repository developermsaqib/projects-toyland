

<?php
if (isset($_GET['delete_product'])) {
    $delete_product_id = $_GET['delete_product'];
    $select_product = "SELECT * FROM `products` WHERE product_id = '$delete_product_id'";
    //deleting the images 
    $result_select = mysqli_query($conn, $select_product);
    $fetch_image_data = mysqli_fetch_assoc($result_select);
    $product_image1 = $fetch_image_data['product_image1'];
    $product_image2 = $fetch_image_data['product_image2'];
    $product_image3 = $fetch_image_data['product_image3'];
    $product_video = $fetch_image_data['product_video'];
    unlink("./product_images/$product_image1");
    unlink("./product_images/$product_image2");
    unlink("./product_images/$product_image3");
    unlink("./product_videos/$product_video");
    //delete products form the cart
    $delete_from_cart = "DELETE FROM `cart_details` WHERE product_id = '$delete_product_id'";
    $result_delete_cart = mysqli_query($conn, $delete_from_cart);
    // delete products
    $delete_product_query = "DELETE FROM `products`  WHERE product_id = '$delete_product_id'";
    $result_delete_query = mysqli_query($conn, $delete_product_query);
    if (isset($result_delete_query)) {
        echo "<script>alert('Product Deleted')</script>";
        echo "<script>window.open('./index.php?view_products','_self')</script>";
    }
}
