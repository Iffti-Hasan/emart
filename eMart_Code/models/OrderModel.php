<?php

function createOrder($conn, $user_id, $total)
{
    $stmt = $conn->prepare("INSERT INTO orders (user_id, total) VALUES (?,?)");
    $stmt->bind_param("id", $user_id, $total);
    if ($stmt->execute())
        return $conn->insert_id;
    return false;
}

function addOrderItem($conn, $order_id, $product_id, $qty, $price)
{
    $stmt = $conn->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?,?,?,?)");
    $stmt->bind_param("iiid", $order_id, $product_id, $qty, $price);
    return $stmt->execute();
}

function getOrdersByUser($conn, $user_id)
{
    $stmt = $conn->prepare("SELECT * FROM orders WHERE user_id=? ORDER BY id DESC");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    return $stmt->get_result();
}

function getOrderItems($conn, $order_id)
{
    $stmt = $conn->prepare("SELECT oi.*, p.name FROM order_items oi JOIN products p ON oi.product_id=p.id WHERE oi.order_id=?");
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    return $stmt->get_result();
}
