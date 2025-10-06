<?php
// controllers/sellerOrderController.php
session_start();
require_once("../config/db_connect.php");

// Only sellers can access
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'seller') {
    header("Location: ../views/login.php");
    exit();
}

// Fetch all orders with customer info
$sql = "SELECT o.id, u.name AS customer_name, o.total, o.status, o.created_at 
        FROM orders o
        JOIN users u ON o.user_id = u.id
        ORDER BY o.created_at DESC";
$orders = $conn->query($sql);

// Handle status update
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['order_id'], $_POST['status'])) {
    $order_id = intval($_POST['order_id']);
    $status = $conn->real_escape_string($_POST['status']);

    $update = $conn->prepare("UPDATE orders SET status=? WHERE id=?");
    $update->bind_param("si", $status, $order_id);
    $update->execute();

    header("Location: ../views/seller_orders.php");
    exit();
}
