<?php 
include 'connection.php';
session_start();
$sql = "UPDATE `book_table` SET `status` = 'Confirmed' WHERE `user_id` = '{$_SESSION['id']}'";
$result = mysqli_query($conn, $sql);

if ($result) {
    echo "<script>alert('Berhasil konfirmasi'); window.location='book.php'; </script>";
}

?>