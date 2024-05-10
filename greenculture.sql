-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 10 Bulan Mei 2024 pada 12.04
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
(36, 'Menciptakan Masa Depan Hijau: Peristiwa Ramah Lingkungan di Samarinda', '<div>Samarinda, sebuah kota yang berada di tengah-tengah kegiatan industri dan pembangunan, saat ini menunjukkan peran yang semakin penting dalam memerangi perubahan iklim dan mendorong keberlanjutan. Dengan meningkatnya kesadaran akan dampak negatif perubahan iklim, kota ini telah mengadakan sejumlah peristiwa yang bertujuan untuk mengurangi emisi karbon dan mewujudkan masa depan yang lebih hijau.&nbsp;<br><br>Salah satu peristiwa terkemuka yang mengguncang Samarinda adalah \"Samarinda Eco Summit\". Acara ini menyatukan para pemikir, pemimpin bisnis, dan aktivis lingkungan untuk berdiskusi tentang solusi inovatif dalam mengatasi tantangan perubahan iklim. Dari strategi pengelolaan limbah hingga promosi energi terbarukan, peserta summit berbagi pengetahuan dan pengalaman untuk mendorong langkah-langkah konkret menuju keberlanjutan. Selain itu, Samarinda juga menggelar \"Hari Peduli Lingkungan\", sebuah acara tahunan yang menekankan pentingnya keterlibatan masyarakat dalam perlindungan lingkungan.&nbsp;<br><br>Dalam acara ini, warga diajak untuk membersihkan sungai-sungai dan pantai, menanam pohon, dan melakukan kegiatan lain yang bertujuan untuk memperindah dan menjaga kebersihan lingkungan sekitar. Kota ini juga menjadi tuan rumah bagi \"Pekan Hijau\", rangkaian acara selama seminggu penuh yang menyoroti gaya hidup berkelanjutan. Dari pasar produk organik hingga workshop daur ulang, acara ini memberikan wadah bagi warga untuk belajar dan berpartisipasi dalam praktik-praktik ramah lingkungan yang dapat mereka terapkan dalam kehidupan sehari-hari. Peristiwa-peristiwa seperti ini bukan hanya menginspirasi warga Samarinda untuk bertindak dalam melawan perubahan iklim, tetapi juga menjadi contoh bagi kota-kota lain di Indonesia dan di seluruh dunia. Dengan kolaborasi antara pemerintah, masyarakat, dan sektor swasta, Samarinda menunjukkan bahwa transformasi menuju masa depan hijau bukanlah impian yang jauh dari jangkauan, tetapi merupakan tujuan yang dapat dicapai melalui kerja keras dan inovasi yang berkelanjutan.</div>', '663ded0991fb2.png', 'Disetujui', 1),
(37, 'Meminimalkan Jejak Karbon: Peristiwa Inovatif di Balikpapan', '<div><br>Balikpapan, sebuah kota yang dikenal dengan industri minyak dan gasnya, sekarang menjadi pusat perhatian karena upaya-upaya revolusionernya dalam memerangi perubahan iklim. Dengan peningkatan kesadaran akan pentingnya perlindungan lingkungan, kota ini telah meluncurkan serangkaian peristiwa inovatif yang bertujuan untuk mengurangi emisi karbon dan memperkuat keberlanjutan.<br><br></div><div>Salah satu peristiwa terbesar yang baru-baru ini menggetarkan Balikpapan adalah Konferensi Hijau \"Green Talks\". Konferensi ini bertujuan untuk mendatangkan pemikir dan pemimpin lingkungan dari seluruh dunia untuk berbagi pengetahuan, pengalaman, dan solusi dalam menghadapi tantangan perubahan iklim. Para peserta dari berbagai bidang, mulai dari ilmuwan lingkungan hingga aktivis masyarakat, berkumpul untuk merumuskan strategi bersama dalam mengurangi jejak karbon dan memperkuat ketahanan lingkungan.<br><br></div><div>Selain itu, Balikpapan juga menjadi tuan rumah bagi \"Hari Tanpa Kendaraan Motor\". Inisiatif ini mengajak warga untuk meninggalkan kendaraan bermesin dan beralih ke transportasi ramah lingkungan seperti sepeda, transportasi umum, dan berjalan kaki. Selama satu hari penuh, jalan-jalan utama di kota dipenuhi dengan kegiatan yang menarik, mulai dari pameran sepeda hingga jalan sehat massal, yang semuanya bertujuan untuk meningkatkan kesadaran akan pentingnya transportasi berkelanjutan.<br><br></div><div>Tidak hanya itu, Balikpapan juga mengadakan \"Pekan Hijau\", sebuah rangkaian acara selama seminggu penuh yang didedikasikan untuk promosi gaya hidup berkelanjutan. Dari bazar produk organik hingga lokakarya daur ulang, acara ini menawarkan berbagai kegiatan yang memotivasi warga untuk mengadopsi praktik ramah lingkungan dalam kehidupan sehari-hari mereka. Peristiwa-peristiwa seperti ini tidak hanya mengilhami warga Balikpapan untuk mengambil tindakan nyata dalam memerangi perubahan iklim, tetapi juga menjadi contoh bagi kota-kota lain di seluruh Indonesia dan di seluruh dunia. Dengan upaya bersama dan inovasi yang terus-menerus, Balikpapan membuktikan bahwa transformasi hijau bukanlah impian yang tidak tercapai, tetapi merupakan kenyataan yang dapat diwujudkan untuk mewariskan planet yang lebih baik kepada generasi mendatang.</div>', '663defbee0a0c.png', 'Disetujui', 1);

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
(1, 'Meminimalkan Jejak Karbon: Peristiwa Inovatif di Balikpapan', 'Di tengah kekhawatiran akan dampak perubahan iklim, Balikpapan, sebuah kota yang penting di Kalimantan Timur, menjadi sorotan karena upaya-upaya inovatifnya dalam mengurangi emisi karbon. Peristiwa terbaru di kota ini menunjukkan komitmen yang kuat untuk ', '2024-05-23', 'Jl. Ahmad Yani No.6, Balikpapan, Kalimantan Timur, Indonesia'),
(3, 'Menciptakan Masa Depan Hijau: Peristiwa Ramah Lingkungan di Samarinda', 'Samarinda, ibu kota Kalimantan Timur yang berkembang pesat, menjadi pusat perhatian karena upaya-upaya luar biasanya dalam menghadapi tantangan perubahan iklim. Melalui serangkaian peristiwa yang inovatif, kota ini menegaskan komitmennya untuk mengurangi ', '2024-05-10', 'Alun Alun Kota Samarinda, Kalimantan Timur, Indonesia');

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
  MODIFY `id_artikel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT untuk tabel `daftar_event`
--
ALTER TABLE `daftar_event`
  MODIFY `id_pendaftaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `event`
--
ALTER TABLE `event`
  MODIFY `id_event` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
