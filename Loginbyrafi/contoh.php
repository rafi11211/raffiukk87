<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../auth/login.php");
    exit();
}

$welcomeMessage = isset($_SESSION['success']) ? $_SESSION['success'] : "";
unset($_SESSION['success']);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Selamat Datang, <?= $_SESSION['user']; ?>!</h2>

        <!-- Menampilkan Notifikasi Sukses -->
        <?php if (!empty($welcomeMessage)): ?>
            <div class="alert alert-success"><?= $welcomeMessage; ?></div>
        <?php endif; ?>

        <a href="../auth/logout.php" class="btn btn-danger mt-3">Logout</a>
    </div>
</body>
</html>
