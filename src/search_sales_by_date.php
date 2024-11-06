<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQb62EQH1SOiJV0wZr2iA1dHLWUBK8IVb5zMw&s"
        type="image/x-icon">

    <title>Sales Report</title>
    <link rel="stylesheet" href="Sales.css">
</head>
<body>

    <!-- Side Navigation Bar -->
    <div class="sidebar">
        <h2>CHANDREASEKARA BOOK SHOP</h2>
        <nav>
            <ul>
                <li><a href="bill.php">Bill Calculator</a></li>
                <li><a href="Inventory.php">Inventory</a></li>
                <li><a href="Stock.php">Stock update</a></li>
                <li><a href="Email.html">Email to Supplier</a></li>
                <li><a href="Help.html">Help</a></li>
                
            </ul>
        </nav>

        <!-- Back Button -->
        <a href="Home.html" class="back-btn">← Log Out</a>
    </div>

    <!-- Main Sales Report Section -->
    <div class="main-container">
        <!-- Sales Report Table -->
        <div class="sales-report">
            <h2>Sales Report</h2>

            <form action="search_sales_by_date.php" method="POST" class="search-form">
                <input type="date" id="itemdate" name="item_date" placeholder="Select the item date" required>
                <button type="submit" class="btn" id="searchBtn">Search</button>
                <button class="btn" id="loadBtn" type="button" onclick="window.location.href='SalesReport.php'">Load All Items</button>
            </form>
 
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
            
            // Initialize total sales to 0
            $total_sales = 0;
            $item_date = "";
            
            // Check if the form was submitted and the date was provided
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['item_date'])) {
                $item_date = $_POST['item_date'];
            
                // SQL query to select records for the given date
                $sql = "SELECT date, id, name, price, quantity, total FROM sales_report WHERE date = ?";
            
                // Prepare and bind
                if ($stmt = $conn->prepare($sql)) {
                    $stmt->bind_param("s", $item_date);
                    $stmt->execute();
                    $result = $stmt->get_result();
            
                    // Output the records in table format
                    if ($result->num_rows > 0) {
                        echo "<table id='sales-table'>";
                        echo "<thead><tr><th>Date</th>
                                    <th>id</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th></tr></thead>";
            
                        // Loop through the records and create table rows
                        while ($row = $result->fetch_assoc()) {
                            echo "<tbody><tr><td>" . $row["date"] . "</td><td>" . $row["id"] . "</td><td>" . $row["name"] . "</td><td>" . $row["price"] . "</td><td>" . $row["quantity"] . "</td><td>" . $row["total"] . "</td></tr></tbody>";
        
                            $total_sales += $row["total"];
                        }
                        echo "</table>";
                    } else {
                        echo "<p>No records found for the selected date.</p>";
                    }
            
                    $stmt->close();
                } else {
                    echo "<p>Error preparing the SQL query.</p>";
                }
            } else {
                echo "<p>Please select a date to search.</p>";
            }
            
            $conn->close();
            ?>
            
        </div>

            <!-- Footer Section -->
            <div class="footer-section">
                <div class="footer-info">
                    <label>Date:</label>
                    <span><?php echo htmlspecialchars($item_date); ?></span>
                </div>
                <div class="footer-info">
                    <label>Total Sales:</label>
                    <span>Rs: <?php echo number_format($total_sales, 2); ?></span>
                </div>
                <button class="print-btn" onclick="generateBill()">Print</button>
            </div>

    </div>

    <script src="printMonthlySales.js"></script>
</body>
</html>
