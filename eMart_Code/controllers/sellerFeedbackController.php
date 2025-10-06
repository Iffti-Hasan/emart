<?php
session_start();
require_once("../config/db_connect.php");
require_once("../models/FeedbackModel.php");

// Only sellers
if (!isset($_SESSION['seller'])) {
    header("Location: ../views/login.php");
    exit();
}

// Handle seller reply submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['feedback_id'], $_POST['reply'])) {
    $feedback_id = (int) $_POST['feedback_id'];
    $reply = trim($_POST['reply']);
    replyToFeedback($conn, $feedback_id, $reply);

    // Redirect to avoid resubmission
    header("Location: ../controllers/sellerFeedbackController.php");
    exit();
}

// Fetch all feedback for dashboard
$feedbackList = getAllFeedback($conn);

// Include seller feedback view
include("../views/feedback_review.php");
