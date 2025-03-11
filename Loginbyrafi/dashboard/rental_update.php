<?php
include 'config.php';

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM rental WHERE id_rental = $id");
$data = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $status = $_POST['status'];
    $tanggal_kembali = $_POST['tanggal_kembali'];

    $sql = "UPDATE rental SET status='$status', tanggal_kembali='$tanggal_kembali' WHERE id_rental=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: rental_index.php");
        exit();
    } else {
        echo "<div class='alert alert-danger'>Error updating record: " . $conn->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Transaksi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow-lg p-4">
            <h2 class="text-center mb-4">Edit Transaksi Rental</h2>
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Status:</label>
                    <select name="status" class="form-select">
                        <option value="Disewa" <?= $data['status'] == 'Disewa' ? 'selected' : '' ?>>Disewa</option>
                        <option value="Dikembalikan" <?= $data['status'] == 'Dikembalikan' ? 'selected' : '' ?>>Dikembalikan</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tanggal Kembali:</label>
                    <input type="datetime-local" name="tanggal_kembali" value="<?= $data['tanggal_kembali'] ?>" class="form-control">
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="rental_index.php" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
