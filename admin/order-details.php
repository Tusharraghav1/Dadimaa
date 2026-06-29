<?php
include "../config/db.php";

if(!isset($_GET['order_no'])){
    exit("Invalid Order");
}

$order_no = mysqli_real_escape_string($conn,$_GET['order_no']);

$query = mysqli_query($conn,"
SELECT
o.*,
p.product_name,
p.image
FROM orders o
LEFT JOIN products p
ON o.product_id=p.id
WHERE o.order_no='$order_no'
");

if(mysqli_num_rows($query)==0){
    exit("Order Not Found");
}

$first=mysqli_fetch_assoc($query);
mysqli_data_seek($query,0);

$grandTotal=0;
?>

<div class="order-details">

<h2>🛒 Order Details</h2>

<div class="customer-box">

<h3>Customer Details</h3>

<p><b>Name :</b> <?= $first['customer_name']; ?></p>

<p><b>Phone :</b> <?= $first['phone']; ?></p>

<p>
<b>Address :</b>

<?= $first['address']; ?>

<?= $first['city']; ?>,
<?= $first['state']; ?>
- <?= $first['pincode']; ?>

</p>

</div>

<!-- Desktop Table -->

<div class="desktop-table">

<table class="order-table">

<thead>

<tr>

<th>Image</th>
<th>Product</th>
<th>Grams</th>
<th>Qty</th>
<th>Price</th>

</tr>

</thead>

<tbody>

<?php while($row=mysqli_fetch_assoc($query)){ ?>

<?php $grandTotal += $row['total_price']; ?>

<tr>

<td>
<img src="../assets/img/<?= $row['image']; ?>">
</td>

<td><?= $row['product_name']; ?></td>

<td><?= $row['grams']; ?>g</td>

<td><?= $row['quantity']; ?></td>

<td>₹<?= number_format($row['total_price'],2); ?></td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

<?php
mysqli_data_seek($query,0);
?>

<!-- Mobile Cards -->

<div class="mobile-products">

<?php while($row=mysqli_fetch_assoc($query)){ ?>

<div class="product-card">

<img src="../assets/img/<?= $row['image']; ?>">

<div class="product-info">

<h4><?= $row['product_name']; ?></h4>

<p><b>Grams :</b> <?= $row['grams']; ?>g</p>

<p><b>Qty :</b> <?= $row['quantity']; ?></p>

<p class="price">₹<?= number_format($row['total_price'],2); ?></p>

</div>

</div>

<?php } ?>

</div>

<div class="grand-total">

Grand Total :
₹<?= number_format($grandTotal,2); ?>

</div>

</div>