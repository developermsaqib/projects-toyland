<?php
include('../includes/connection.php');
if (isset($_POST['insert_product'])) {
    $product_title = $_POST['product_title'];
    $category_title = $_POST['category_title'];
    $product_description = $_POST['product_description'];
    $product_keywords = $_POST['product_keywords'];
    $quantity = $_POST['quantity'];
    $age = $_POST['age'];
    $price = $_POST['price'];
    $shipping_price = $_POST['shipping_price'];
    $status = "true";


    // Accessing Images name
    $product_image1_name = $_FILES['product_image1']['name'];
    $product_image2_name = $_FILES['product_image2']['name'];
    $product_image3_name = $_FILES['product_image3']['name'];
    $product_video_name = $_FILES['product_video']['name'];

    // Accessing Images tmp_name
    $product_image1_tmp_name = $_FILES['product_image1']['tmp_name'];
    $product_image2_tmp_name = $_FILES['product_image2']['tmp_name'];
    $product_image3_tmp_name = $_FILES['product_image3']['tmp_name'];
    $product_video_tmp_name = $_FILES['product_video']['tmp_name'];

    // form validation checking

    if (($product_title == '') or ($category_title == '') or ($category_title == 'Select Product Category') or ($product_keywords == '') or ($quantity == '') or ($age == '') or ($price == '') or ($product_image1_name == '') or ($product_image2_name == '')) {
        echo "<script>alert('Please filled All the Required feilds')</script>";
    } else {
        // uploading images/video
        move_uploaded_file($product_image1_tmp_name, "product_images/$product_image1_name");
        move_uploaded_file($product_image2_tmp_name, "product_images/$product_image2_name");
        move_uploaded_file($product_image3_tmp_name, "product_images/$product_image3_name");
        move_uploaded_file($product_video_tmp_name, "product_videos/$product_video_name");

        // Product Inserting
        $insert_products = "INSERT INTO `products` (`product_title`, category_title, `product_description`, `product_keywords`, `product_quantity`, `age`, `product_image1`, `product_image2`, `product_image3`, `product_video`, `product_price`,`shipping_price`,`status`) VALUES ('$product_title', '$category_title', ' $product_description', ' $product_keywords', '$quantity', '$age', '$product_image1_name', '$product_image2_name', '$product_image3_name', '$product_video_name', '$price','$shipping_price','$status')";

        $result_insert = mysqli_query($conn, $insert_products) or die(mysqli_error($conn));
        if (isset($result_insert)) {
            echo "<script>alert('Products inserted successfully')</script>";
        } else {
            echo "<script>alert('Error Occurred')</script>";
        }
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Products| Admin Dashboard</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../style.css">

</head>

<body class="bg-light">
    <div class="container mt-3">


        <h2 class="text-center">Insert Products</h2>
        <!-- form -->
        <form action="" class="form-group w-50 m-auto" method="post" enctype="multipart/form-data">
            <!-- Product title -->
            <div class="form-outline mb-4">
                <label for="product_title" class="form-label">Product title</label>
                <input type="text" id="product_title" class="form-control" placeholder="Product title " name="product_title" aria-label="Product title" required>
            </div>
            <!-- Select Category -->
            <div class="form-outline mb-4">
                <select name="category_title" id="category_title" class="form-select">
                    <option selected>Select Product Category</option>
                    <?php
                    $select_categories = "SELECT * FROM categories";
                    $result_select = mysqli_query($conn, $select_categories);
                    $num_rows_affected = mysqli_num_rows($result_select);
                    if ($num_rows_affected > 0) {
                        while ($rows_categories = mysqli_fetch_assoc($result_select)) {
                            $category_title = $rows_categories['category_title'];
                            $category_id = $rows_categories['category_id'];
                            echo "<option value='$category_title'>$category_title</option>";
                        }
                    } else {
                        echo "<li><a class='dropdown-item' href='#'>Category NOT Available</a></li>";
                    }

                    ?>
                </select>
            </div>
            <!-- Product Description -->
            <div class="form-outline mb-4">
                <label for="product_description" class="form-label">Product Description</label>
                <input type="text" name="product_description" id="product_description" placeholder="Product Description" class="form-control" required>
            </div>
            <!-- Product Keywords -->
            <div class="form-outline mb-4">
                <label for="product_keywords" class="form-label">Product Keywords</label>
                <input type="text" name="product_keywords" id="product_keywords" class="form-control" placeholder="Product Keywords" required>
            </div>
            <!-- Quantity -->
            <div class="form-outline mb-4">
                <label for="quantity" class="form-label">Quantity</label>
                <input type="text" name="quantity" id="quantity" class="form-control" placeholder="Quantity" required>
            </div>
            <!-- Age -->
            <div class="form-outline mb-4">
                <label for="age" class="form-label">Age</label>
                <input type="text" name="age" id="age" class="form-control" placeholder="Age" required>
            </div>
            <!-- Product Image 1 -->
            <div class="form-outline mb-4">
                <label for="product_image1" class="form-label">Product Image 1</label>
                <input type="file" class="form-control" id="product_image1" name="product_image1" required>
            </div>
            <!-- Product Image 2 -->
            <div class="form-outline mb-4">
                <label for="product_image2" class="form-label">Product Image 2</label>
                <input type="file" class="form-control" id="product_image2" name="product_image2">
            </div>
            <!-- Product Image 3-->
            <div class="form-outline mb-4">
                <label for="product_image3" class="form-label">Product Image 3</label>
                <input type="file" class="form-control" id="product_image3" name="product_image3">
            </div>
            <!-- Product video -->
            <div class="form-outline mb-4">
                <label for="product_video" class="form-label">Product video</label>
                <input type="file" class="form-control" id="product_video" name="product_video">
            </div>
            <!-- Product Price -->
            <div class="form-outline mb-4">
                <label for="price" class="form-label">Price</label>
                <input type="text" name="price" id="price" class="form-control" placeholder="Price" required>
            </div>
            <!-- Shipping Price -->
            <div class="form-outline mb-4">
                <label for="shipping_price" class="form-label">Price</label>
                <input type="text" name="shipping_price" id="shipping_price" class="form-control" placeholder="Enter Shipping Price" required>
            </div>
            <!-- Submit Button -->
            <div class="form-outline mb-4">
                <input type="submit" name="insert_product" value="Insert Products" class="btn btn-info">
            </div>

        </form>
    </div>
    <!-- bootstrap js link -->
    <script src="../js/bootstrap.js"></script>
</body>

</html>