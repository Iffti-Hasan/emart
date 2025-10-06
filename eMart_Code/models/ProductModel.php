<?php

function getAllProducts($conn)
{
    return $conn->query("SELECT * FROM products ORDER BY id DESC");
}

function searchProducts($conn, $search)
{
    $stmt = $conn->prepare("SELECT * FROM products WHERE name LIKE ? OR description LIKE ? ORDER BY id DESC");
    $like = "%{$search}%";
    $stmt->bind_param("ss", $like, $like);
    $stmt->execute();
    return $stmt->get_result();
}

function getProductById($conn, $id)
{
    $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

function reduceProductQuantity($conn, $product_id, $qty)
{
    $stmt = $conn->prepare("UPDATE products SET quantity = quantity - ? WHERE id = ? AND quantity >= ?");
    $stmt->bind_param("iii", $qty, $product_id, $qty);
    return $stmt->execute();
}

function getProductQuantity($conn, $product_id)
{
    $stmt = $conn->prepare("SELECT quantity FROM products WHERE id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $res = $stmt->get_result()->fetch_assoc();
    return $res ? (int) $res['quantity'] : 0;
}
