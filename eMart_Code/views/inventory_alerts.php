<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Stock Alerts - eMart</title>
    <link rel="stylesheet" href="../assets/css/seller_style.css">
</head>

<body class="seller">
    <header>
        <h1>⚠️ Stock Alerts</h1>
    </header>
    <main style="max-width:1000px; margin:20px auto;">
        <?php if (!empty($lowStockProducts)): ?>
            <?php foreach ($lowStockProducts as $product): ?>
                <div
                    style="background:#fff; padding:15px; margin-bottom:10px; border-radius:8px; box-shadow:0 2px 5px rgba(0,0,0,0.1);">
                    <p><strong>Product:</strong> <?= htmlspecialchars($product['name']) ?></p>
                    <p><strong>Quantity:</strong> <?= (int) $product['quantity'] ?></p>
                    <p style="color:red; font-weight:bold;">
                        <?= $product['quantity'] <= 0 ? "❌ Out of stock!" : "⚠️ Low stock! Reorder soon." ?>
                    </p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>All products have sufficient stock.</p>
        <?php endif; ?>
    </main>
</body>

</html>