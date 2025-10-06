<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>eMart - Dashboard</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body class="dashboard">


    <header>
        <div class="logo-title">
            <img src="../assets/images/emart-logo.png" alt="eMart Logo">
            <h1>Welcome to eMart, <?php echo htmlspecialchars($_SESSION['username'] ?? 'Guest'); ?></h1>
        </div>

        <nav>

            <form class="nav-search" method="get" action="../controllers/indexController.php">
                <input type="text" name="search" placeholder="Search products..."
                    value="<?php echo htmlspecialchars($search ?? ''); ?>">
                <button type="submit">Search</button>
            </form>


            <a href="../controllers/cartController.php?view=cart">Cart</a>
            <a href="../controllers/wishlistController.php?view=wishlist">Wishlist</a>
            <a href="../controllers/orderController.php?view=orders">Orders</a>
            <a href="../controllers/orderController.php?view=orders">Track</a>
            <a href="../controllers/feedbackController.php">Feedback</a>
            <a href="../controllers/authController.php?logout=true">Logout</a>
        </nav>
    </header>


    <div class="products-grid">
        <?php if (isset($products) && $products && $products->num_rows > 0): ?>
            <?php while ($row = $products->fetch_assoc()): ?>
                <div class="product-card">
                    <img src="../assets/images/products/<?php echo htmlspecialchars($row['image']); ?>" alt="Product">
                    <h3><?php echo htmlspecialchars($row['name']); ?></h3>
                    <p><?php echo htmlspecialchars($row['description']); ?></p>
                    <p class="price">৳<?php echo number_format($row['price'], 2); ?></p>
                    <p class="stock <?php echo $row['quantity'] > 0 ? '' : 'out-of-stock'; ?>">
                        <?php echo $row['quantity'] > 0 ? "In Stock ({$row['quantity']})" : "Out of Stock"; ?>
                    </p>

                    <?php if ($row['quantity'] > 0): ?>
                        <div class="actions">

                            <form method="post" action="../controllers/cartController.php">
                                <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" name="add_to_cart" class="btn-cart">Add to Cart</button>
                            </form>


                            <form method="post" action="../controllers/wishlistController.php">
                                <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                                <button type="submit" name="add_to_wishlist" class="btn-wishlist">Add to Wishlist</button>
                            </form>


                            <a href="../controllers/productController.php?id=<?php echo $row['id']; ?>" class="btn-view">
                                View / Buy
                            </a>
                        </div>
                    <?php else: ?>
                        <button disabled>Out of Stock</button>
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p class="empty-message">No products found.</p>
        <?php endif; ?>
    </div>

</body>

</html>