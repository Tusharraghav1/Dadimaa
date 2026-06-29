




<?php
include '../config/db.php';

if(isset($_POST['submit']))
{
    $name  = $_POST['name'];
    $price = $_POST['price'];
    $grams = $_POST['grams'];

    // Image Upload
    $image = $_FILES['image']['name'];
    $tmp   = $_FILES['image']['tmp_name'];

    move_uploaded_file($tmp, "../assets/img/".$image);

    // Insert Product
    $query = "INSERT INTO products
              (product_name, price, image, grams)
              VALUES
              ('$name', '$price', '$image', '$grams')";

    mysqli_query($conn, $query);

    header("Location: products.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
    <link rel="stylesheet" href="../assets/css/add-product.css">
</head>
<body>

<div class="container">

    <div class="card">

        <h2>Add New Product</h2>

        <form method="POST">

            <input type="text"
                   name="name"
                   placeholder="Product Name"
                   required>

            <input type="number"
                   name="price"
                   placeholder="Price"
                   required>

            <button type="submit"
                    name="submit">
                Add Product
            </button>

        </form>

        <a href="products.php" class="back-btn">
            ← Back to Products
        </a>

    </div>

</div>

</body>
</html>