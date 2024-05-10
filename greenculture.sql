-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 10 Bulan Mei 2024 pada 08.11
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `greenculture`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `akun`
--

CREATE TABLE `akun` (
  `id_akun` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role_akun` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `akun`
--

INSERT INTO `akun` (`id_akun`, `nama`, `username`, `email`, `password`, `role_akun`) VALUES
(1, 'rayhan', 'ray123', 'ray@gmail.com', '$2y$10$8Jp1ZcmoxXkhLhhc4gwJieiy8rp7A0mxfwff/jhDPIbmS0jFyNZLa', 'admin'),
(2, 'Abdullah Faiz', 'faizges', 'faiz1@gmail.com', '$2y$10$qKtijSXpAGKm0DvDKWcSiuETxDNNmR.z7GyRZoMhQ1iQ5deG67A4S', 'user'),
(3, 'Rikad Anggoro', 'rikad1', 'rikadomilos@gmail.com', '$2y$10$pntdW5MUVXW5jn5wEqgy1uyNZf.ZhIgkNadu8Yc8eZLEh3zXm97Si', 'user'),
(4, 'Dian Nurdiansyah', 'dian12ar', 'mhddiansyah@gmail.com', '$2y$10$j3lB7BXZrhdTNlQ12AU6r.DvSjNhuSp7yYGuMcWhARP1pWtYbHVSC', 'user'),
(5, 'Fauzan GH', 'fauzan1', 'fauzan@yahoo.com', '$2y$10$.6TOFSo9mz48mmMtLD18hutoer6qp.db0ENrNjkD6DLF0BmyJcNea', 'user');

-- --------------------------------------------------------

--
-- Struktur dari tabel `artikel`
--

CREATE TABLE `artikel` (
  `id_artikel` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `isi` text NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `status` enum('Menunggu','Disetujui','Ditolak') NOT NULL,
  `id_akun` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `artikel`
--

INSERT INTO `artikel` (`id_artikel`, `judul`, `isi`, `gambar`, `status`, `id_akun`) VALUES
(33, 'asdas', '<div>asdad</div>', '663cbf9a4db5f.png', 'Menunggu', 1),
(34, 'asda', '<div>adad</div>', '663d9e74300e6.png', 'Disetujui', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `daftar_event`
--

CREATE TABLE `daftar_event` (
  `id_pendaftaran` int(11) NOT NULL,
  `nama_pendaftar` varchar(100) NOT NULL,
  `email_pendaftar` varchar(100) NOT NULL,
  `status` enum('Menunggu','Disetujui') NOT NULL,
  `id_event` int(11) NOT NULL,
  `id_akun` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `daftar_event`
--

INSERT INTO `daftar_event` (`id_pendaftaran`, `nama_pendaftar`, `email_pendaftar`, `status`, `id_event`, `id_akun`) VALUES
(2, 'MUHAMMAD DIAN NURDIANSYAH ', 'dyanrexusid@gmail.com', 'Disetujui', 1, 2),
(6, 'Rikad', 'rikadkaltim@gmail.com', 'Disetujui', 3, 2),
(7, 'Faiz', 'faiz1@gmail.com', 'Disetujui', 3, 2),
(11, 'Rayhan Syah', 'forpropurchase6@gmail.com', 'Disetujui', 1, 2),
(13, 'Muhammad Rayhan', 'forpropurchase6@gmail.com', 'Disetujui', 3, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `event`
--

CREATE TABLE `event` (
  `id_event` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `tempat` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `event`
--

INSERT INTO `event` (`id_event`, `judul`, `deskripsi`, `tanggal`, `tempat`) VALUES
(1, 'Event balikpapan', 'dibalikpapan -  markoni', '2024-05-23', 'Pantai lamaru 2'),
(3, 'Event Unmul', 'di unmul', '2024-05-10', 'Unmul1');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id_akun`);

--
-- Indeks untuk tabel `artikel`
--
ALTER TABLE `artikel`
  ADD PRIMARY KEY (`id_artikel`),
  ADD KEY `id_akun` (`id_akun`);

--
-- Indeks untuk tabel `daftar_event`
--
ALTER TABLE `daftar_event`
  ADD PRIMARY KEY (`id_pendaftaran`),
  ADD KEY `fk_akunevent` (`id_akun`),
  ADD KEY `fk_event` (`id_event`);

--
-- Indeks untuk tabel `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id_event`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `akun`
--
ALTER TABLE `akun`
  MODIFY `id_akun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `artikel`
--
ALTER TABLE `artikel`
  MODIFY `id_artikel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `daftar_event`
--
ALTER TABLE `daftar_event`
  MODIFY `id_pendaftaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `event`
--
ALTER TABLE `event`
  MODIFY `id_event` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `artikel`
--
ALTER TABLE `artikel`
  ADD CONSTRAINT `fk_akun` FOREIGN KEY (`id_akun`) REFERENCES `akun` (`id_akun`);

--
-- Ketidakleluasaan untuk tabel `daftar_event`
--
ALTER TABLE `daftar_event`
  ADD CONSTRAINT `fk_akunevent` FOREIGN KEY (`id_akun`) REFERENCES `akun` (`id_akun`),
  ADD CONSTRAINT `fk_event` FOREIGN KEY (`id_event`) REFERENCES `event` (`id_event`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
