<div class="container text-center">
    <?php
    $select_users = "SELECT * FROM `users_table`";
    $result_select_users = mysqli_query($conn, $select_users);
    $select_num_rows = mysqli_num_rows($result_select_users);
    if ($select_num_rows > 0) {
        echo "<table class='table table-hover table-secondary'>
    <thead>
        <tr>
            <th scope='col'>#</th>
            <th scope='col'>Email</th>
            <th scope='col'>City</th>
            <th scope='col'>Mobile</th>
        </tr>
    </thead>
    <tbody>";
        $sno = 0;
        while ($fetch_users_data = mysqli_fetch_assoc($result_select_users)) {
            $sno++;
            $user_email = $fetch_users_data['user_email'];
            $user_city = $fetch_users_data['user_city'];
            $user_mobile = $fetch_users_data['user_mobile'];

            echo "<tr>
    <th scope='row'>$sno</th>
    <td>$user_email</td>
    <td>$user_city</td>
    <td>$user_mobile</td>
</tr>";
        }
        echo "</tbody>
    </table>";
    } else {
        echo "No users present";
    }

    ?>



</div>