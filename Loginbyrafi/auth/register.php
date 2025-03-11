<?php
session_start();
include "../config/database.php";

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
    if (mysqli_query($conn, $query)) {
        $_SESSION['success'] = "Registrasi berhasil! Silakan login.";
        header("Location: login.php");
        exit();
    } else {
        $_SESSION['error'] = "Registrasi gagal! Silakan coba lagi.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Rental Sepeda</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #74ebd5, #acb6e5);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .register-container {
            width: 100%;
            max-width: 400px;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
     
        }
        .btn-primary {
            width: 100%;
            background: #008CBA;
            border: none;
        }
        .btn-primary:hover {
            background: #007bb5;
        }
        .alert {
            font-size: 14px;
        }
        .link-login {
            display: block;
            margin-top: 15px;
        }
    </style>
</head>
<body>

<div class="register-container">
    <h2 class="text-center">Registrasi</h2>

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
        <button type="submit" name="register" class="btn btn-primary">Daftar</button>
    </form>

    <a href="login.php" class="link-login text-center">Sudah punya akun? Login</a>
</div>

</body>
</html>
