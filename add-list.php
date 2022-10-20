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
    <a href="<?php echo SITEURL; ?>">Home</a>
    <a href="<?php echo SITEURL; ?>manage-list.php">Manage List</a>

    <h3>Add List Page</h3>
    <p>
        <?php 
        // check if session created
        if(isset($_SESSION['add_fail']))
        {
            // display session message
            echo $_SESSION['add_fail'];
            // remove message after display
            unset($_SESSION['add_fail']);
        }
        ?>
    </p>


    <!-- Form to add list -->

    <form action="" method="POST">

        <table>
            <tr>
                <td>List Name</td>
                <td><input type="text" name="list_name" placeholder="Type list name here" required="required"/></td>
            </tr>
            <tr>
                <td>List Description</td>
                <td><textarea name="list_description" id="" cols="30" rows="10" placeholder="Type List Description Here"></textarea></td>
            </tr>

            <tr>
                <td><input type="submit" name="submit" value="Save"></td>
            </tr>
        </table>

    </form>

    <!-- Form to add list end -->
</body>
</html>

<?php

// check form submit
if(isset($_POST['submit']))
{
    // echo "Form Submitted";
    $list_name = $_POST['list_name'];
    $list_description = $_POST['list_description'];

    // connect DB
    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());

    // check db connected
    if($conn==true){
        echo "DB connected";
    }

    // select DB
    $db_select = mysqli_select_db($conn, DB_NAME);

    // check connect select
    if($db_select==true){
        echo "DB Selected";
    }
// SQL query to insert data
    $sql = "INSERT INTO tbl_lists SET
        list_name = '$list_name',
        list_description = '$list_description'
    ";

    // execute query and insert
    $res = mysqli_query($conn, $sql);

    // check if query successful
    if($res==true){
        // data inserted successfully
        // echo "Data inserted successfully";

        // create session var to display message
        $_SESSION['add'] = "List added successfully";

        // Redirect to Manage List
        header('location:'.SITEURL.'manage-list.php');

    } else {
        // failed insert
        // echo "Failed Data Insert";


        // create session var to display message
        $_SESSION['add_fail'] = "List Add Failed";

        // redirect to add list
        header('location:'.SITEURL.'add-list.php');
    }
}


?>