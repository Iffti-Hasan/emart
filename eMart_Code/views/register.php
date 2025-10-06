<!DOCTYPE html>
<html>

<head>
    <title>Register - eMart</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <div class="container" style="text-align:center;">
        <img src="../assets/images/emart-logo.png" alt="eMart Logo" style="height:60px;">
        <h2>Create eMart Account</h2>
        <form method="POST" action="../controllers/authController.php">
            <input type="text" name="name" placeholder="Full Name"><br><br>
            <input type="email" name="email" placeholder="Email"><br><br>
            <input type="text" name="phone" placeholder="Phone Number" maxlength="11"><br><br>
            <input type="password" name="password" placeholder="Password"><br><br>
            <input type="password" name="confirm_password" placeholder="Confirm Password"><br><br>
            <button type="submit" name="register">Register</button>
        </form>
        <p>Already have an account? <a href="login.php">Login</a></p>
    </div>
</body>

</html>