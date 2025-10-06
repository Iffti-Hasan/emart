<?php

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../views/login.php");
    exit();
}
require_once("../config/db_connect.php");
require_once("../models/CartModel.php");
require_once("../models/ProductModel.php");

$user_id = $_SESSION['user_id'];

// Add to cart
if (isset($_POST['add_to_cart'])) {
    $product_id = (int) $_POST['product_id'];
    $qty = isset($_POST['quantity']) ? max(1, (int) $_POST['quantity']) : 1;

    // check stock
    $available = getProductQuantity($conn, $product_id);
    if ($available < $qty) {
        $_SESSION['error'] = "Requested quantity not available.";
        header("Location: ../controllers/productController.php?id={$product_id}");
        exit();
    }

    // add
    addToCart($conn, $user_id, $product_id, $qty);
    header("Location: ../controllers/cartController.php?view=cart");
    exit();
}

// view cart
if (isset($_GET['view']) && $_GET['view'] == 'cart') {
    $items = getCartItems($conn, $user_id);
    include("../views/cart.php");
    exit();
}

// update quantity
if (isset($_POST['update_cart'])) {
    $cart_id = (int) $_POST['cart_id'];
    $qty = max(1, (int) $_POST['quantity']);


    $stmt = $conn->prepare("SELECT product_id FROM cart WHERE id=?");
    $stmt->bind_param("i", $cart_id);
    $stmt->execute();
    $res = $stmt->get_result()->fetch_assoc();
    if ($res) {
        $available = getProductQuantity($conn, $res['product_id']);
        if ($qty > $available) {
            $_SESSION['error'] = "Cannot set quantity greater than stock.";
            header("Location: ../controllers/cartController.php?view=cart");
            exit();
        }
    }

    updateCartQuantity($conn, $cart_id, $qty);
    header("Location: ../controllers/cartController.php?view=cart");
    exit();
}

// remove cart item
if (isset($_GET['action']) && $_GET['action'] == 'remove' && isset($_GET['id'])) {
    removeCartItem($conn, (int) $_GET['id']);
    header("Location: ../controllers/cartController.php?view=cart");
    exit();
}

if (isset($_POST['checkout'])) {
    require_once("../models/OrderModel.php");
    $items = getCartItems($conn, $user_id);
    $total = 0;
    $rows = [];
    while ($r = $items->fetch_assoc()) {
        if ($r['cart_qty'] > $r['quantity']) {
            $_SESSION['error'] = "Not enough stock for product: {$r['name']}";
            header("Location: ../controllers/cartController.php?view=cart");
            exit();
        }
        $rows[] = $r;
        $total += $r['cart_qty'] * $r['price'];
    }
    if (empty($rows)) {
        $_SESSION['error'] = "Cart is empty.";
        header("Location: ../controllers/cartController.php?view=cart");
        exit();
    }

    $order_id = createOrder($conn, $user_id, $total);
    foreach ($rows as $r) {
        addOrderItem($conn, $order_id, $r['id'], $r['cart_qty'], $r['price']);
        // reduce stock
        reduceProductQuantity($conn, $r['id'], $r['cart_qty']);
    }
    // clear cart
    clearCart($conn, $user_id);
    header("Location: ../controllers/orderController.php?view=orders");
    exit();
}
