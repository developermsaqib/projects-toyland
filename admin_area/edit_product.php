<?php
$edit_product_id = $_GET['edit_product'];
$select_product = "SELECT * FROM `products` WHERE product_id = '$edit_product_id'";
$result_select_product = mysqli_query($conn, $select_product);
$fetch_product_data = mysqli_fetch_assoc($result_select_product);
$product_title = $fetch_product_data['product_title'];
$product_description = $fetch_product_data['product_description'];
$product_keywords = $fetch_product_data['product_keywords'];
$product_quantity = $fetch_product_data['product_quantity'];
$product_category_title = $fetch_product_data['category_title'];
$product_age = $fetch_product_data['age'];
$product_price = $fetch_product_data['product_price'];
$product_image1 = $fetch_product_data['product_image1'];
$product_image2 = $fetch_product_data['product_image2'];
$product_image3 = $fetch_product_data['product_image3'];
$product_video = $fetch_product_data['product_video'];




if (isset($_POST['update_product'])) {
    $update_product_title = $_POST['product_title'];
    if ($update_product_title == "") {
        $update_product_title = $product_title;
    }

    $update_product_description = $_POST['product_description'];
    if ($update_product_description == "") {
        $update_product_description = $product_description;
    }
    $update_product_keywords = $_POST['product_keywords'];
    if ($update_product_keywords == "") {
        $update_product_keywords = $product_keywords;
    }

    $update_product_quantity = $_POST['quantity'];
    if ($update_product_quantity == "") {
        $update_product_quantity = $product_quantity;
    }

    $update_product_category_title = $_POST['category_title'];
    if ($update_product_category_title == "") {
        $update_product_category_title = $product_category_title;
    }

    $update_product_age = $_POST['age'];
    if ($update_product_age == "") {
        $update_product_age = $product_age;
    }

    $update_product_price = $_POST['product_price'];
    if ($update_product_price == "") {
        $update_product_price = $product_price;
    }

    $update_product_image1 = $_FILES['product_image1']['name'];
    if ($update_product_image1 == "") {
        $update_product_image1 = $product_image1;
    } else {
        $update_product_image1_tmp = $_FILES['product_image1']['tmp_name'];
        move_uploaded_file($update_product_image1_tmp, "./product_images/$update_product_image1");
        unlink("./product_images/$product_image1");
    }

    $update_product_image2 = $_FILES['product_image2']['name'];

    if ($update_product_image2 == "") {
        $update_product_image2 = $product_image2;
    } else {
        $update_product_image2_tmp = $_FILES['product_image2']['tmp_name'];
        move_uploaded_file($update_product_image2_tmp, "./product_images/$update_product_image2");
        unlink("./product_images/$product_image2");
    }

    $update_product_image3 = $_FILES['product_image3']['name'];

    if ($update_product_image3 == "") {
        $update_product_image3 = $product_image3;
    } else {
        $update_product_image3_tmp = $_FILES['product_image3']['tmp_name'];
        move_uploaded_file($update_product_image3_tmp, "./product_images/$update_product_image3");
        unlink("./product_images/$product_image3");
    }
    //update product video
    $update_product_video = $_FILES['update_product_video']['name'];

    if ($update_product_video == "") {
        $update_product_video = $product_video;
    } else {
        $update_product_video_tmp = $_FILES['update_product_video']['tmp_name'];
        move_uploaded_file($update_product_video_tmp, "./product_videos/$update_product_video");
        unlink("./product_videos/$product_video");
    }



    $status = "true";



    $update_product_query = "UPDATE `products` SET `product_title`=' $update_product_title',`category_title`=' $update_product_category_title',`product_description`='$update_product_description',`product_keywords`='$update_product_keywords',`product_quantity`='$update_product_quantity',`age`='$update_product_age',`product_image1`='$update_product_image1',`product_image2`='$update_product_image2',`product_image3`='$update_product_image3',`product_price`='$update_product_price',`status`='$status'  WHERE product_id = $edit_product_id ";
    $result_update = mysqli_query($conn, $update_product_query);
    if (isset($result_update)) {
        echo "<script>alert('Product Updated')</script>";
        echo  "<script>window.open('./index.php?view_products','_self')</script>";
    }
}


