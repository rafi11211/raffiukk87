<?php
include 'config.php';
$result = $conn->query("SELECT * FROM customers");
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
    <title>Daftar Customer</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-info ">
        <div class="container">
            <a class="navbar-brand fw-bolder" href="#"><i class="bi bi-bicycle"></i> Rental Sepeda</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse fw-bolder" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link text-shadow" href="index.php">Customers</a></li>
                    <li class="nav-item"><a class="nav-link text-shadow" href="sepeda_index.php">Sepeda</a></li>
                    <li class="nav-item"><a class="nav-link text-shadow" href="rental_index.php">Rental</a></li>
                    <a href="../auth/logout.php" class="btn btn-danger ms-5 ">Logout</a>
                </ul>
            </div>
        </div>
    </div>
    </nav>

<div class="container mt-4">
     <!-- Menampilkan Notifikasi Sukses -->
     <?php if (!empty($welcomeMessage)): ?>
            <div class="alert alert-success"><?= $welcomeMessage; ?></div>
        <?php endif; ?>
    <h4>Halo <?= $_SESSION['user']; ?>👋</h4>
    <h2>Daftar Customer <i class="bi bi-person"></i></h2>
    <a href="create.php" class="btn btn-info mb-3 text-light"><i class="bi bi-pencil-square"></i> Tambah Customer</a>
    <table class="table table-bordered text-center">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>No Telepon</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) : ?>
            <tr>
                <td><?= $row['id_customer'] ?></td>
                <td><?= $row['nama'] ?></td>
                <td><?= $row['alamat'] ?></td>
                <td><?= $row['no_telp'] ?></td> 
                <td><?= $row['email'] ?></td>
                <td>
                    <a href="edit.php?id=<?= $row['id_customer'] ?>" class="btn btn-info btn-sm"><i class="bi bi-pencil"></i></a>
                    <a href="delete.php?id=<?= $row['id_customer'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')"><i class="bi bi-trash"></i></a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
