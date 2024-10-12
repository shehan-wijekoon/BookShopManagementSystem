<?php
$servername = "localhost";  // Your server details
$username = "root";     // Your database username
$password = "";     // Your database password
$dbname = "bookshop";  // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the form data
$code = $_POST['code'];
$name = $_POST['name'];
$quantity = $_POST['quantity'];
$price = $_POST['price'];

// SQL query to insert form data into a table
$sql = "INSERT INTO inventory (code, name, quantity, price) VALUES ('$code', '$name','$quantity','$price')";

// Execute the query and check for success
if ($conn->query($sql) === TRUE) {
    header("Location: inventoryy.php");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the connection
$conn->close();
?>
