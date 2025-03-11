<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_customer = $_POST['id_customer'];
    $id_sepeda = $_POST['id_sepeda'];
    $tanggal_sewa = $_POST['tanggal_sewa'];
    $tanggal_kembali = $_POST['tanggal_kembali'];
    $total_biaya = $_POST['total_biaya'];
    $status = $_POST['status'];

    $sql = "INSERT INTO rental (id_customer, id_sepeda, tanggal_sewa, tanggal_kembali, total_biaya, status) 
            VALUES ('$id_customer', '$id_sepeda', '$tanggal_sewa', '$tanggal_kembali', '$total_biaya', '$status')";

    if ($conn->query($sql) === TRUE) {
        header("Location: rental_index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$customers = $conn->query("SELECT * FROM customers");
$sepeda = $conn->query("SELECT * FROM sepeda");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="create.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Tambah Transaksi Rental</h2>
        <form method="POST" class="border p-4 rounded shadow-sm bg-light">
            <div class="mb-3">
                <label class="form-label">Pelanggan:</label>
                <select name="id_customer" class="form-select">
                    <?php while ($row = $customers->fetch_assoc()): ?>
                        <option value="<?= $row['id_customer'] ?>"><?= $row['nama'] ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Sepeda:</label>
                <select name="id_sepeda" class="form-select">
                    <?php while ($row = $sepeda->fetch_assoc()): ?>
                        <option value="<?= $row['id_sepeda'] ?>"><?= $row['merk'] ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Tanggal Sewa:</label>
                <input type="datetime-local" name="tanggal_sewa" class="form-control" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Tanggal Kembali:</label>
                <input type="datetime-local" name="tanggal_kembali" class="form-control">
            </div>
            
            <div class="mb-3">
                <label class="form-label">Total Biaya:</label>
                <input type="number" name="total_biaya" class="form-control" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Status:</label>
                <select name="status" class="form-select">
                    <option value="Disewa">Disewa</option>
                    <option value="Dikembalikan">Dikembalikan</option>
                </select>
            </div>
            
            <button type="submit" class="btn btn-info">Simpan</button>
            <a href="rental_index.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>
</html>
