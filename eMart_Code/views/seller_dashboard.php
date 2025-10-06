<?php
session_start();
if (!isset($_SESSION['seller'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Seller Dashboard - eMart</title>
    <link rel="stylesheet" href="../assets/css/seller_style.css">

</head>

<body class="seller">
    <header>
        <div>
            <img src="../assets/images/emart-logo.png" alt="eMart Logo">
            <h1>Welcome, <?php echo $_SESSION['username']; ?> 🎉</h1>
        </div>
        <nav>
            <a href="../controllers/authController.php?logout=true">Logout</a>
        </nav>
    </header>

    <div class="seller-dashboard-container">

        <h2 style="text-align:center; margin-bottom:30px;">📊 Seller Dashboard</h2>

        <div class="dashboard">
            <div class="card">
                <h3>📦 Manage Products</h3>
                <p>Add, view, update, or delete products.</p>
                <a href="../controllers/sellerController.php?action=products">Go</a>
            </div>

            <div class="card">
                <h3>🛒 Orders</h3>
                <p>View and manage customer orders.</p>
                <a href="../views/seller_orders.php">Go</a>

            </div>

            <div class="card">
                <h3>📈 Sales Report</h3>
                <p>View sales performance.</p>
                <a href="../views/seller_report.php">Go</a>
            </div>

            <div class="card">
                <h3>⭐ Feedback</h3>
                <p>Review customer feedback.</p>
                <a href="../controllers/sellerFeedbackController.php">Go</a>
            </div>

            <div class="card">
                <h3>⚠️ Stock Alerts</h3>
                <p>Check low-stock products.</p>
                <a href="../controllers/sellerStockAlertController.php">Go</a>
            </div>

            <div class="card">
                <h3>💸 Discounts</h3>
                <p>Manage product discounts.</p>
                <a href="../controllers/sellerController.php?action=products">Go</a>
            </div>
        </div>
    </div>
</body>

</html>