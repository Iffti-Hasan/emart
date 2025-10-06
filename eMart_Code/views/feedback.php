<?php

?>
<!DOCTYPE html>
<html>

<head>

    <title>Feedback - <?php echo htmlspecialchars($product['name']); ?> | eMart</title>
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
            <a href="../controllers/authController.php?logout=true">Logout</a>
        </nav>
    </header>

    <div class="container" style="max-width:700px; text-align:left;">
        <h2>Feedback for <?php echo htmlspecialchars($product['name']); ?></h2>


        <form method="post" action="../controllers/feedbackController.php">
            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
            <textarea name="message" rows="4" placeholder="Write your feedback..." required
                style="width:100%; padding:10px; border-radius:6px; border:1px solid #ccc; margin-bottom:10px;"></textarea>
            <button type="submit" name="submit_feedback">Submit Feedback</button>
        </form>


        <h3 style="margin-top:30px;">Previous Feedback</h3>
        <?php if (!empty($feedbackList) && $feedbackList->num_rows > 0): ?>
            <?php while ($fb = $feedbackList->fetch_assoc()): ?>
                <div class="feedback-box">
                    <strong><?php echo htmlspecialchars($fb['name']); ?></strong>
                    <small>(<?php echo $fb['created_at']; ?>)</small>
                    <p><?php echo nl2br(htmlspecialchars($fb['message'])); ?></p>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p class="empty-message">No feedback yet. Be the first to leave one!</p>
        <?php endif; ?>
    </div>
</body>

</html>