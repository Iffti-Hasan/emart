<?php

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title><?php echo htmlspecialchars($product['name']); ?> - eMart</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body class="client">
    <header>
        <div class="logo-title">
            <img src="../assets/images/emart-logo.png" alt="eMart Logo">
            <h1>eMart</h1>
        </div>
        <nav>
            <a href="../controllers/indexController.php">Browse</a>
            <a href="../controllers/cartController.php?view=cart">Cart</a>
            <a href="../controllers/wishlistController.php?view=wishlist">Wishlist</a>
            <a href="../controllers/orderController.php?view=orders">Orders</a>
            <a href="../controllers/feedbackController.php">Feedback</a>
            <a href="../controllers/authController.php?logout=true">Logout</a>
        </nav>
    </header>

    <div class="container-lg">
        <div style="display:flex; gap:20px; align-items:flex-start;">

            <div style="flex:1;">
                <img src="../assets/images/products/<?php echo htmlspecialchars($product['image']); ?>"
                    style="width:100%; max-width:480px; border-radius:8px;">
            </div>


            <div style="flex:1;">
                <h2><?php echo htmlspecialchars($product['name']); ?></h2>
                <p><?php echo nl2br(htmlspecialchars($product['description'])); ?></p>
                <p class="price">৳<?php echo number_format($product['price'], 2); ?></p>
                <p class="stock">
                    <?php echo $product['quantity'] > 0
                        ? "In Stock ({$product['quantity']})"
                        : "<span class='out-of-stock'>Out of Stock</span>"; ?>
                </p>

                <?php if ($product['quantity'] > 0): ?>
                    <div class="actions">

                        <form method="post" action="../controllers/cartController.php">
                            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                            <label>Quantity:
                                <input type="number" name="quantity" value="1" min="1"
                                    max="<?php echo $product['quantity']; ?>">
                            </label><br><br>
                            <button type="submit" name="add_to_cart" class="btn-cart">Add to Cart</button>
                        </form>


                        <form method="post" action="../controllers/wishlistController.php">
                            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                            <button type="submit" name="add_to_wishlist" class="btn-wishlist">Add to Wishlist</button>
                        </form>


                        <a href="../controllers/feedbackController.php?product_id=<?php echo $product['id']; ?>"
                            class="btn-view">See or Add Feedback</a>
                    </div>
                <?php else: ?>
                    <button disabled>Out of Stock</button>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>

</html>