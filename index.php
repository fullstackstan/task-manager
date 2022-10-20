<?php
    include('config/constants.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager App with PHP and MySQL</title>
</head>
<body>
    <h1>Task Manager</h1>

    <!-- Menu -->
    <div class="menu">
<a href="<?php echo SITEURL; ?>">Home</a>

<a href="#">Todo</a>
<a href="#">In Progress</a>
<a href="#">Done</a>

<a href="<?php echo SITEURL; ?>manage-list.php">Manage Lists</a>
</div>
    <!-- Menu End -->

    <!-- Tasks Start -->
    <div class="all-tasks">

        <a href="#">Add Task</a>

        <table>
            <tr>
                <th>S.N.</th>
                <th>Task Name</th>
                <th>Priority</th>
                <th>Deadline</th>
                <th>Actions</th>
            </tr>

            <tr>
                <td>1.</td>
                <td>Design Website</td>
                <td>Medium</td>
                <td>10/19/2022</td>
                <td>
                    <a href="#">Update</a>

                    <a href="#">Delete</a>
                </td>
            </tr>
        </table>

    </div>
    <!-- Tasks End -->
</body>
</html>