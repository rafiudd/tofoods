<?php 
include 'connection.php';
session_start();

$now = date_create()->format('Y-m-d H:i:s');
$sql = "INSERT INTO `carts` (`id`, `product_id`, `user_id`, `quantity`, `created_at`) VALUES(NULL, '{$_GET['id']}', '{$_SESSION['id']}', '1', '$now')";
$result = mysqli_query($conn, $sql);

if ($result) {
    echo "<script>alert('Produk berhasil masuk ke keranjang'); window.location='menu.php'; </script>";
}

?>