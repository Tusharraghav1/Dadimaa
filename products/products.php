<?php
include '../config/db.php';

$result = mysqli_query($conn,"SELECT * FROM products");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Products</title>
    <link rel="stylesheet" href="../assets/css/product.css">
</head>
<body>

<section class="products-section">

    <h1>Our Pickles</h1>
    <p class="subtitle">Authentic Homemade Pickles</p>

    <div class="products-container">

        <?php while($row = mysqli_fetch_assoc($result)){ ?>

        <div class="product-card">

            <img src="../assets/img/<?php echo $row['image']; ?>" alt="">

            <div class="product-info">

                <h3><?php echo $row['product_name']; ?></h3>

                <p class="product-id">
                    Product ID: <?php echo $row['id']; ?>
                </p>

                <p class="price">
                    ₹<?php echo $row['price']; ?>
                </p>

              <a class="cart-btn"
   href="../cart/cart.php?id=<?php echo $row['id']; ?>">
   Add To Cart
</a>

            </div>

        </div>

        <?php } ?>

    </div>

</section>

</body>
</html>