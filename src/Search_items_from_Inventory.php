<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQb62EQH1SOiJV0wZr2iA1dHLWUBK8IVb5zMw&s"
        type="image/x-icon">

    <title>Inventory</title>
    <link rel="stylesheet" href="Inventory.css">
</head>
<body>

    <!-- Side Navigation Bar -->
    <div class="sidebar">
        <h2>CHANDREASEKARA BOOK SHOP</h2>
        <nav>
            <ul>
                <li><a href="Stock.php">Stock update</a></li>
                <li><a href="SalesReport.php">Sales Report</a></li>
                <li><a href="bill.php">Bill Calculator</a></li>
                <li><a href="Help.html">Help</a></li>
            </ul>
        </nav>

        <!-- Back Button -->
        <a href="Home&Login.html" class="back-btn">← Log Out</a>
    </div>

    <!-- Main Content Container -->
    <div class="container">
        <!-- Inventory Header and Input Section -->
        <div class="inventory-header">
            <h1>Inventory</h1>
            <div class="input-group">
                <!-- Form action to sent data to the php -->
                <form action="add_items_to_inventory.php"  method="POST"   >
                    <input type="text" id="code" name="code" placeholder="Item Code">
                    <input type="text" id="name" name="name" placeholder="Item Name">
                    <input type="number" id="quantity" name="quantity" placeholder="Quantity" min="1">
                    <input type="number" id="price" name="price" placeholder="Price" min="0.01" step="0.01">
                    <button class="btn" id="addBtn" name="">Add</button>
                </form>

                <form action="Search_items_from_Inventory.php" method="POST">
                    <input type="text" id="itemid" name="item_id" placeholder="Search the item" required>
                    <button class="btn" id="searchBtn">Search</button>
                    <button class="btn" id="loadBtn" type="button" onclick="window.location.href='Inventory.php'">Load All Items</button>
                </form>
                        <!--
                    <button class="savebtn" id="saveBtn">Save to Database</button>
                -->
            </div>
        </div>

        <!-- Inventory Table -->
        <div class="table-container">
        <?php
        
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "bookshop";
            
            $conn = new mysqli($servername, $username, $password, $dbname);
            
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            
            // Check if the item code is set
            if (isset($_POST['item_id'])) {
                $item_id = $_POST['item_id'];
            
                $stmt = $conn->prepare("SELECT code, name, quantity, price FROM inventory WHERE code = ?");
                $stmt->bind_param("s", $item_id);
            
            // Execute the statement
                $stmt->execute();
                $result = $stmt->get_result();
            
                // Output the results in table format
                if ($result->num_rows > 0) {
                    echo "<table>";
                    echo "<thead><tr>
                            <th>Item Code</th>
                            <th>Item Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Actions</th>
                          </tr></thead>";
                    
                    // Fetch the item details
                    while ($row = $result->fetch_assoc()) {
                        echo "<tbody><tr>
                                <td>" . htmlspecialchars($row["code"]) . "</td>
                                <td>" . htmlspecialchars($row["name"]) . "</td>
                                <td>" . htmlspecialchars($row["quantity"]) . "</td>
                                <td>" . htmlspecialchars($row["price"]) . "</td>
                                <td>
                                    <a href='Stock.php' class='edit-btn'>Edit</a>
                                    <a href='delete.php?id=" . htmlspecialchars($row["code"]) . "' class='del-btn'>Delete</a>
                                </td>
                              </tr></tbody>";
                    }
                    echo "</table>";
                } else {
                    echo "<p>No records found for Item Code: " . htmlspecialchars($item_id) . ".</p>";
                }
            
                $stmt->close();
            } else {
                echo "<p>Please enter an Item Code to search.</p>";
            }
            
            $conn->close(); 
        ?>
        </div>
    </div>

    <script src="Inventory.js"></script>

</body>
</html>
