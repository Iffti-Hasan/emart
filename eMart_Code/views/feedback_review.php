<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Customer Feedback</title>
    <link rel="stylesheet" href="../assets/css/seller_style.css">
</head>

<body class="seller">
    <header>
        <h1>⭐ Customer Feedback</h1>
    </header>

    <main style="max-width:1000px; margin:20px auto;">
        <?php if ($feedbackList && $feedbackList->num_rows > 0): ?>
            <?php while ($f = $feedbackList->fetch_assoc()): ?>
                <div
                    style="background:#fff; padding:15px; margin-bottom:10px; border-radius:8px; box-shadow:0 2px 5px rgba(0,0,0,0.1);">
                    <p><strong>Product:</strong> <?= htmlspecialchars($f['product_name']); ?></p>
                    <p><strong>Customer:</strong> <?= htmlspecialchars($f['customer_name']); ?></p>
                    <p><strong>Comment:</strong> <?= htmlspecialchars($f['message']); ?></p>
                    <p><strong>Reply:</strong> <?= htmlspecialchars($f['reply'] ?? 'No reply yet'); ?></p>

                    <form method="post" style="margin-top:10px;">
                        <input type="hidden" name="feedback_id" value="<?= $f['id']; ?>">
                        <textarea name="reply" rows="2" placeholder="Type your reply..."
                            style="width:100%;"><?= htmlspecialchars($f['reply'] ?? ''); ?></textarea>
                        <br>
                        <button type="submit" style="margin-top:5px;">Submit Reply</button>
                    </form>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No feedback available.</p>
        <?php endif; ?>
    </main>
</body>

</html>