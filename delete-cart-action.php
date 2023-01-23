<?php 
include 'connection.php';

$sql = "DELETE FROM carts WHERE id = '{$_GET['id']}'";
$result = mysqli_query($conn, $sql);

if ($result) {
    echo "<script>alert('Berhasil menghapus'); window.location='cart.php'; </script>";
}

?>