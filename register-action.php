<?php 
include 'connection.php';

error_reporting(0);
session_start();

$name = $_POST['name'];
$email = $_POST['email'];
$password = md5($_POST['password']);
 
$sql = "SELECT * FROM users WHERE email='$email'";
$result = mysqli_query($conn, $sql);

if (!$result->num_rows > 0) {
    $sql = "INSERT INTO users (name, email, password)
            VALUES ('$name', '$email', '$password')";
    
    $result = mysqli_query($conn, $sql);
    
    if ($result) {
            //set session sukses
            $_SESSION["sukses"] = 'Data Berhasil Disimpan';
            echo "<script>
                alert('Berhasil register');
                 window.location='login.php';
            </script>";
            } else {
            echo "<script>
                alert('Woops! Terjadi kesalahan.');
                window.location='register.php';
            </script>";
    }
} else {
        echo "<script>alert
           ('Woops! Email Sudah Terdaftar.');
                window.location='register.php';
        </script>";
}

?>