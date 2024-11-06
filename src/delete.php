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

// Check if the item ID is set in the URL
if (isset($_GET['id'])) {
    $item_id = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM inventory WHERE code = ?");
    $stmt->bind_param("s", $item_id);

    // Execute the delete statement
    if ($stmt->execute()) {
        header("Location: inventory.php?message=Item deleted successfully");
    } else {
        echo "Error deleting item: " . $conn->error;
    }

    $stmt->close();
} else {
    echo "No item ID specified for deletion.";
}

$conn->close();
?>
