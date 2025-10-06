<?php

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../views/login.php");
    exit();
}
require_once("../config/db_connect.php");
require_once("../models/ProductModel.php");

if (!isset($_GET['id'])) {
    header("Location: ../controllers/indexController.php");
    exit();
}

$id = (int) $_GET['id'];
$product = getProductById($conn, $id);
if (!$product) {
    echo "Product not found.";
    exit();
}


include("../views/product_details.php");
