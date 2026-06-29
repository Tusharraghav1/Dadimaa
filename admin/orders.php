<?php


session_start();

if(!isset($_SESSION['admin'])){

header("Location: login.php");

exit();

}
include '../config/db.php';


$query = "
SELECT
    order_no,
    customer_name,
    phone,
    SUM(quantity) AS total_qty,
    SUM(total_price) AS grand_total,
    MAX(order_date) AS order_date,
    MAX(ofd) AS ofd,
    COUNT(*) AS total_items
FROM orders
WHERE order_no IS NOT NULL
GROUP BY order_no
ORDER BY MAX(id) DESC
";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Orders</title>

<link rel="stylesheet" href="../assets/css/orders.css">

</head>
<body>

<div class="container">

    <div class="header">
        <h1>🛒 Orders</h1>

        <a href="dashboard.php" class="back-btn">
        ← Dashboard
    </a>
    </div>

    <div class="table-box">

        <table>

            <thead>
                <tr>
                    <!-- <th> ID</th> -->
                    <th>Name</th>
                    <th>Product</th>
                    <th>Items</th>
                      <!-- <th>Grams</th>
                    <th>Qty</th> -->
                    <!-- <th>Total</th> -->
                    <th>Date</th>
                    <th>OFD</th>
                </tr>
            </thead>
                          <tbody>

<?php while($row = mysqli_fetch_assoc($result)){ ?>

<tr>

    <td>
        <?php echo $row['customer_name']; ?>
    </td>

    <td>
        <?php echo $row['total_items']; ?> Products
    </td>

    <td>

        <button
        class="view-btn"
        onclick="viewItems('<?php echo $row['order_no']; ?>')">

        👁 View (<?php echo $row['total_items']; ?>)

        </button>

    </td>

    <td>
        <?php echo date("d/m/y H:i",strtotime($row['order_date'])); ?>
    </td>

    <td>

        <input
        type="checkbox"
        <?php if($row['ofd']==1) echo "checked"; ?>
        onchange="updateOFD('<?php echo $row['order_no']; ?>',this.checked)">

    </td>

</tr>

<?php } ?>

</tbody>
          
        </table>

    </div>

    <!-- 👇 YAHAN LAGANA HAI -->
    <div id="orderModal" class="modal">

        <div class="modal-content">

            <span class="close" onclick="closeModal()">&times;</span>

            <div id="orderDetails"></div>

        </div>

    </div>

</div>








<script>



function updateOFD(orderNo, checked){

let value = checked ? 1 : 0;

fetch("update-ofd.php?order_no="+orderNo+"&ofd="+value);

}

function viewItems(orderNo){

    fetch("order-details.php?order_no=" + orderNo)
    .then(response => response.text())
    .then(data => {

        document.getElementById("orderDetails").innerHTML = data;
        document.getElementById("orderModal").style.display = "flex";

    });

}

function closeModal(){

    document.getElementById("orderModal").style.display = "none";

}
</script>

</body>





</html>