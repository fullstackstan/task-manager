<?php 
// echo "Delete List Page"
//include constants
include("config/constants.php");

// check if the list_id is assigned
if(isset($_GET['list_id'])){
    //delete the list from db

    //get the list_id value from url get method
    $list_id = $_GET['list_id'];

    //connect db
    $conn = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error());

    //select db
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());

    //write DELETE query
    $sql = "DELETE FROM tbl_lists WHERE list_id=$list_id";

    //execute the query
    $res =mysqli_query($conn, $sql);

    //check for delete success
    if($res==true){
        //query was successful. list was deleted
        $_SESSION['delete'] = "List Deleted Successfully";

        //redirect
        header('location:'.SITEURL.'manage-list.php');
    } else {
        //delete failed
        $_SESSION['delete_fail'] = "Failed to delete the list";
        header('location:'.SITEURL.'manage-list.php');
    }

} else {
    //redirect to manage list
    header('location:'.SITEURL.'manage-list.php');
}


?>