?>
<div class="container mt-3">
    <h2 class="text-center">Edit Product</h2>
    <!-- form -->
    <form action="" class="form-group w-50 m-auto" method="post" enctype="multipart/form-data">
        <!-- Product title -->
        <div class="form-outline mb-4">
            <label for="product_title" class="form-label">Product title</label>
            <input type="text" id="product_title" class="form-control" name="product_title" aria-label="Product title" value="<?php echo $product_title; ?>" required>
        </div>
        <!-- Select Category -->
        <div class="form-outline mb-4">
            <select name="category_title" id="category_title" class="form-select">
                <option selected><?php echo $product_category_title ?></option>
                <?php
                $select_categories = "SELECT * FROM categories";
                $result_select = mysqli_query($conn, $select_categories);
                $num_rows_affected = mysqli_num_rows($result_select);
                if ($num_rows_affected > 0) {
                    while ($rows_categories = mysqli_fetch_assoc($result_select)) {
                        $category_title = $rows_categories['category_title'];
                        $category_id = $rows_categories['category_id'];
                        if ($category_title != $product_category_title) {
                            echo "<option value='$category_title'>$category_title</option>";
                        }
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
            <input type="text" name="product_description" id="product_description" class="form-control" value="<?php echo $product_description; ?>" required>
        </div>
        <!-- Product Keywords -->
        <div class="form-outline mb-4">
            <label for="product_keywords" class="form-label">Product Keywords</label>
            <input type="text" name="product_keywords" id="product_keywords" class="form-control" value="<?php echo $product_keywords; ?>" required>
        </div>
        <!-- Quantity -->
        <div class="form-outline mb-4">
            <label for="quantity" class="form-label">Quantity</label>
            <input type="text" name="quantity" id="quantity" class="form-control" value="<?php echo $product_quantity; ?>" required>
        </div>
        <!-- Age -->
        <div class="form-outline mb-4">
            <label for="age" class="form-label">Age</label>
            <input type="text" name="age" id="age" class="form-control" value="<?php echo $product_age; ?>" required>
        </div>
        <!-- Product Image 1 -->
        <div class="form-outline mb-4">
            <label for="product_image1" class="form-label">Product Image 1</label>
            <div class="d-flex">
                <input type="file" class="form-control" id="product_image1" name="product_image1">
                <img src="./product_images/<?php echo $product_image1; ?>" alt="Product Image" class="order-img">
            </div>
        </div>
        <!-- Product Image 2 -->
        <div class="form-outline mb-4">
            <label for="product_image2" class="form-label">Product Image 2</label>
            <div class="d-flex">
                <input type="file" class="form-control" id="product_image2" name="product_image2">
                <img src="./product_images/<?php echo $product_image2; ?>" alt="Product Image" class="order-img">
            </div>
        </div>
        <!-- Product Image 3-->
        <div class="form-outline mb-4">
            <label for="product_image3" class="form-label">Product Image 3</label>
            <div class="d-flex">
                <input type="file" class="form-control" id="product_image3" name="product_image3">
                <img src="./product_images/<?php echo $product_image3; ?>" alt="Product Image" class="order-img">
            </div>
        </div>
        <!-- Product video -->
        <div class="form-outline mb-4">
            <label for="update_product_video" class="form-label">Product video</label>
            <div class="d-flex">
                <input type="file" class="form-control" id="update_product_video" name="update_product_video">
                <video src="./product_videos/<?php echo $product_video; ?>" alt="Video" class="order-img" controls>
            </div>
        </div>
        <!-- Product Price -->
        <div class="form-outline mb-4">
            <label for="product_price" class="form-label">Price</label>
            <input type="text" name="product_price" id="product_price" class="form-control" value="<?php echo $product_price; ?>" required>
        </div>
        <!-- Submit Button -->
        <div class="form-outline mb-4">
            <input type="submit" name="update_product" value="Update Product" class="btn btn-info">
            <a href="./index.php?view_products" class="btn btn-info mx-3 px-4">Back</a>
        </div>

    </form>
</div>