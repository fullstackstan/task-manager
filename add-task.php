<?php 
//include constants
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

    <a href="<?php echo SITEURL; ?>">Home</a>

    <h3>Add Task Page</h3>

    <p>
        <?php 
        //check add_task_fail session
        if(isset($_SESSION['add_task_fail'])){
            echo $_SESSION['add_task_fail'];
            unset($_SESSION['add_task_fail']);
        }
        ?>
    </p>

    <form action="" method="POST">
        <table>
            <tr>
                <td>Task Name:</td>
                <td><input type="text" name="task_name" placeholder="Type your task name" required="required"/></td>
            </tr> 
            
            <tr>
                <td>Task Description</td>
                <td><textarea name="task_description" placeholder="Type task description" id="" cols="30" rows="5"></textarea></td>
            </tr>

            <tr>
                <td>Select List: </td>
                <td>
                    <select name="list_id" id="">

                        <?php 
                        
                            //connect to db
                            $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());

                            //select db
                            $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());

                            //create query to get list 
                            $sql = "SELECT * FROM tbl_lists";

                            //execute query
                            $res = mysqli_query($conn, $sql);

                            //check success
                            if($res==true){
                                //create variable to count rows
                                $count_rows = mysqli_num_rows($res);

                                if($count_rows>0){
                                    //display all list on dropdown
                                    while($row=mysqli_fetch_assoc($res)){
                                        $list_id = $row['list_id'];
                                        $list_name = $row['list_name'];
                                        ?>
                                            <option value="<?php echo $list_id; ?>"><?php echo $list_name; ?></option>
                                        <?php

                                    }
                                } else {
                                    //display none as option
                                    ?>
                                    <option value="0">None</option>
                                    <?php
                                }
                            }
                        
                        ?>

                    </select>
                </td>
            </tr>

            <tr>
                <td>Priority</td>
                <td>
                    <select name="priority" id="">
                        <option value="High">High</option>
                        <option value="Medium">Medium</option>
                        <option value="Low">Low</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td>Deadline: </td>
                <td><input type="date" name="deadline"></td>
            </tr>

            <tr>
                <td><input type="submit" name="submit" value="Save" /></td>
            </tr>
        </table>
    </form>
</body>
</html>


<?php 
//check if save button is clicked

if(isset($_POST['submit'])){
    // echo "Button Clicked";
    //get all the values from the form
    $task_name = $_POST['task_name'];
    $task_description = $_POST['task_description'];
    $list_id = $_POST['list_id'];
    $priority = $_POST['priority'];
    $deadline = $_POST['deadline'];

    //connect to db again
    $conn2 = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error());

    //select db again
    $db_select2 = mysqli_select_db($conn2, DB_NAME) or die(mysqli_error());

    //create query to insert
    $sql2 = "INSERT INTO tbl_tasks SET
        task_name = '$task_name',
        task_description = '$task_description',
        list_id = $list_id,
        priority = '$priority',
        deadline = '$deadline'
    ";

    //execute query
    $res2 =mysqli_query($conn2, $sql2);

    //check if query successful
    if($res2==true){
        //execute successful
        $_SESSION['add_task'] = "Task Added Successfully";

        //redirect to home
        header('location:'.SITEURL);
    } else {
        //failed to add task
        $_SESSION['add_task_fail'] = "Failed to add Task";
        // redirect to add task page
        header('location:'.SITEURL.'add-task.php');
    }
}

?>