<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$database = "pos";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$category = $_POST['category'];
$name = $_POST['name'];
$price = $_POST['price'];
$quantity = $_POST['quantity'];

if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $imageName = basename($_FILES['image']['name']);
    $imagePath = 'uploads/' . $imageName;

    if (!file_exists('uploads')) {
        mkdir('uploads', 0777, true);
    }

    if (move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
        $sql = "INSERT INTO stock (category, name, price, quantity, image_path) VALUES ('$category', '$name', '$price', '$quantity', '$imagePath')";
        if ($conn->query($sql) === TRUE) {
            echo "Stock successfully added!";
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "Failed to upload image.";
    }
} else {
    echo "No image uploaded.";
}

$conn->close();
?>
