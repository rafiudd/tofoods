<?php 
include 'connection.php';

$sql = "UPDATE `orders` SET `status` = 'Ordered' WHERE order_id = '{$_GET['order_id']}'";
$result = mysqli_query($conn, $sql);

if ($result) {
    echo "<script>alert('Pembayaran berhasil'); window.location='orders.php'; </script>";
}

?>