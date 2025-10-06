<?php

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../views/login.php");
    exit();
}
require_once("../config/db_connect.php");
require_once("../models/WishlistModel.php");

$user_id = $_SESSION['user_id'];

// add
if (isset($_POST['add_to_wishlist'])) {
    $product_id = (int) $_POST['product_id'];
    addToWishlist($conn, $user_id, $product_id);
    header("Location: ../controllers/wishlistController.php?view=wishlist");
    exit();
}

// view
if (isset($_GET['view']) && $_GET['view'] == 'wishlist') {
    $items = getWishlist($conn, $user_id);
    include("../views/wishlist.php");
    exit();
}

// remove
if (isset($_GET['action']) && $_GET['action'] == 'remove' && isset($_GET['id'])) {
    removeWishlistItem($conn, (int) $_GET['id']);
    header("Location: ../controllers/wishlistController.php?view=wishlist");
    exit();
}
