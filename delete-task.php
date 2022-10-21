<?php 
//include constants
include('config/constants.php');

//check task_id in url
if(isset($_GET['task_id'])){
    //task id is present, go ahead and delete
    //get task id
    $task_id = $_GET['task_id'];

    //connect db
    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());

    //select db
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());

    //sql query to delete
    $sql = "DELETE FROM tbl_tasks WHERE task_id=$task_id";

    //execute query
    $res = mysqli_query($conn,$sql);

    //check is query successful
    if($res==true){
        //query successful and task deleted
        $_SESSION['delete_task'] = "Task Deleted Successfully";

        //redirect to home
        header('location:'.SITEURL);
    } else {
        //failed to delete task
        $_SESSION['delete_task_fail'] = "Failed to Delete Task";

        //redirect to home
        header('location:'.SITEURL);
    }

} else {
    //redirect to home
    header('location:'.SITEURL);
}

?>