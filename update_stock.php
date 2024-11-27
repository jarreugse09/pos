<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$database = "pos";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$itemId = $_POST['itemId'];
$quantity = intval($_POST['quantity']);
$action = $_POST['action'];

if ($action === 'decrease') {
    $sql = "UPDATE stock SET quantity = quantity - $quantity WHERE id = $itemId AND quantity >= $quantity";
} elseif ($action === 'increase') {
    $sql = "UPDATE stock SET quantity = quantity + $quantity WHERE id = $itemId";
}

if ($conn->query($sql) === TRUE) {
    echo "success";
} else {
    echo "error";
}

$conn->close();
?>
