<?php 
include 'connection.php';
session_start();

$now = date_create()->format('Y-m-d H:i:s');
$address = $_POST['address'];

$sql_tampil = "SELECT SUM(products.price) AS price FROM carts JOIN products ON carts.product_id = products.id JOIN users ON carts.user_id = users.id WHERE carts.user_id = '{$_SESSION['id']}'";
$data = mysqli_query($conn, $sql_tampil);
$row = mysqli_fetch_assoc($data);
$total_price = $row['price'];

$order = "INSERT INTO `orders` (`order_id`, `user_id`, `address`, `price`, `created_at`) VALUES(NULL, '{$_SESSION['id']}', '$address', '$total_price', '$now')";
$result_order = mysqli_query($conn, $order);

if ($result_order) {
    $selectquery="SELECT order_id FROM orders ORDER BY order_id DESC LIMIT 1";
    $result = mysqli_query($conn, $selectquery);
    $row = mysqli_fetch_assoc($result);
    $order_id = $row['order_id'];

    $sql_tampil = "SELECT products.id AS product_id, products.price AS price, carts.quantity AS quantity FROM carts JOIN products ON carts.product_id = products.id JOIN users ON carts.user_id = users.id WHERE carts.user_id = '{$_SESSION['id']}'";
    $data = mysqli_query($conn, $sql_tampil);

    while($baris_data = mysqli_fetch_array($data, MYSQLI_ASSOC)) {
        $order_item = "INSERT INTO `order_items` 
        (`order_item_id`, `order_id`, `product_id`, `user_id`, `quantity`, `price`, `created_at`) VALUES 
        (
        NULL, 
        '$order_id', 
        '" . $baris_data["product_id"] ."', 
        '{$_SESSION['id']}', 
        '" . $baris_data["quantity"] ."', 
        '" . $baris_data["price"] ."', 
        '$now'
        )";

        $result_order_item = mysqli_query($conn, $order_item);
    }


    $sql_delete=("DELETE FROM carts WHERE carts.user_id = '{$_SESSION['id']}' ");
    $delete = mysqli_query($conn, $sql_delete);

    echo "<script>alert('Berhasil membuat order'); window.location='menu.php'; </script>";
}

?>