<?php
session_start();
include "../config/database.php";

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user['username'];
            $_SESSION['success'] = "Login berhasil! Selamat datang, $username.";
            header("Location: ../dashboard/index.php");
            exit();
        } else {
            $_SESSION['error'] = "Password salah!";
        }
    } else {
        $_SESSION['error'] = "Username tidak ditemukan!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Rental Sepeda</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #74ebd5, #acb6e5);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-container {
            width: 100%;
            max-width: 400px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .login-container h2 {
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
            color: #333;
        }
        .btn-primary {
            width: 100%;
            background: #4CAF50;
            border: none;
        }
        .btn-primary:hover {
            background: #45a049;
        }
        .alert {
            font-size: 14px;
        }
        .link-register {
            display: block;
            text-align: center;
            margin-top: 15px;
        }
    </style>
</head>
<body>

<div class="login-container">
    <h2>Login</h2>

    <!-- Menampilkan Notifikasi -->
    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger"><?= $_SESSION['error']; ?></div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <form action="" method="POST">
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" name="login" class="btn btn-primary">Login</button>
    </form>

    <a href="register.php" class="link-register">Belum punya akun? Daftar</a>
</div>

</body>
</html>
