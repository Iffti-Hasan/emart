<?php
// controllers/sellerStockAlertController.php
session_start();

// Only sellers can access
if (!isset($_SESSION['seller'])) {
    header("Location: ../views/login.php");
    exit();
}

require_once __DIR__ . '/../config/db_connect.php';
require_once __DIR__ . '/../models/ProductModel.php';

// Fetch low-stock products (threshold 20), returned as array
$lowStockProducts = getLowStockProducts($conn, 20, true);

// Include the view
include __DIR__ . '/../views/inventory_alerts.php';
