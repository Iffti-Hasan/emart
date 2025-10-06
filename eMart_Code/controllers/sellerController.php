<?php
include("../config/db_connect.php");

if (!isset($_GET['action'])) {
    header("Location: ../views/seller_dashboard.php");
    exit();
}

$action = $_GET['action'];

switch ($action) {
    case "products":
        header("Location: ../views/manage_products.php");
        break;
    case "orders":
        header("Location: ../views/manage_orders.php");
        break;
    case "reports":
        header("Location: ../views/sales_report.php");
        break;
    case "feedback":
        header("Location: ../views/feedback_review.php");
        break;
    case "alerts":
        header("Location: ../views/inventory_alerts.php");
        break;
    case "discounts":
        header("Location: ../views/discounts.php");
        break;
    default:
        header("Location: ../views/seller_dashboard.php");
}
?>