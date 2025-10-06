<?php
session_start();
if (!isset($_SESSION['seller'])) {
    header("Location: login.php");
    exit();
}

include("../config/db_connect.php");

// Get product from ID in session
if (!isset($_SESSION['edit_product_id'])) {
    header("Location: manage_products.php");
    exit();
}

$product_id = $_SESSION['edit_product_id'];

// Fetch product from database
$stmt = $conn->prepare("SELECT * FROM products WHERE id=?");
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();

if (!$product) {
    echo "Product not found.";
    exit();
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Edit Product - eMart</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body class="seller">
    <div class="container">
        <h2>Edit Product</h2>
        <form method="POST" action="../controllers/productController.php" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
            <input type="text" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required><br><br>
            <textarea name="description" rows="4"
                required><?php echo htmlspecialchars($product['description']); ?></textarea><br><br>
            <input type="number" name="quantity" value="<?php echo $product['quantity']; ?>" min="1" required><br><br>
            <input type="number" name="price" value="<?php echo $product['price']; ?>" step="0.01" required><br><br>
            <img src="../assets/images/products/<?php echo $product['image']; ?>" width="100"><br><br>
            <input type="file" name="image" accept="image/*"><br><br>
            <button type="submit" name="update_product">Update Product</button>
        </form>
    </div>
</body>

</html>