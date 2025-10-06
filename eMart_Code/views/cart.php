<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>

<head>

    <title>Your Cart</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body class="client">
    <header>
        <div class="logo-title">
            <img src="../assets/images/emart-logo.png" alt="eMart Logo">
            <h1>Your Cart</h1>
        </div>
        <nav>
            <a href="../controllers/indexController.php">Browse</a>
            <a href="../controllers/wishlistController.php?view=wishlist">Wishlist</a>
            <a href="../controllers/orderController.php?view=orders">Orders</a>
            <a href="../controllers/authController.php?logout=true">Logout</a>
        </nav>
    </header>

    <div class="container-lg">
        <?php if (isset($_SESSION['error'])): ?>
            <p style="color:red;"><?php echo htmlspecialchars($_SESSION['error']); ?></p>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <?php if ($items && $items->num_rows > 0): ?>
            <table>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Subtotal</th>
                    <th>Action</th>
                </tr>
                <?php
                $total = 0;
                while ($r = $items->fetch_assoc()):
                    $subtotal = $r['cart_qty'] * $r['price'];
                    $total += $subtotal; ?>
                    <tr>
                        <td><?php echo htmlspecialchars($r['name']); ?></td>
                        <td>৳<?php echo number_format($r['price'], 2); ?></td>
                        <td>
                            <form method="post" action="../controllers/cartController.php" style="display:inline;">
                                <input type="hidden" name="cart_id" value="<?php echo $r['cart_id']; ?>">
                                <input type="number" name="quantity" value="<?php echo $r['cart_qty']; ?>" min="1"
                                    style="width:60px;">
                                <button type="submit" name="update_cart">Update</button>
                            </form>
                        </td>
                        <td>৳<?php echo number_format($subtotal, 2); ?></td>
                        <td>
                            <a href="../controllers/cartController.php?action=remove&id=<?php echo $r['cart_id']; ?> "
                                onclick="return confirm('Remove?')" class="remove-link">Remove</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
                <tr>
                    <td colspan="3" style="text-align:right;"><strong>Total</strong></td>
                    <td colspan="2">৳<?php echo number_format($total, 2); ?></td>
                </tr>
            </table>


            <div class="checkout-container">
                <form method="post" action="../controllers/cartController.php">
                    <button type="submit" name="checkout">Place Order</button>
                </form>
            </div>

        <?php else: ?>
            <p class="empty-message">Your cart is empty.</p>
        <?php endif; ?>
    </div>
</body>

</html>