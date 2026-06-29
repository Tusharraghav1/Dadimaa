<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../config/db.php';

if(isset($_GET['id'])){

    $id = $_GET['id'];

    echo "Deleting Product ID: " . $id . "<br>";

    $delete = mysqli_query($conn,
    "DELETE FROM products WHERE id='$id'");

    if($delete){
        echo "Product Deleted Successfully";
        header("refresh:2;url=products.php");
    }else{
        echo mysqli_error($conn);
    }

}else{
    echo "ID Not Found";
}
?>