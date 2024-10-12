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

// SQL query to select all records from your table
$sql = "SELECT date, id, name, price, quantity, total FROM sales_report";
$result = $conn->query($sql);

// Output the records in table format
if ($result->num_rows > 0) {
    echo "<table>";
    echo "<thead>                        <th>Date</th>
                        <th>id</th>
                        <th>name</th>
                        <th>price</th>
                        <th>quantity</th>
                        <th>total</th></tr><thead>";

    // Loop through the records and create table rows
    while ($row = $result->fetch_assoc()) {
        echo "<tbody><tr><td>" . $row["date"] . "</td><td>" . $row["id"] . "</td><td>" . $row["name"] ."</td><td>".  $row["price"]."</td><td>".$row["quantity"]."</td><td>".$row["total"]." </td></tr><tbody>";
    }
    echo "</table>";
} else {
    echo "<p>No records found.</p>";
}

// Close the connection
$conn->close();
?>