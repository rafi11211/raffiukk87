
<?php
include 'config.php';
$result = $conn->query("SELECT * FROM rental");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Rental</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
                    <li class="nav-item"><a class="nav-link" href="index.php">Customers</a></li>
                    <li class="nav-item"><a class="nav-link" href="sepeda_index.php">Sepeda</a></li>
                    <li class="nav-item"><a class="nav-link" href="rental_index.php">Rental</a></li>
                    <a href="../auth/logout.php" class="btn btn-danger ms-5 ">Logout</a>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-4">
        <h2>Daftar Rental <i class="bi bi-person-raised-hand"></i></h2>
        <a href="rental_create.php" class="btn btn-info mb-3"><i class="bi bi-pencil-square"></i> tambah rental</a>
        <table class="table table-striped table-bordered text-center">
            <thead class="table-dark">
                <tr>
                    <th>ID Rental</th>
                    <th>ID Customer</th>
                    <th>ID Sepeda</th>
                    <th>Tanggal Sewa</th>
                    <th>Tanggal Kembali</th>
                    <th>Total Biaya</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id_rental']; ?></td>
                    <td><?php echo $row['id_customer']; ?></td>
                    <td><?php echo $row['id_sepeda']; ?></td>
                    <td><?php echo $row['tanggal_sewa']; ?></td>
                    <td><?php echo $row['tanggal_kembali']; ?></td>
                    <td><?php echo $row['total_biaya']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                    <td>
                        <a href="rental_update.php?id=<?php echo $row['id_rental']; ?>" class="btn btn-info btn-sm"><i class="bi bi-pencil"></i></a>
                        <a href="rental_delete.php?id=<?php echo $row['id_rental']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?');"><i class="bi bi-trash"></i></a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
      
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
