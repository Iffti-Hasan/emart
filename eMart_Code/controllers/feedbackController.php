<?php

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../views/login.php");
    exit();
}

require_once("../config/db_connect.php");
require_once("../models/FeedbackModel.php");
require_once("../models/ProductModel.php");

$user_id = $_SESSION['user_id'];


if (isset($_POST['submit_feedback'])) {
    $product_id = (int) $_POST['product_id'];
    $message = trim($_POST['message']);

    if (!empty($message)) {
        addFeedback($conn, $user_id, $product_id, $message);
    }

    header("Location: ../controllers/feedbackController.php?product_id={$product_id}");
    exit();
}


if (isset($_GET['product_id'])) {
    $product_id = (int) $_GET['product_id'];
    $product = getProductById($conn, $product_id);
    $feedbackList = getFeedbackForProduct($conn, $product_id);

    include("../views/feedback.php");
} else {
    echo "<p class='empty-message'>Feedback UI is available on product detail pages. Browse products.</p>";
}
