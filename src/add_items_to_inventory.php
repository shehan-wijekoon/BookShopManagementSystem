<?php
$servername = "localhost";  // Your server details
$username = "root";     // Your database username
$password = "";     // Your database password
$dbname = "bookshop";  // Your database name


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$code = $_POST['code'];
$name = $_POST['name'];
$quantity = $_POST['quantity'];
$price = $_POST['price'];


$sql = "INSERT INTO inventory (code, name, quantity, price) VALUES ('$code', '$name','$quantity','$price')";


if ($conn->query($sql) === TRUE) {
    header("Location: inventory.php");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
