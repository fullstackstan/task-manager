<?php
    include('config/constants.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager with PHP and MySQL</title>
</head>
<body>
    <h1>Task Manager</h1>

    <a href="<?php echo SITEURL; ?>">Home</a>

    <h3>Manage Lists Page</h3>

    <!-- Table for lists -->
    <div class="all-lists">

        <a href="<?php echo SITEURL; ?>add-list.php">Add List</a>

        <table>
            <tr>
                <th>S.N.</th>
                <th>List Name</th>
                <th>Action</th>
            </tr>
            <tr>
                <td>1.</td>
                <td>Todo</td>
                <td>
                    <a href="#">Update</a>
                    <a href="#">Delete</a>
                </td>
            </tr>
            <tr>
                <td>2.</td>
                <td>In Progress</td>
                <td>
                    <a href="#">Update</a>
                    <a href="#">Delete</a>
                </td>
            </tr>
        </table>
    </div>
    <!-- Table for lists -->
</body>
</html>