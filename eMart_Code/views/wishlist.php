<?php
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Wishlist</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body class="client">
    <header>
        <div class="logo-title">
            <img src="../assets/images/emart-logo.png" alt="eMart Logo">
            <h1>Your Wishlist</h1>
        </div>
        <nav>
            <a href="../controllers/indexController.php">Browse</a>
            <a href="../controllers/cartController.php?view=cart">Cart</a>
            <a href="../controllers/wishlistController.php?view=wishlist">Wishlist</a>
            <a href="../controllers/orderController.php?view=orders">Orders</a>
            <a href="../controllers/authController.php?logout=true">Logout</a>
        </nav>
    </header>
    <div class="container-lg">
        <?php if ($items && $items->num_rows > 0): ?>
            <div class="products-grid">
                <?php while ($r = $items->fetch_assoc()): ?>
                    <div class="product-card">
                        <img src="../assets/images/products/<?php echo htmlspecialchars($r['image']); ?>" alt="Product">
                        <h3><?php echo htmlspecialchars($r['name']); ?></h3>
                        <p class="price">৳<?php echo number_format($r['price'], 2); ?></p>

                        <div class="actions">
                            <?php if ($r['quantity'] > 0): ?>
                                <form method="post" action="../controllers/cartController.php">
                                    <input type="hidden" name="product_id" value="<?php echo $r['id']; ?>">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" name="add_to_cart" class="btn-cart">Move to Cart</button>
                                </form>
                            <?php else: ?>
                                <button disabled>Out of Stock</button>
                            <?php endif; ?>

                            <a href="../controllers/wishlistController.php?action=remove&id=<?php echo $r['wish_id']; ?>"
                                onclick="return confirm('Remove?')" class="btn-wishlist"
                                style="display:block; text-align:center; text-decoration:none; padding:8px 0; border-radius:4px;">
                                Remove
                            </a>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <p class="empty-message">Your wishlist is empty.</p>
        <?php endif; ?>
    </div>
</body>

</html>