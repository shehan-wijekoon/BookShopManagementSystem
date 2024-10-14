<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQb62EQH1SOiJV0wZr2iA1dHLWUBK8IVb5zMw&s"
        type="image/x-icon">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,
                wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <link rel="StyleSheet" href="Stock.css">
    <title>Stock Update</title>
</head>
<body>
    <div id="stock-update-page">
        <div class="dashboard-container">
            <div class="sidebar">
                <h2>CHANDREASEKARA BOOK SHOP</h2>
                <ul>
                    <li><a href="Inventory.php">Inventory</a></li>
                    <li><a href="SalesReport.php">Sales Reports</a></li>
                    <li><a href="Bill.html">Bill Calculator</a></li>
                    <li><a href="Help.html">Help</a></li>
                </ul>
                <!-- Back Button -->
                <a href="Home&Login.html" class="back-btn">← Log Out</a>
            </div>
            <div class="content">
                <h1>Stock Update</h1>
                <div class="form-container">
                    <form id="stock-update-form" action="update.php"  method="POST">
                        <label for="item-id">Item ID:</label>
                        <input type="text" id="code" name="code" placeholder="Enter item ID" required>

                        <label for="item-name">Item Name:</label>
                        <input type="text" id="name" name="name" placeholder="Enter item name" required>

                        <label for="quantity">Quantity:</label>
                        <input type="number" id="quantity" name="quantity" placeholder="Enter quantity" required>

                        <label for="price">Price (Rs):</label>
                        <input type="number" id="price" name="price" placeholder="Enter price" required>

                        <button type="submit" class="update-btn">Update Stock</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>