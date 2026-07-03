<?php

session_start();

if(!isset($_SESSION['admin'])){

header("Location: login.php");

exit();

}
include '../config/db.php';

if(!isset($_GET['id'])){
    header("Location: products.php");
    exit();
}

$id = intval($_GET['id']);

$product = mysqli_query($conn, "SELECT * FROM products WHERE id='$id'");

if(mysqli_num_rows($product) == 0){
    die("Product Not Found");
}

$row = mysqli_fetch_assoc($product);

if(isset($_POST['update'])){

    $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);

    // Default old image
    $image = $row['image'];

    // If new image selected
    if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){

        $image = time()."_".basename($_FILES['image']['name']);

        move_uploaded_file(
            $_FILES['image']['tmp_name'],
            "../assets/img/".$image
        );
    }

    $update = mysqli_query($conn,"
        UPDATE products
        SET
            product_name='$product_name',
            price='$price',
            image='$image'
        WHERE id='$id'
    ");

    if($update){
        header("Location: products.php");
        exit();
    }else{
        echo "Update Failed : ".mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>

<head>
 <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>

    <link rel="stylesheet" href="../assets/css/edit-product.css">

</head>

<body>

<div class="container">

    <h2>Edit Product</h2>

    <form method="POST" enctype="multipart/form-data">

        <div class="form-group">

            <label>Product Name</label>

            <input
                type="text"
                name="product_name"
                value="<?php echo htmlspecialchars($row['product_name']); ?>"
                required>

        </div>

        <div class="form-group">

            <label>Price</label>

            <input
                type="number"
                step="0.01"
                name="price"
                value="<?php echo htmlspecialchars($row['price']); ?>"
                required>

        </div>

        <div class="form-group">

            <label>Current Image</label>

            <img
                src="../assets/img/<?php echo htmlspecialchars($row['image']); ?>"
                class="preview"
                alt="Product Image">

        </div>
<div class="form-group">

    <label>Change Image</label>

    <label for="image" class="upload-btn">
        📷 Choose Image
    </label>

    <span id="file-name">No Image Selected</span>

    <input
        type="file"
        id="image"
        name="image"
        accept="image/*"
        onchange="showFileName(this)">

</div>

        <div class="buttons">

            <button type="submit" name="update">
                Update Product
            </button>

            <a href="products.php">
                Back
            </a>

        </div>

    </form>

</div>



<script>

    function showFileName(input){

    if(input.files.length > 0){
        document.getElementById("file-name").innerHTML = input.files[0].name;
    }else{
        document.getElementById("file-name").innerHTML = "No Image Selected";
    }

}
</script>

</body>

</html>