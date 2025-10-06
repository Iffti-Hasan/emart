<?php

function getWishlist($conn, $user_id)
{
    $stmt = $conn->prepare("SELECT w.id as wish_id, p.* FROM wishlist w JOIN products p ON w.product_id=p.id WHERE w.user_id=?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    return $stmt->get_result();
}

function addToWishlist($conn, $user_id, $product_id)
{
    $stmt = $conn->prepare("INSERT IGNORE INTO wishlist (user_id, product_id) VALUES (?,?)");
    $stmt->bind_param("ii", $user_id, $product_id);
    return $stmt->execute();
}

function removeWishlistItem($conn, $wish_id)
{
    $stmt = $conn->prepare("DELETE FROM wishlist WHERE id=?");
    $stmt->bind_param("i", $wish_id);
    return $stmt->execute();
}
