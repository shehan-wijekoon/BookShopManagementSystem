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

// Initialize the bill session if it doesn't exist
if (!isset($_SESSION['bill'])) {
    $_SESSION['bill'] = [];
}

// Check if the item ID and quantity are set for adding items
if (isset($_POST['item_id']) && isset($_POST['quantity'])) {
    $item_id = $_POST['item_id'];
    $quantity = intval($_POST['quantity']);

    $stmt = $conn->prepare("SELECT code, name, price FROM inventory WHERE code = ?");
    $stmt->bind_param("s", $item_id);

    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch the item details
    if ($row = $result->fetch_assoc()) {
        $row['quantity'] = $quantity;
        $_SESSION['bill'][] = $row;
    } else {
        echo "<script type='text/javascript'>
                alert('No item found with ID: " . htmlspecialchars($item_id) . "');
                window.location.href = 'bill.php';
             </script>";
    }

    $stmt->close();
}

// Check if an item is being deleted
if (isset($_POST['delete_index'])) {
    $index = intval($_POST['delete_index']);
    
    if (isset($_SESSION['bill'][$index])) {
        unset($_SESSION['bill'][$index]);
        $_SESSION['bill'] = array_values($_SESSION['bill']);
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQb62EQH1SOiJV0wZr2iA1dHLWUBK8IVb5zMw&s"
        type="image/x-icon">

    <title>Bill and Discount Calculator</title>
    <link rel="stylesheet" href="billsyle.css">
</head>

<body>

    <!-- Side Navigation Bar -->
    <div class="sidebar">
        <h2>CHANDREASEKARA BOOK SHOP</h2>
        <nav>
            <ul>
                <li><a href="Inventory.php">Inventory</a></li>
                <li><a href="Stock.php">Stock update</a></li>
                <li><a href="SalesReport.php">Sales Reports</a></li>
                <li><a href="Email.html">Email to Supplier</a></li>
                <li><a href="Help.html">Help</a></li>
            </ul>
            <a href="Home.html" class="back-btn"> Home -></a>
        </nav>
    </div>

    <!-- Main Bill Calculator Section -->
    <div class="main-container">
        <!-- Bill Calculator -->
        <div class="bill-calculator">
            <h2>Bill Calculator</h2>
            <br>
            <div class="search-section">
                <form method="POST">
                    <input type="text" name="item_id" id="item-id" placeholder="Item ID" required>
                    <input type="number" name="quantity" id="quantity" placeholder="Quantity" required>
                    <button type="submit" class="add-btn">Add</button>
                    <button class="cal-btn" id="calculate">Calculate Total</button>
                </form>
            </div>

            <!-- Item Table -->
            <table id="bill-items">
                <thead>
                    <tr>
                        <th>Item Code</th>
                        <th>Item Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($_SESSION['bill'])): ?>
                        <?php foreach ($_SESSION['bill'] as $index => $item): ?>
                            <tr>
                                <td><?= htmlspecialchars($item['code']) ?></td>
                                <td><?= htmlspecialchars($item['name']) ?></td>
                                <td><?= htmlspecialchars($item['quantity']) ?></td>
                                <td><?= htmlspecialchars($item['price'] * $item['quantity']) ?></td>
                                <td>
                                    <form method="POST" style="display:inline;">
                                        <input type="hidden" name="delete_index" value="<?= $index ?>">
                                        <button type="submit" class="delete-btn">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Discount & Profit Section -->
        <div class="discount-calculator">
            <div class="total-section">
                <h3>Total price Rs: <span id="total-amount">0.00</span></h3>
            </div>
            <br>
            <hr>
            <h3>Discount Calculator</h3>
            <br>
            <div class="discount-section">
                <input type="number" id="discount-input" placeholder="Enter discount %">
                <button class="cal-discount-btn">Calculate Discount</button>
                <h4>Discounted price: Rs <span id="discounted-price">0.00</span></h4>
            </div>
            <br>
            <hr>

            <div class="expenses">
                <h3>Expenses Calculator</h3><br>
                <label>Total workers:</label>
                <input type="number" id="numberofworkers" placeholder="Number of workers">
                <label>Payment:</label>
                <input type="number" id="payment" placeholder="Payment for one person">
                <button class="cal-expences-btn">Calculate Total payment</button>
                <h4>Total payment: Rs <span id="total-payment">0.00</span></h4>
                <hr>
            </div>

            <div class="fuel expenses">
                <h3>Fuel Expense Calculator</h3><br>
                <label>Total distance travel:</label>
                <input type="number" id="distance" placeholder="Distance">
                <label>Fuel (L) for 1 KM:</label>
                <input type="number" id="fuelforone" placeholder="Fuel liters">
                <label>Price for 1L:</label>
                <input type="number" id="fuelprice" placeholder="Fuel price">
                <button class="cal-fuel-btn">Calculate Total Fuel Price</button>
                <h4>Total fuel price: Rs <span id="total-fuel-price">0.00</span></h4>
                <hr>
            </div>

            <div class="total-expenses-section">
                <h3>Total Expenses</h3>
                <h4>Total Expenses: Rs <span id="total-expenses">0.00</span></h4>
            </div>

            <div class="total-section">
                <label>Total Bill:</label>
                <h3>Total price Rs: <span id="total-bill">0.00</span></h3>
            </div>

            <div class="button-container">
                <button class="discard-btn">Discard</button>
                <button class="print-btn" onclick="generateBill()">Generate Bill</button>

                <form method="POST" action="save_bill.php">
                    <button type="submit" class="save-btn" style="
                        width: 100%;
                        height:102%;
                        padding: 15px;
                        background-color: rgb(34, 154, 204);
                        color: white;
                        font-size: 16px;
                        border: none;
                        border-radius: 5px;
                        cursor: pointer;
                        transition: background-color 0.3s ease;">
                        Save
                    </button>
                </form>

                <form method="POST" action="update_stock.php">
                    <button type="submit" class="save-btn" style="
                        width: 100%;
                        height:102%;
                        padding: 15px;
                        background-color: rgb(255, 165, 0);
                        color: white;
                        font-size: 16px;
                        border: none;
                        border-radius: 5px;
                        cursor: pointer;
                        transition: background-color 0.3s ease;">
                        Update
                    </button>
                </form>

            </div>

        </div>
    </div>

    <script src="Bill.js"></script>
    
</body>

</html>
