<?php
include 'config.php';
$result = $conn->query("SELECT * FROM sepeda");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Sepeda</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-info">
    <div class="container">
        <a class="navbar-brand fw-bolder" href="#"><i class="bi bi-bicycle"></i> Rental Sepeda</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse fw-bolder" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="index.php">Customers</a></li>
                <li class="nav-item"><a class="nav-link" href="sepeda_index.php">Sepeda</a></li>
                <li class="nav-item"><a class="nav-link" href="rental_index.php">Rental</a></li>
                <a href="../auth/logout.php" class="btn btn-danger ms-5 ">Logout</a>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <h2>Daftar Sepeda <i class="bi bi-bicycle"></i></h2>
    <a href="sepeda_create.php" class="btn btn-info mb-3"><i class="bi bi-pencil-square"></i> Tambah Sepeda</a>
    <table class="table table-bordered text-center">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Merk</th>
                <th>Tipe</th>
                <th>Warna</th>
                <th>Harga Sewa</th>
                <th>Foto</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) : ?>
            <tr>
                <td><?= $row['id_sepeda'] ?></td>
                <td><?= $row['merk'] ?></td>
                <td><?= $row['tipe'] ?></td>
                <td><?= $row['warna'] ?></td>
                <td>Rp<?= number_format($row['harga_sewa'], 2) ?></td>
                <td>
                    <img src="uploads/<?= $row['foto'] ?>" alt="Foto Sepeda" width="100" height="70">
                </td>
                <td><?= $row['status'] ?></td>
                <td>
                    <a href="sepeda_edit.php?id=<?= $row['id_sepeda'] ?>" class="btn btn-info btn-sm"><i class="bi bi-pencil"></i></a>
                    <a href="sepeda_delete.php?id=<?= $row['id_sepeda'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')"><i class="bi bi-trash"></i></a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
