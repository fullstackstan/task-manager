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


    <p>
        <?php 
            if(isset($_SESSION['add_task'])){
                echo $_SESSION['add_task'];
                unset( $_SESSION['add_task']);
            }
        ?>
    </p>


    <div class="all-tasks">

        <a href="<?php SITEURL; ?>add-task.php">Add Task</a>

        <table>
            <tr>
                <th>S.N.</th>
                <th>Task Name</th>
                <th>Priority</th>
                <th>Deadline</th>
                <th>Actions</th>
            </tr>
            
            <?php 
            
                //connect db
                $conn = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error());

                //select db
                $db_select = mysqli_select_db($conn,DB_NAME);

                //create sql query to get data from db
                $sql = "SELECT * FROM tbl_tasks";

                //execute query
                $res = mysqli_query($conn, $sql);

                //check if query successful.
                if($res==true){
                    //display the tasks from db
                    //count the tasks on db first
                    $count_rows = mysqli_num_rows($res);

                    //create sn hack
                    $sn=1;

                    //check if db empty
                    if($count_rows>0){
                        //there is data is db
                        while($row=mysqli_fetch_assoc($res)){
                            $task_id =$row['task_id'];
                            $task_name =$row['task_name'];
                            $priority =$row['priority'];
                            $deadline =$row['deadline'];
                            ?>

                            <tr>
                                <td><?php echo $sn++; ?>.</td>
                                <td><?php echo $task_name; ?></td>
                                <td><?php echo $priority; ?></td>
                                <td><?php echo $deadline; ?></td>
                                <td>
                                    <a href="#">Update</a>

                                    <a href="#">Delete</a>
                                </td>
                            </tr>

                            <?php
                        }
                    } else {
                        //no data in db
                        ?>
                        <tr>
                            <td colspan="5">No Task Added Yet.</td>
                        </tr>
                        <?php
                    }

                }

            ?>


            
        </table>

    </div>
    <!-- Tasks End -->
</body>
</html> 