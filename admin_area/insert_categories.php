<?php
include('../includes/connection.php');
if ((isset($_POST['insert_cat']) && ($_POST['cat_title'] != ''))) {
    $category_title = $_POST['cat_title'];
    $select_query = "SELECT* FROM categories WHERE category_title = '$category_title'";
    $result_select_query = mysqli_query($conn, $select_query) or die("select failed");
    $rows = mysqli_num_rows($result_select_query);
    if ($rows > 0) {
        echo "<script>alert('Category Already Present')</script>";
    } else {
        $query = "INSERT INTO categories (category_title) VALUES ('$category_title')";
        $insert_cat = mysqli_query($conn, $query);
        echo "<script>alert('Category Inserted Successfully')</script>";
        if (!isset($insert_cat)) {
            echo "failed to insert catogory or Invalid Credentials!";
        }
    }
}

?>
<h3 class="text-center"> Insert Categories</h3>
<form action="" method="post" class="m-3">

    <div class="input-group w-90 mb-3">
        <span class="input-group-text bg-info" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
        <input type="text" class="form-control" placeholder="Type Category Name which you want to Insert " name="cat_title" aria-label="Insert Categories" aria-describedby="basic-addon1" required>
    </div>
    <div class="input-group w-20 mb-2">
        <input type="submit" value="Insert Category" name="insert_cat" class="btn-info p-2 text-light border-0 form-control ">
    </div>
</form>