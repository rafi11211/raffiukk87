<?php
include 'config.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "ID tidak ditemukan!";
    exit();
}

$id = $conn->real_escape_string($_GET['id']);
$result = $conn->query("SELECT * FROM sepeda WHERE id_sepeda='$id'");

if ($result->num_rows == 0) {
    echo "Data tidak ditemukan!";
    exit();
}

$sepeda = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $merk = $conn->real_escape_string($_POST['merk']);
    $tipe = $conn->real_escape_string($_POST['tipe']);
    $warna = $conn->real_escape_string($_POST['warna']);
    $harga_sewa = $conn->real_escape_string($_POST['harga_sewa']);
    $status = $conn->real_escape_string($_POST['status']);

    // Cek apakah ada file foto yang diunggah
    $foto = $sepeda['foto']; // Simpan foto lama jika tidak ada unggahan baru

    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $targetDir = "uploads/"; // Folder penyimpanan gambar
        $fileName = basename($_FILES["foto"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

        // Validasi format file
        $allowedTypes = array("jpg", "jpeg", "png", "gif");
        if (in_array($fileType, $allowedTypes)) {
            if (move_uploaded_file($_FILES["foto"]["tmp_name"], $targetFilePath)) {
                // Hapus foto lama jika ada
                if (!empty($sepeda['foto']) && file_exists($targetDir . $sepeda['foto'])) {
                    unlink($targetDir . $sepeda['foto']);
                }
                $foto = $fileName; // Simpan nama file baru
            } else {
                echo "Gagal mengunggah gambar.";
                exit();
            }
        } else {
            echo "Format gambar tidak valid. Hanya JPG, JPEG, PNG, dan GIF yang diperbolehkan.";
            exit();
        }
    }

    // Query update dengan foto
    $sql = "UPDATE sepeda SET merk='$merk', tipe='$tipe', warna='$warna', harga_sewa='$harga_sewa', foto='$foto', status='$status' WHERE id_sepeda='$id'";

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
    <title>Edit Sepeda</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="create.css">
</head>
<body>
<div class="container mt-4">
    <h2>Edit Sepeda</h2>
    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label>Merk:</label>
            <input type="text" name="merk" class="form-control" value="<?= htmlspecialchars($sepeda['merk']) ?>" required>
        </div>
        <div class="mb-3">
            <label>Tipe:</label>
            <input type="text" name="tipe" class="form-control" value="<?= htmlspecialchars($sepeda['tipe']) ?>" required>
        </div>
        <div class="mb-3">
            <label>Warna:</label>
            <input type="text" name="warna" class="form-control" value="<?= htmlspecialchars($sepeda['warna']) ?>" required>
        </div>
        <div class="mb-3">
            <label>Harga Sewa:</label>
            <input type="number" step="0.01" name="harga_sewa" class="form-control" value="<?= htmlspecialchars($sepeda['harga_sewa']) ?>" required>
        </div>
        <div class="mb-3">
            <label>Foto Sepeda:</label>
            <input type="file" name="foto" class="form-control" accept="image/*">
            <?php if (!empty($sepeda['foto'])): ?>
                <div class="mt-2">
                    <img src="uploads/<?= htmlspecialchars($sepeda['foto']) ?>" alt="Foto Sepeda" width="150">
                </div>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label>Status:</label>
            <select name="status" class="form-control">
                <option value="Tersedia" <?= $sepeda['status'] == 'Tersedia' ? 'selected' : '' ?>>Tersedia</option>
                <option value="Disewa" <?= $sepeda['status'] == 'Disewa' ? 'selected' : '' ?>>Disewa</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="sepeda_index.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</body>
</html>
