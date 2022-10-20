<?php  
//include constansts
include('config/constants.php'); 

//get the current values of the selected list
if(isset($_GET['list_id'])){
    //get list_id value
    $list_id = $_GET['list_id'];

    //connect DB
    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());

    //select db
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());

    //query to get values from db
    $sql = "SELECT * FROM tbl_lists WHERE list_id=$list_id";

    //execute query
    $res = mysqli_query($conn, $sql);

    //check if query successful or not
    if($res==true){
        //query successful
        //get value from db
        $row = mysqli_fetch_assoc($res); //value is array

        //printing $row array
        // print_r($row);

        //create individual variables.
        $list_name = $row['list_name'];
        $list_description = $row['list_description'];
    } else {
        //redirect to manage list
        header('location:'.SITEURL.'manage-list.php');
    }
}
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

    <div class="menu">
        <a href="<?php echo SITEURL; ?>">Home</a>
        <a href="<?php echo SITEURL; ?>manage-list.php">Manage Lists</a>
    </div>

    <h3>Update List Page</h3>

    <p>
        <?php 
        //check if session set
        if(isset($_SESSION['update_fail'])){
            echo $_SESSION['update_fail'];
            unset($_SESSION['update_fail']);
        }
        ?>
    </p>

    <form action="" method="POST">

    <table>
        <tr>
            <td>List Name</td>
            <td><input type="text" name="list_name" value="<?php echo $list_name; ?>" required="required" /></td>
        </tr>

        <tr>
            <td>List Description: </td>
            <td>
                <textarea name="list_description" id="" cols="30" rows="10">
                <?php echo $list_description; ?>
                </textarea>
            </td>
        </tr>

        <tr>
            <td><input type="submit" name="update" value="UPDATE"></td>
        </tr>
    </table>

    </form>

</body>
</html>

<?php 

//check if update has been clicked
if(isset($_POST['update'])){
    // echo "Button works";
    //get updated values from our form
    $list_name = $_POST['list_name'];
    $list_description = $_POST['list_description'];

    //connect DB
    $conn2 = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error());

    //select db
    $db_select2 =mysqli_select_db($conn2, DB_NAME);

    //query to update
    $sql2 = "UPDATE tbl_lists SET 
        list_name='$list_name',
        list_description='$list_description'
        WHERE list_id=$list_id
    ";

    //execute query
    $res2 = mysqli_query($conn2, $sql2);

    //check if successful
    if ($res2==true){
        //update successful
        //set message with session
        $_SESSION['update'] = "List Update Successful";

        //redirect to manage list
        header('location:'.SITEURL.'manage-list.php');
    } else {
        //update fail
        $_SESSION['update_fail'] = "Failed to update the List";

        //redirect to update list
        header('location:'.SITEURL.'update-list.php?list_id='.$list_id);
    }
}

?>