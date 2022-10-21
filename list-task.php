<?php
//include constants
include('config/constants.php');
//get list id from url
$list_id_url = $_GET['list_id']
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
     <!-- Menu -->
     <div class="menu">
<a href="<?php echo SITEURL; ?>">Home</a>

<?php 

//displaying list from db in our menu

//conncet db
$conn2 = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error());

//select db
$db_select2 = mysqli_select_db($conn2,DB_NAME) or die(mysqli_error());

//query to get list from db
$sql2 = "SELECT * FROM tbl_lists";

//execute query
$res2= mysqli_query($conn2, $sql2);

//check if query successful
if($res2==true){
    //diplay the lists in menu
    while($row2=mysqli_fetch_assoc($res2)){
        $list_id = $row2['list_id'];
        $list_name = $row2['list_name'];
        ?>

        <a href="<?php echo SITEURL; ?>list-task.php?list_id=<?php echo $list_id; ?>"><?php echo $list_name; ?></a>

        <?php
    }
}

?>


<a href="<?php echo SITEURL; ?>manage-list.php">Manage Lists</a>
</div>
    <!-- Menu End -->

    <h3>List Task Page</h3>

    <div class="all-tasks">
        <a href="<?php echo SITEURL?>add-task.php"></a>

        <table>
            <tr>
                <th>S.N.</th>
                <th>Task Name</th>
                <th>Priority</th>
                <th>Deadline</th>
                <th>Actions</th>
            </tr>
            <?php 
            
            $conn = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error());

            //select db
            $db_select = mysqli_select_db($conn,DB_NAME) or die(mysqli_error());

            //query to display task by list
            $sql = "SELECT * FROM tbl_tasks WHERE list_id=$list_id_url";

            //execute query
            $res = mysqli_query($conn,$sql);

            //check if successful
            if($res==true){
                //display tasks based on list
                //count rows
                $count_rows = mysqli_num_rows($res);

                if($count_rows>0){
                    //we have task on this list
                    while($row=mysqli_fetch_assoc($res)){
                        $task_id=$row['task_id'];
                        $task_name=$row['task_name'];
                        $priority=$row['priority'];
                        $deadline=$row['deadline'];
                        ?>

                    <tr>
                        <td>1.</td>
                        <td><?php echo $task_name; ?></td>
                        <td><?php echo $priority; ?></td>
                        <td><?php echo $deadline; ?></td>
                        <td>
                            <a href="<?php echo SITEURL; ?>update-task.php?task_id=<?php echo $task_id; ?>">Update</a>

                            <a href="<?php echo SITEURL; ?>delete-task.php?task_id=<?php echo $task_id; ?>">Delete</a>
                        </td>
                    </tr>

                        <?php
                    }
                } else {
                    //no tasks on this list
                    ?>

                    <tr>
                        <td colspan="5">No Tasks have been added to this list</td>
                    </tr>

                    <?php
                }
            }
            
            ?>

            
        </table>
    </div>
</body>
</html>