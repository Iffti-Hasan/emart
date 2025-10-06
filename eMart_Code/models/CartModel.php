<?php

function getCartItems($conn, $user_id)
{
    $stmt = $conn->prepare("SELECT c.id as cart_id, p.* , c.quantity as cart_qty FROM cart c JOIN products p ON c.product_id=p.id WHERE c.user_id=?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    return $stmt->get_result();
}

function addToCart($conn, $user_id, $product_id, $quantity)
{

    $stmt = $conn->prepare("SELECT id, quantity FROM cart WHERE user_id=? AND product_id=?");
    $stmt->bind_param("ii", $user_id, $product_id);
    $stmt->execute();
    $res = $stmt->get_result();
    if ($row = $res->fetch_assoc()) {
        $newQty = $row['quantity'] + $quantity;
        $u = $conn->prepare("UPDATE cart SET quantity=? WHERE id=?");
        $u->bind_param("ii", $newQty, $row['id']);
        return $u->execute();
    } else {
        $i = $conn->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (?,?,?)");
        $i->bind_param("iii", $user_id, $product_id, $quantity);
        return $i->execute();
    }
}

function updateCartQuantity($conn, $cart_id, $quantity)
{
    $stmt = $conn->prepare("UPDATE cart SET quantity=? WHERE id=?");
    $stmt->bind_param("ii", $quantity, $cart_id);
    return $stmt->execute();
}

function removeCartItem($conn, $cart_id)
{
    $stmt = $conn->prepare("DELETE FROM cart WHERE id=?");
    $stmt->bind_param("i", $cart_id);
    return $stmt->execute();
}

function clearCart($conn, $user_id)
{
    $stmt = $conn->prepare("DELETE FROM cart WHERE user_id=?");
    $stmt->bind_param("i", $user_id);
    return $stmt->execute();
}
