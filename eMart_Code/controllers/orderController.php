<?php

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../views/login.php");
    exit();
}
require_once("../config/db_connect.php");
require_once("../models/OrderModel.php");

$user_id = $_SESSION['user_id'];

if (isset($_GET['view']) && $_GET['view'] == 'orders') {
    $orders = getOrdersByUser($conn, $user_id);
    include("../views/order_history.php");
    exit();
}

if (isset($_GET['order_id'])) {
    $order_id = (int) $_GET['order_id'];
    $items = getOrderItems($conn, $order_id);
    include("../views/track_order.php");
    exit();
}
