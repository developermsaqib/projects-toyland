<?php

if (isset($_GET['delete_category'])) {
    $delete_category_id = $_GET['delete_category'];
    $delete_category = "DELETE FROM `categories`  WHERE category_id = '$delete_category_id'";
    $result_delete_query = mysqli_query($conn, $delete_category);
    if (isset($result_delete_query)) {
        echo "<script>alert('Category Deleted')</script>";
        echo "<script>window.open('./index.php?view_categories','_self')</script>";
    }
}
