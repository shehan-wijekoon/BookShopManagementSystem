<?php
$servername = "localhost";  // Your server details
$username = "root";     // Your database username
$password = "";     // Your database password
$dbname = "bookshop";  // Your database name


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT date, id, name, price, quantity, total FROM sales_report";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<thead>                        <th>Date</th>
                        <th>id</th>
                        <th>name</th>
                        <th>price</th>
                        <th>quantity</th>
                        <th>total</th></tr><thead>";


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
