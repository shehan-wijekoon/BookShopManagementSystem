<?php
session_start();

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

// Check if we have bill items in the session
if (isset($_SESSION['bill']) && !empty($_SESSION['bill'])) {
    $items = $_SESSION['bill'];

    foreach ($items as $item) {
        $name = $conn->real_escape_string($item['name']);
        $price = $conn->real_escape_string($item['price']);
        $quantity = $conn->real_escape_string($item['quantity']);
        $total = $price * $quantity;

        // Insert into sales_report
        $sql = "INSERT INTO sales_report (date, name, price, quantity, total) 
                VALUES (CURRENT_DATE, '$name', '$price', '$quantity', '$total')";

        if (!$conn->query($sql)) {
            echo "Error saving item: " . $conn->error;
            exit();
        }
    }

    //clear the session after saving
    //unset($_SESSION['bill']);

    // Display the success message in a popup
    echo "<script type='text/javascript'>
            alert('Bill saved successfully!');
            window.location.href = 'bill.php';
          </script>";
} else {
    echo "<script type='text/javascript'>
            alert('No items in the bill to save.');
            window.location.href = 'bill.php';
          </script>";
}

$conn->close();
?>
