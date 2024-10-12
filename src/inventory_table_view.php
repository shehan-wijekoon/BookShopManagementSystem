<?php
$servername = "localhost";  // Your server details
$username = "root";     // Your database username
$password = "";     // Your database password
$dbname = "bookshop";  // Your database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT code, name, quantity, price FROM inventory";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<thead>                        <th>Item Code</th>
                        <th>Item Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Actions</th></tr><thead>";

    while ($row = $result->fetch_assoc()) {
        echo "<tbody><tr><td>" . $row["code"] . "</td><td>" . $row["name"] . "</td><td>" . $row["quantity"] ."</td><td>".  $row["price"]."</td><td>"."  <a href='Stock.php' class='edit-btn'>Edit</a>
                            <a href='delete.php?id=" . $row["code"] . "'  class='del-btn'>Delete</a></td></tr><tbody>";
    }
    echo "</table>";
} else {
    echo "<p>No records found.</p>";
}

// Close the connection
$conn->close();
?>
