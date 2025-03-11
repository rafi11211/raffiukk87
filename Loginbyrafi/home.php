<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Sepeda</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #74ebd5, #acb6e5);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
        }
        h1 {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
        }
        .btn-custom {
            width: 100%;
            margin-bottom: 10px;
            font-size: 16px;
            padding: 10px;
        }
        .btn-login {
            background-color: #4CAF50;
            border: none;
            color: white;
        }
        .btn-login:hover {
            background-color: #45a049;
        }
        .btn-register {
            background-color: #008CBA;
            border: none;
            color: white;
        }
        .btn-register:hover {
            background-color: #007bb5;
        }
        .bike-img {
            width: 100%;
            max-width: 300px;
            border-radius: 10px;
            margin-bottom: 15px;
            animation: fadeIn 1.5s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.9); }
            to { opacity: 1; transform: scale(1); }
        }
    </style>
</head>
<body>

<?php
// Array gambar sepeda dari folder lokal
$bikes = [
    "assets/img/bike1.jpg",
    "assets/img/bike2.jpg",
    "assets/img/bike3.jpg",
    "assets/img/bike4.jpg",
    "assets/img/bike5.jpg"
];
// Pilih gambar secara acak
$randomBike = $bikes[array_rand($bikes)];
?>

<div class="container">
    <img src="<?= $randomBike ?>" alt="Sepeda Rental" class="bike-img">
    <h1>Selamat Datang di <br> Rental Sepeda 🚴‍♂️</h1>
    <a href="auth/login.php" class="btn btn-custom btn-login">🔑 Login</a>
    <a href="auth/register.php" class="btn btn-custom btn-register">📝 Register</a>
</div>

</body>
</html>
