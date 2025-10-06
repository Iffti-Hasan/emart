<?php
require_once("../controllers/sellerOrderController.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Manage Orders</title>
    <link rel="stylesheet" href="../assets/css/seller_style.css">
</head>

<body class="seller">
    <header>
        <h1>Manage Customer Orders</h1>
    </header>
    <main>
        <table>
            <tr>
                <th>ID</th>
                <th>Customer</th>
                <th>Total Price</th>
                <th>Status</th>
                <th>Placed At</th>
                <th>Action</th>
            </tr>
            <?php if ($orders && $orders->num_rows > 0): ?>
                <?php while ($row = $orders->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= htmlspecialchars($row['customer_name']) ?></td>
                        <td>৳<?= number_format($row['total'], 2) ?></td>
                        <td><?= htmlspecialchars($row['status']) ?></td>
                        <td><?= $row['created_at'] ?></td>
                        <td>
                            <form method="post" action="../controllers/sellerOrderController.php">
                                <input type="hidden" name="order_id" value="<?= $row['id'] ?>">
                                <select name="status">
                                    <option <?= $row['status'] == "Pending" ? "selected" : "" ?>>Pending</option>
                                    <option <?= $row['status'] == "Processing" ? "selected" : "" ?>>Processing</option>
                                    <option <?= $row['status'] == "Shipped" ? "selected" : "" ?>>Shipped</option>
                                    <option <?= $row['status'] == "Delivered" ? "selected" : "" ?>>Delivered</option>
                                </select>
                                <input type="submit" value="Update">
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">No orders found</td>
                </tr>
            <?php endif; ?>
        </table>
    </main>
</body>

</html>