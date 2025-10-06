<!DOCTYPE html>

<head>
    <title>Browse Products - eMart</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body class="client">
    <header>
        <div>
            <img src="../assets/images/emart-logo.png" alt="eMart Logo">
            <h1>Browse Products</h1>
        </div>
        <nav>
            <a href="index.php">Dashboard</a>
            <a href="cart.php">Cart</a>
            <a href="wishlist.php">Wishlist</a>
            <a href="order_history.php">Orders</a>
            <a href="track_order.php">Track</a>
            <a href="feedback.php">Feedback</a>
            <a href="../controllers/authController.php?logout=true">Logout</a>
        </nav>
    </header>


    <div class="container-lg">

        <form method="GET" action="../controllers/browseController.php" class="search-form">
            <input type="text" name="search" placeholder="Search products..."
                value="<?php echo htmlspecialchars($search); ?>">
            <button type="submit">Search</button>
        </form>


        <div class="product-grid">
            <?php if ($products && $products->num_rows > 0): ?>
                <?php while ($row = $products->fetch_assoc()): ?>
                    <div class="product-card">
                        <h3><?php echo htmlspecialchars($row['name']); ?></h3>
                        <p><?php echo htmlspecialchars($row['description']); ?></p>
                        <p class="price">$<?php echo number_format($row['price'], 2); ?></p>
                        <form method="POST" action="../controllers/cartController.php">
                            <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                            <button type="submit" name="add_to_cart">Add to Cart</button>
                        </form>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p class="no-products">No products found.</p>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>