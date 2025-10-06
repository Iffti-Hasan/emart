<?php

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Orders</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body class="client">
    <header>
        <div><img src="../assets/images/emart-logo.png" alt="eMart Logo">
            <h1>Your Orders</h1>
        </div>
    </header>
    <div class="container-lg">
        <?php if ($orders && $orders->num_rows > 0): ?>
            <table>
                <tr>
                    <th>Order ID</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
                <?php while ($o = $orders->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $o['id']; ?></td>
                        <td>৳<?php echo number_format($o['total'], 2); ?></td>
                        <td><?php echo $o['status']; ?></td>
                        <td><?php echo $o['created_at']; ?></td>
                        <td><a href="../controllers/orderController.php?order_id=<?php echo $o['id']; ?>">Track</a></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php else: ?>
            <p class="empty-message">You have no orders.</p>
        <?php endif; ?>
    </div>
</body>

</html>