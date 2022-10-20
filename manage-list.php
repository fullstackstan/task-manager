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

    <p>
        <?php
        
        // check if session set
        if(isset($_SESSION['add'])){
            // display message 
            echo $_SESSION['add'];
            // then  remove message
            unset($_SESSION['add']);
        }

        //check the session for delete success
        if(isset($_SESSION['delete'])){
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
            
        }

        //check the session for update
        if(isset($_SESSION['update'])){
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        // check session for delete fail
        if(isset($_SESSION['delete_fail'])){
            echo $_SESSION['delete_fail'];
            unset($_SESSION['delete_fail']);
            
        }


        ?>
    </p>

    <!-- Table for lists -->
    <div class="all-lists">

        <a href="<?php echo SITEURL; ?>add-list.php">Add List</a>

        <table>
            <tr>
                <th>S.N.</th>
                <th>List Name</th>
                <th>Action</th>
            </tr>

            <?php
            
                // connect db
                $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error()); 

                // select db
                $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());

                //sql query to display data
                $sql = "SELECT * FROM tbl_lists";

                // exectue sql
                $res = mysqli_query($conn, $sql);

                // check if successful
                if($res==true){
                    //display data
                    // echo "SQL executed successfully";

                    //count rows of data
                    $count_rows = mysqli_num_rows($res);

                    //create sn variable
                    $sn = 1;

                    //check if data in db.
                    if($count_rows>0){
                        //there is data

                        while($row=mysqli_fetch_assoc($res)){
                            //getting data from db
                            $list_id = $row['list_id'];
                            $list_name = $row['list_name'];
                            ?>

                            <tr>
                                <td><?php echo $sn++?>.</td>
                                <td><?php echo $list_name?></td>
                                <td>
                                    <a href="<?php echo SITEURL?>update-list.php?list_id=<?php echo $list_id?>">Update</a>
                                    <a href="<?php echo SITEURL; ?>delete-list.php?list_id=<?php echo $list_id; ?>">Delete</a>
                                </td>
                            </tr>

                            <?php
                        }

                    } else {
                        // no data in db
                        ?>
                        <tr>
                            <td colspan="3">There are no lists in DB</td>
                        </tr>
                        <?php
                    }

                }

            ?>
            
        </table>
    </div>
    <!-- Table for lists -->
</body>
</html>