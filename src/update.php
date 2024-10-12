<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bookshop";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
$id = $_POST['code'];
$name = $_POST['name'];
$quantity = $_POST['quantity'];
$price = $_POST['price'];

    $sql = "UPDATE inventory SET name='$name', quantity='$quantity',price='$price' WHERE code=$id";
    
    if ($conn->query($sql) === TRUE) {
   header("Location: inventory.php");
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
$conn->close();
?>
