<?php
session_start();
if (!isset($_SESSION['seller'])) {
    header("Location: login.php");
    exit();
}
include("../config/db_connect.php");
?>

<!DOCTYPE html>
<html>

<head>
    <title>Manage Products - eMart</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body class="seller">
    <header>
        <div>
            <img src="../assets/images/emart-logo.png" alt="eMart Logo">
            <h1>Manage Products</h1>
        </div>
        <nav>
            <a href="../views/seller_dashboard.php">Dashboard</a>
            <a href="../controllers/authController.php?logout=true">Logout</a>
        </nav>
    </header>

    <div class="container">
        <h2 style="text-align:center;">Add New Product</h2>
        <form method="POST" action="../controllers/productController.php" enctype="multipart/form-data">
            <input type="text" name="name" placeholder="Product Name" required><br><br>
            <textarea name="description" placeholder="Product Description" rows="4" required></textarea><br><br>
            <input type="number" name="quantity" placeholder="Quantity" min="1" required><br><br>
            <input type="number" name="price" placeholder="Price" step="0.01" required><br><br>
            <input type="file" name="image" accept="image/*" required><br><br>
            <button type="submit" name="add_product">Add Product</button>
        </form>
    </div>

    <div class="container-lg">
        <h2 style="text-align:center;">All Products</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>

            <?php
            // Fetch all products for the single seller
            $result = $conn->query("SELECT * FROM products ORDER BY id DESC");
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['description']}</td>
                        <td>{$row['quantity']}</td>
                        <td>{$row['price']}</td>
                        <td><img src='../assets/images/products/{$row['image']}' width='80'></td>
                        <td>
                            <a href='../controllers/productController.php?action=edit&id={$row['id']}'>Edit</a> | 
                            <a href='../controllers/productController.php?action=delete&id={$row['id']}' onclick='return confirm(\"Are you sure?\");'>Delete</a>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='7' style='text-align:center;'>No products added yet.</td></tr>";
            }
            ?>
        </table>
    </div>
</body>

</html>