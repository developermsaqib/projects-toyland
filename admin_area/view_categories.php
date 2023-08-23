<div class="container">
    <h3 class="text-center text-success mb-3">All Categories</h3>

    <?php
    $select_category = "SELECT * FROM `categories`";
    $result_select = mysqli_query($conn, $select_category);
    $num_rows = mysqli_num_rows($result_select);
    if ($num_rows > 0) {

        echo "<table class='table table-bordered'>
        <thead class='bg-info text-center'>
            <tr>
                <th>#</th>
                <th>Category title</th>
                <th colspan='2'>Operations</th>
            </tr>
        </thead>
        <tbody class='bg-light text-center'>
        ";

        $sno = 0;
        while ($row = mysqli_fetch_assoc($result_select)) {
            $category_id = $row['category_id'];
            $category_title = $row['category_title'];
            $sno++;
            echo "
            <tr>
                <td>$sno</td>
                <td>$category_title</td>
                <td><a href='./index.php?edit_category=$category_id' class='text-decoration-none text-secondary'>Edit</a></td>
                <td><a href='./index.php?delete_category=$category_id' class='text-decoration-none text-danger' onclick='return checkdelete()'>Delete</a></td>
            </tr>
        ";
        }

        echo "
         </tbody>
        </table>";
    } else {
        echo "<h4 class='text-center text-danger'>No Category Available Yet</h4>";
    }
    ?>

</div>


<script>
    function checkdelete() {
        return confirm("Are you sure?");
    }
</script>