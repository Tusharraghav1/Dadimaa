<?php
include '../config/db.php';

if(isset($_POST['add'])){

    $name = $_POST['product_name'];
    $price = $_POST['price'];

    mysqli_query($conn,
    "INSERT INTO products(product_name,price)
    VALUES('$name','$price')");
}
?>

<form method="POST">

    <input type="text"
    name="product_name"
    placeholder="Product Name">

    <input type="number"
    name="price"
    placeholder="Price">

    <button name="add">
        Add Product
    </button>

</form>