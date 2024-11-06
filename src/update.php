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
    // Get form input values
    $id = $_POST['code'];
    $name = $_POST['name'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];

    // Prepare the SQL statement to prevent SQL injection
    $sql = "UPDATE inventory SET name=?, quantity=?, price=? WHERE code=?";

    // Initialize prepared statement
    if ($stmt = $conn->prepare($sql)) {
        
        $stmt->bind_param("sdis", $name, $quantity, $price, $id);

        // Execute the prepared statement
        if ($stmt->execute()) {
            
            header("Location: inventory.php");
            exit();
        } else {
            
            echo "Error updating record: " . $stmt->error;
        }

        
        $stmt->close();
    } else {
        echo "Error preparing the statement: " . $conn->error;
    }
}

$conn->close();
?>
