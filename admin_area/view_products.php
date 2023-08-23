<div class="container-fluid">
    <h3 class="text-center text-success mb-3">All Products</h3>
    <table class="table table-bordered">
        <?php
        $select_products = "SELECT * FROM `products`";
        $result_select_products = mysqli_query($conn, $select_products);
        $num_rows = mysqli_num_rows($result_select_products);
        if ($num_rows > 0) {
            echo "<thead class='bg-info text-center'>
                        <tr>
                            <th>#</th>
                            <th>Product title</th>
                            <th>Product Image</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Status</th>
                            <th colspan='2'>Operations</th>

                        </tr>
                     </thead>
            <tbody class='bg-light text-center'>
                 ";
            $sno = 0;
            while ($fetch_products = mysqli_fetch_assoc($result_select_products)) {
                $product_id = $fetch_products['product_id'];
                $product_title = $fetch_products['product_title'];
                $product_image = $fetch_products['product_image1'];
                $product_category = $fetch_products['category_title'];
                $product_qty = $fetch_products['product_quantity'];
                $product_price = $fetch_products['product_price'];
                $product_status = $fetch_products['status'];
                $sno++;
                echo "  
                 <tr>
                     <td>$sno</td>
                     <td>$product_title</td>
                     <td><img src='./product_images/$product_image' alt='' class='product-img'></td>
                     <td>$product_category</td>
                     <td>Rs:&nbsp;$product_price/-</td>
                     <td>$product_qty</td>
                     <td>$product_status</td>
                     <td><a href='./index.php?edit_product=$product_id' class='text-secondary text-decoration-none'>Edit</a></td>
                     <td><a href='./index.php?delete_product=$product_id' class='text-danger text-decoration-none' onclick='return checkdelete()'>Delete</a></td>
                </tr>


                 ";
            }
            echo "
            </tbody>
             </table>
            ";
        }
        ?>

</div>
<script>
    function checkdelete() {
        return confirm('Are You sure to Delete this product ?');
    }
</script>