<?php



session_start();

if(!isset($_SESSION['admin'])){

header("Location: login.php");

exit();

}

include '../config/db.php';

$result = mysqli_query($conn,"SELECT * FROM products");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>

    <link rel="stylesheet" href="../assets/css/products.css">
</head>
<body>

<div class="container">

    <!-- <div class="header">
        <h1>📦 Products</h1>

        <a href="dashboard.php" class="back-btn">
    ← Back to Dashboard
</a>

        <a href="add-product.php" class="add-btn">
            + Add Product
        </a>
    </div> -->
    <div class="header">

    <h1>📦 Products</h1>

    <div class="header-buttons">

        <a href="dashboard.php" class="back-btn">
            ← Back 
        </a>

        <a href="add-product.php" class="add-btn">
            + Add Product
        </a>

    </div>

</div>

    <div class="table-box">

        <table>

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>

            <?php while($row = mysqli_fetch_assoc($result)){ ?>

                <tr>

                    <td><?php echo $row['id']; ?></td>

                    <td><?php echo htmlspecialchars($row['product_name']); ?></td>

                    <td>₹<?php echo $row['price']; ?></td>

                    <td>

                        <a class="edit-btn"
                        href="edit-product.php?id=<?php echo $row['id']; ?>">
                            Edit
                        </a>

                        <a class="delete-btn"
                        href="delete-product.php?id=<?php echo $row['id']; ?>"
                        onclick="return confirm('Delete this product?')">
                            Delete
                        </a>

                    </td>

                </tr>

            <?php } ?>

            </tbody>

        </table>

    </div>

</div>

</body>
</html>