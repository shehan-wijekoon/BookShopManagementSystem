<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bookshop";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the record ID from URL
$id = $_GET['id'];

// Delete query
$sql = "DELETE FROM inventory WHERE code=$id";

if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}

// Close the connection
$conn->close();

// Redirect back to the display page after deletion
header("Location: inventoryy.php");
exit;
?>
