<?php
// controllers/sellerReportController.php
session_start();
require_once("../config/db_connect.php");

// Only sellers can access
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'seller') {
    header("Location: ../views/login.php");
    exit();
}

// Total revenue and orders
$totalsQuery = "SELECT SUM(total) AS total_revenue, COUNT(id) AS total_orders
                FROM orders
                WHERE status = 'Delivered'";
$totals = $conn->query($totalsQuery)->fetch_assoc();

// Daily breakdown
$reportQuery = "SELECT DATE(created_at) AS order_date, COUNT(id) AS total_orders, SUM(total) AS daily_revenue
                FROM orders
                WHERE status = 'Delivered'
                GROUP BY DATE(created_at)
                ORDER BY order_date DESC";
$report = $conn->query($reportQuery);
