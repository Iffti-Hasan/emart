<?php
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Track Order</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body class="client">
    <header>
        <div><img src="../assets/images/emart-logo.png" alt="eMart Logo">
            <h1>Track Order</h1>
        </div>
    </header>
    <div class="container-lg">
        <?php if ($items && $items->num_rows > 0): ?>
            <table>
                <tr>
                    <th>Product</th>
                    <th>Qty</th>
                    <th>Price</th>
                </tr>
                <?php while ($it = $items->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($it['name']); ?></td>
                        <td><?php echo $it['quantity']; ?></td>
                        <td>৳<?php echo number_format($it['price'], 2); ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php else: ?>
            <p class="empty-message">Order not found or no items.</p>
        <?php endif; ?>
    </div>
</body>

</html>