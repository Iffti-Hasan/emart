<?php
session_start();
include("../config/db_connect.php");

// ========================
// REGISTER
// ========================
if (isset($_POST['register'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $password = $_POST['password'];
    $confirm = $_POST['confirm_password'];

    // Validation
    if (empty($name) || empty($email) || empty($phone) || empty($password) || empty($confirm)) {
        echo "All fields must be filled. <a href='../views/register.php'>Go Back</a>";
    } elseif (!preg_match("/^[a-zA-Z ]+$/", $name)) {
        echo "Name cannot contain numbers or symbols. <a href='../views/register.php'>Go Back</a>";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format. <a href='../views/register.php'>Go Back</a>";
    } elseif (!preg_match("/^[0-9]{1,11}$/", $phone)) {
        echo "Phone must be numbers only and max 11 digits. <a href='../views/register.php'>Go Back</a>";
    } elseif ($password !== $confirm) {
        echo "Passwords do not match. <a href='../views/register.php'>Go Back</a>";
    } else {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        // check for unique email & phone
        $check = $conn->prepare("SELECT * FROM users WHERE email=? OR phone=?");
        $check->bind_param("ss", $email, $phone);
        $check->execute();
        $result = $check->get_result();

        if ($result->num_rows > 0) {
            echo "User already exists with this email or phone. <a href='../views/register.php'>Go Back</a>";
        } else {
            $stmt = $conn->prepare("INSERT INTO users (name, email, phone, password) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $name, $email, $phone, $passwordHash);
            if ($stmt->execute()) {
                $_SESSION['username'] = $name;
                $_SESSION['user_id'] = $stmt->insert_id;
                $_SESSION['role'] = 'client';
                header("Location: ../controllers/indexController.php");
                exit();
            } else {
                echo "Error creating account. <a href='../views/register.php'>Try Again</a>";
            }
        }
    }
}

// ========================
// SELLER LOGIN
// ========================
if (isset($_POST['login']) && isset($_GET['seller'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Static seller credentials
    $sellerEmail = "seller@emart.com";
    $sellerPass = "seller123";

    if ($email === $sellerEmail && $password === $sellerPass) {
        $_SESSION['seller'] = true;
        $_SESSION['username'] = "Seller Admin";
        $_SESSION['role'] = 'seller';
        header("Location: ../views/seller_dashboard.php");
        exit();
    } else {
        echo "Invalid seller credentials. <a href='../views/login.php'>Try Again</a>";
    }
}

// ========================
// USER LOGIN
// ========================
if (isset($_POST['login']) && !isset($_GET['seller'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['username'] = $user['name'];
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = 'client';
        header("Location: ../controllers/indexController.php");
        exit();
    } else {
        echo "Invalid email or password. <a href='../views/login.php'>Try Again</a>";
    }
}

// ========================
// LOGOUT
// ========================
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: ../views/login.php");
    exit();
}
?>