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
                <li><a href="Bill.html">Bill Calculator</a></li>
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
                <form action="add_items_to_inventory.php"  method="POST"   >
                <input type="text" id="code" name="code" placeholder="Item Code">
                <input type="text" id="name" name="name" placeholder="Item Name">
                <input type="number" id="quantity" name="quantity" placeholder="Quantity" min="1">
                <input type="number" id="price" name="price" placeholder="Price" min="0.01" step="0.01">
                <button class="btn" id="addBtn" name="">Add</button>
        </form>
        <form action="">
        <input type="text" id="itemid" placeholder="Search the item">
        <button class="btn" id="searchBtn">Search</button>
        <button class="btn" id="loadBtn">Load</button>
        
        </form>
                <!--
                    <button class="savebtn" id="saveBtn">Save to Database</button>
                -->
            </div>
        </div>

        <!-- Inventory Table -->
        <div class="table-container">
        <?php include 'inventory_table_view.php';?>

        </div>
    </div>

    <script src="Inventory.js"></script>

</body>
</html>
