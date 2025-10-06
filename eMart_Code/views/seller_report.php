<?php
include("../controllers/sellerReportController.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Sales Report</title>
    <link rel="stylesheet" href="../assets/css/seller_style.css">
</head>

<body class="seller">
    <header>
        <h1>📈 Sales Report</h1>
    </header>

    <main>
        <section style="margin:20px auto; max-width:1000px;">
            <div
                style="background:#fff; padding:20px; border-radius:8px; box-shadow:0 4px 10px rgba(0,0,0,0.1); text-align:center;">
                <h2>Total Revenue: ৳<?= number_format($totals['total_revenue'] ?? 0, 2) ?></h2>
                <h3>Total Orders: <?= $totals['total_orders'] ?? 0 ?></h3>
            </div>
        </section>

        <section style="margin:30px auto; max-width:1000px;">
            <h2 style="text-align:center; margin-bottom:15px;">Daily Breakdown</h2>
            <table>
                <tr>
                    <th>Date</th>
                    <th>Orders</th>
                    <th>Revenue</th>
                </tr>
                <?php if ($report && $report->num_rows > 0): ?>
                    <?php while ($row = $report->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['order_date'] ?></td>
                            <td><?= $row['total_orders'] ?></td>
                            <td>৳<?= number_format($row['daily_revenue'], 2) ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3">No sales data found</td>
                    </tr>
                <?php endif; ?>
            </table>
        </section>
    </main>
</body>

</html>