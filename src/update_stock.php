<?php
session_start();

$servername = "localhost";
$username = "root";         
$password = "";
$dbname = "bookshop";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if there is a bill in the session
if (isset($_SESSION['bill']) && !empty($_SESSION['bill'])) {
    
    $conn->begin_transaction();

    try {
        
        foreach ($_SESSION['bill'] as $item) {
            $item_code = $item['code'];
            $quantity_sold = $item['quantity'];

            // Prepare SQL to get current stock of the item
            $stmt = $conn->prepare("SELECT quantity FROM inventory WHERE code = ?");
            $stmt->bind_param("s", $item_code);
            $stmt->execute();
            $result = $stmt->get_result();
            
            // Check if item exists in inventory
            if ($row = $result->fetch_assoc()) {
                $current_stock = $row['quantity'];

                // Check if there is enough stock available
                if ($current_stock >= $quantity_sold) {
                   
                    $new_stock = $current_stock - $quantity_sold;

                    // Prepare SQL to update stock quantity
                    $update_stmt = $conn->prepare("UPDATE inventory SET quantity = ? WHERE code = ?"); // Use 'quantity' instead of 'stock_quantity'
                    $update_stmt->bind_param("is", $new_stock, $item_code);
                    $update_stmt->execute();
                    $update_stmt->close();
                } else {
                    
                    echo "Not enough stock for item: " . htmlspecialchars($item['name']);
                    
                    $conn->rollback();
                    exit;
                }
            } else {
                
                echo "Item not found in inventory: " . htmlspecialchars($item['name']);
                $conn->rollback();
                exit;
            }

           
            $stmt->close();
        }

        $conn->commit();

        //clear the bill session after updating stock
        unset($_SESSION['bill']);

        // Success message
        echo "<script type='text/javascript'>
                alert('Stock updated successfully!');
                window.location.href = 'bill.php';
             </script>";
    } catch (Exception $e) {
        $conn->rollback();
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "No items in the bill to process.";
}

$conn->close();
?>