<?php
include 'config.php';

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM customers WHERE id_customer=$id");
$customer = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $no_telp = $_POST['no_telp'];
    $email = $_POST['email'];

    $sql = "UPDATE customers SET nama='$nama', alamat='$alamat', no_telp='$no_telp', email='$email' WHERE id_customer=$id";
    
    if ($conn->query($sql)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Edit Customer</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="create.css">
</head>
<body>
<div class="container mt-4">
    <h2>Edit Customer</h2>
    <form method="POST">
        <div class="mb-3">
            <label>Nama:</label>
            <input type="text" name="nama" class="form-control" value="<?= $customer['nama'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Alamat:</label>
            <textarea name="alamat" class="form-control" required><?= $customer['alamat'] ?></textarea>
        </div>
        <div class="mb-3">
            <label>No Telepon:</label>
            <input type="text" name="no_telp" class="form-control" value="<?= $customer['no_telp'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Email:</label>
            <input type="email" name="email" class="form-control" value="<?= $customer['email'] ?>" required>
        </div>
        <button type="submit" class="btn btn-info">Update</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</body>
</html>
