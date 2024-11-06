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

            <?php include 'sales_report_table.php';?>

        </div>

        <!-- Footer Section -->
        <div class="footer-section">
            <div class="footer-info">
                <label>Date:</label>
                <span>_____________</span>
            </div>
            <div class="footer-info">
                <label>Total Sales:</label>
                <span>Rs: ___________</span>
            </div>
            <button class="print-btn">Print</button>
        </div>
    </div>

</body>
</html>
