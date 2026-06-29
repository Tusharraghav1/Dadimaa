<?php

include "../config/db.php";

$order_no = $_GET['order_no'];

$ofd = (int)$_GET['ofd'];

mysqli_query($conn,"
UPDATE orders
SET ofd='$ofd'
WHERE order_no='$order_no'
");

echo "Success";