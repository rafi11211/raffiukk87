-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Mar 2025 pada 09.36
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `customer_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `customers`
--

CREATE TABLE `customers` (
  `id_customer` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `customers`
--

INSERT INTO `customers` (`id_customer`, `nama`, `alamat`, `no_telp`, `email`, `created_at`) VALUES
(1, 'gibran', 'panyalaian', '09782837827323', 'sadkjs@gmail.com', '2025-03-11 03:08:59'),
(2, 'rafi', 'singgalang', '082372672467276', 'kevinresky3@gmail.com', '2025-03-11 03:44:19'),
(3, 'huda', 'pasa saayua', '09782837827323', 'sdad@gmail.com', '2025-03-11 04:10:13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rental`
--

CREATE TABLE `rental` (
  `id_rental` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `id_sepeda` int(11) NOT NULL,
  `tanggal_sewa` datetime NOT NULL,
  `tanggal_kembali` datetime DEFAULT NULL,
  `total_biaya` decimal(10,2) NOT NULL,
  `status` enum('Disewa','Dikembalikan') NOT NULL DEFAULT 'Disewa',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `rental`
--

INSERT INTO `rental` (`id_rental`, `id_customer`, `id_sepeda`, `tanggal_sewa`, `tanggal_kembali`, `total_biaya`, `status`, `created_at`) VALUES
(1, 1, 2, '2025-03-11 11:30:00', '2025-03-12 11:30:00', 99999999.99, 'Disewa', '2025-03-11 04:30:23'),
(2, 2, 1, '2025-03-11 12:00:00', '2025-03-12 12:00:00', 99999999.99, 'Disewa', '2025-03-11 05:00:26'),
(3, 3, 2, '2025-03-11 12:00:00', '2025-03-12 12:00:00', 99999999.99, 'Disewa', '2025-03-11 05:00:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sepeda`
--

CREATE TABLE `sepeda` (
  `id_sepeda` int(11) NOT NULL,
  `merk` varchar(50) NOT NULL,
  `tipe` varchar(50) NOT NULL,
  `warna` varchar(30) NOT NULL,
  `harga_sewa` decimal(10,2) NOT NULL,
  `status` enum('Tersedia','Disewa') NOT NULL DEFAULT 'Tersedia',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `sepeda`
--

INSERT INTO `sepeda` (`id_sepeda`, `merk`, `tipe`, `warna`, `harga_sewa`, `status`, `created_at`, `foto`) VALUES
(1, 'sepeda1', 'Hybrid', 'hitam x merah', 20.00, 'Disewa', '2025-03-11 04:21:47', 'bike5.jpg'),
(2, 'sepeda2', ' Fixie', 'hijau', 1.37, 'Tersedia', '2025-03-11 04:30:00', 'bike1.jpg'),
(3, 'sepeda3', 'MTB', 'biru', 30000.00, 'Disewa', '2025-03-11 05:01:02', 'bike4.jpg'),
(4, 'sepeda4', 'road', 'oren', 40000.00, 'Tersedia', '2025-03-11 05:19:43', 'bike5.jpg'),
(5, 'BMX', 'xvc', 'emas', 1111.00, 'Tersedia', '2025-03-11 07:28:17', 'bike2.jpg');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id_customer`);

--
-- Indeks untuk tabel `rental`
--
ALTER TABLE `rental`
  ADD PRIMARY KEY (`id_rental`),
  ADD KEY `id_customer` (`id_customer`),
  ADD KEY `id_sepeda` (`id_sepeda`);

--
-- Indeks untuk tabel `sepeda`
--
ALTER TABLE `sepeda`
  ADD PRIMARY KEY (`id_sepeda`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `customers`
--
ALTER TABLE `customers`
  MODIFY `id_customer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `rental`
--
ALTER TABLE `rental`
  MODIFY `id_rental` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `sepeda`
--
ALTER TABLE `sepeda`
  MODIFY `id_sepeda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `rental`
--
ALTER TABLE `rental`
  ADD CONSTRAINT `rental_ibfk_1` FOREIGN KEY (`id_customer`) REFERENCES `customers` (`id_customer`) ON DELETE CASCADE,
  ADD CONSTRAINT `rental_ibfk_2` FOREIGN KEY (`id_sepeda`) REFERENCES `sepeda` (`id_sepeda`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
