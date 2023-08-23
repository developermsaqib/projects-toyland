<?php
// fetch category
if (isset($_GET['edit_category'])) {
    $category_id = $_GET['edit_category'];
    $select_category = "SELECT* FROM categories WHERE category_id = '$category_id'";
    $result_select_query = mysqli_query($conn, $select_category) or die("select failed");
    $fetch_category = mysqli_fetch_assoc($result_select_query);
    $category_title = $fetch_category['category_title'];
}
// update category
if (isset($_POST['update_category'])) {
    $update_category_title = $_POST['cat_title'];
    $update_category = "UPDATE `categories` SET category_title = '$update_category_title' WHERE category_id = '$category_id'";
    $result_update_query = mysqli_query($conn, $update_category);
    if (isset($result_update_query)) {
        echo "<script>alert('Category Updated')</script>";
        echo " <script>window.open('./index.php?view_categories','_self')</script>";
    }
}

?>
<h3 class="text-center mb-4"> Edit Category</h3>
<form action="" method="post" class="w-50 m-auto">

    <div class="input-group mb-3">
        <span class="input-group-text bg-info" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
        <input type="text" class="form-control" name="cat_title" value="<?php echo $category_title; ?>" aria-label="Insert Categories" aria-describedby="basic-addon1" required>
    </div>
    <div class="input-group mb-2">
        <input type="submit" value="Update Category" name="update_category" class="btn-info p-2 text-light border-0 form-control ">

    </div>

    <a href="./index.php?view_categories" class="btn btn-info px-4">Back</a>
</form>