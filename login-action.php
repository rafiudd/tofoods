<?php 
    include 'connection.php';

    error_reporting(0);
    session_start();
 
    $email = $_POST['email'];
    $password = md5($_POST['password']);
 
    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['name'] = $row['name'];
        $_SESSION['id'] = $row['id'];

        if($row['role'] == 'admin') {
            header("Location: admin/index.php");
        } else {
            header("Location: index.php");
        }
    } else {
        echo "<script>
            alert('Email atau password Anda salah. Silahkan coba lagi!');
            window.location='login.php';
        </script>";
    } 
?>