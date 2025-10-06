<?php


function addFeedback($conn, $user_id, $product_id, $message)
{
    $stmt = $conn->prepare("INSERT INTO feedback (user_id, product_id, message) VALUES (?,?,?)");
    $stmt->bind_param("iis", $user_id, $product_id, $message);
    return $stmt->execute();
}

function getFeedbackForProduct($conn, $product_id)
{
    $stmt = $conn->prepare("SELECT f.*, u.name 
                            FROM feedback f 
                            JOIN users u ON f.user_id=u.id 
                            WHERE f.product_id=? 
                            ORDER BY created_at DESC");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    return $stmt->get_result();
}
