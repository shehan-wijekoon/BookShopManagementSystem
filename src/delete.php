<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bookshop";

// as
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'];


$sql = "DELETE FROM inventory WHERE code=$id";

if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();

header("Location: inventoryy.php");
exit;
?>
