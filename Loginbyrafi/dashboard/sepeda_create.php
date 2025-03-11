<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $merk = $_POST['merk'];
    $tipe = $_POST['tipe'];
    $warna = $_POST['warna'];
    $harga_sewa = $_POST['harga_sewa'];
    $status = $_POST['status'];

    // Proses Upload Foto
    $foto = "";
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $targetDir = "uploads/"; // Folder penyimpanan gambar
        $fileName = basename($_FILES["foto"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

        // Validasi format file
        $allowedTypes = array("jpg", "jpeg", "png", "gif");
        if (in_array($fileType, $allowedTypes)) {
            if (move_uploaded_file($_FILES["foto"]["tmp_name"], $targetFilePath)) {
                $foto = $fileName; // Simpan nama file ke database
            } else {
                echo "Gagal mengunggah gambar.";
                exit();
            }
        } else {
            echo "Format gambar tidak valid. Hanya JPG, JPEG, PNG, dan GIF yang diperbolehkan.";
            exit();
        }
    }

    // Simpan data ke database
    $sql = "INSERT INTO sepeda (merk, tipe, warna, harga_sewa, foto, status) 
            VALUES ('$merk', '$tipe', '$warna', '$harga_sewa', '$foto', '$status')";

    if ($conn->query($sql)) {
        header("Location: sepeda_index.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Tambah Sepeda</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="create.css">
</head>
<body>
<div class="container mt-4">
    <h2>Tambah Sepeda</h2>
    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label>Merk:</label>
            <input type="text" name="merk" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Tipe:</label>
            <input type="text" name="tipe" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Warna:</label>
            <input type="text" name="warna" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Harga Sewa:</label>
            <input type="number" step="0.01" name="harga_sewa" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Foto Sepeda:</label>
            <input type="file" name="foto" class="form-control" accept="image/*">
        </div>
        <div class="mb-3">
            <label>Status:</label>
            <select name="status" class="form-control">
                <option value="Tersedia">Tersedia</option>
                <option value="Disewa">Disewa</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="sepeda_index.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</body>
</html>
