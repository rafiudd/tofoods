<?php 
include 'connection.php';
session_start();

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$quantity = $_POST['quantity'];
$date_attend = $_POST['date_attend'];

$sql = "INSERT INTO `book_table` (`id`, `user_id`, `phone`, `email`, `quantity`, `status`, `date_attend`) VALUES (NULL, '{$_SESSION['id']}', '$phone', '$email', '$quantity', 'Waiting Confirmation', '$date_attend')";
$result = mysqli_query($conn, $sql);

if ($result) {
    echo "<script>alert('Berhasil booking table'); window.location='book.php'; </script>";
}

?>