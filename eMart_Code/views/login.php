<!DOCTYPE html>
<html>

<head>
    <title>Login - eMart</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <script>
        function toggleSellerMode() {
            const body = document.body;
            const form = document.getElementById("loginForm");
            const sellerCheck = document.getElementById("sellerMode");

            if (sellerCheck.checked) {
                body.classList.remove("client");
                body.classList.add("seller");
                form.action = "../controllers/authController.php?seller=1";
                document.getElementById("formTitle").innerText = "Seller Login";
            } else {
                body.classList.remove("seller");
                body.classList.add("client");
                form.action = "../controllers/authController.php";
                document.getElementById("formTitle").innerText = "Login to eMart";
            }
        }
    </script>
</head>

<body class="login <?php echo $_SESSION['role'] ?? 'client'; ?>">

    <div class="container" style="text-align:center;">
        <img src="../assets/images/emart-logo.png" alt="eMart Logo" style="height:60px;">
        <h2 id="formTitle">Login to eMart</h2>
        <form method="POST" id="loginForm" action="../controllers/authController.php">
            <input type="email" name="email" placeholder="Email" required><br><br>
            <input type="password" name="password" placeholder="Password" required><br><br>
            <label>
                <input type="checkbox" id="sellerMode" onclick="toggleSellerMode()"> Login as Seller
            </label><br><br>
            <button type="submit" name="login">Login</button>
        </form>
        <p>Don’t have an account? <a href="register.php">Register</a></p>
    </div>
</body>

</html>