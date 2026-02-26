-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2026 at 02:56 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `barang`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Alat Tulis Kantor'),
(2, 'Elektronik & Gadget'),
(3, 'Furniture Kantor'),
(4, 'Alat Kebersihan'),
(5, 'Perlengkapan Keamanan'),
(6, 'Suku Cadang Kendaraan'),
(7, 'Peralatan Dapur Kantor'),
(11, 'Material Konstruksi');

-- --------------------------------------------------------

--
-- Table structure for table `pencarian`
--

CREATE TABLE `pencarian` (
  `id_pencarian` int(11) NOT NULL,
  `keyword` varchar(100) NOT NULL,
  `jumlah_hit` int(11) DEFAULT 1,
  `last_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pencarian`
--

INSERT INTO `pencarian` (`id_pencarian`, `keyword`, `jumlah_hit`, `last_updated`) VALUES
(1, 'pulpen', 12, '2026-02-09 05:24:01'),
(2, 'iphone', 28, '2026-02-24 21:22:39'),
(3, 'atk', 14, '2026-02-24 21:22:44'),
(4, 'alat tulis kantor', 3, '2026-02-24 21:32:13');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `foto_barang` varchar(255) DEFAULT NULL,
  `deskripsi_singkat` text DEFAULT NULL,
  `is_bestseller` tinyint(1) DEFAULT 0,
  `views` int(11) DEFAULT 0,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `id_kategori`, `nama_barang`, `slug`, `foto_barang`, `deskripsi_singkat`, `is_bestseller`, `views`, `date_created`) VALUES
(1, 1, 'Pulpen Standard Hitam', 'pulpen-standard-hitam', 'prod_1771762054.jpg', 'Pulpen untuk menulis di kertas baru', 0, 404, '2026-02-09 13:44:05'),
(2, 1, 'Pulpen Standard', 'pulpen-standard', 'prod_1770031064.jpg', 'Pulpen untuk menulis', 0, 57, '2026-02-01 13:44:05'),
(3, 2, 'Iphone 17', 'iphone-17', 'prod_1770031120.jpg', 'Iphone terbaru ', 0, 83, '2024-02-28 13:44:05'),
(4, 1, 'Pulpen Pilot', 'pulpen-pilot', 'prod_1770615382.jpg', 'Pulpen merk pilot', 0, 20, '2026-02-07 13:44:05'),
(5, 1, 'Pulpen Faster', 'pulpen-faster', 'prod_1770615453.jpg', 'Pulpen merk faster', 0, 34, '2025-12-31 13:44:05'),
(6, 2, 'Iphone 11', 'iphone-11', 'prod_1770730744.png', 'iphone 11', 0, 7, '2026-02-08 13:44:05'),
(7, 2, 'Iphone 12', 'iphone-12', 'prod_1770730759.jpg', 'Iphone 12', 0, 2, '2026-02-05 13:44:05'),
(8, 2, 'Iphone 13', 'iphone-13', 'prod_1770730779.jpg', 'Iphone 13', 0, 3, '2026-02-02 13:44:05'),
(9, 2, 'Iphone 14', 'iphone-14', 'prod_1770731597.jpg', 'Iphone 14', 0, 21, '2026-02-10 07:53:17'),
(2085, 1, 'Pensil Mekanikal Warna Warni', '', 'prod_1772019307.jpg', 'Pensil mekanikal warna warni merk Pilot', 0, 0, '2026-02-25 05:35:07'),
(2533, 1, 'Pensil Mekanikal', '', 'prod_1772019164.jpg', 'Pensil mekanikal warna hitam', 0, 1, '2026-02-25 05:32:44'),
(3194, 3, 'Auto Increment Hilang', 'auto-increment-hilang', 'prod_1771764661.png', 'mencoba menghilangkan auto increment', 0, 9, '2026-02-22 06:17:19'),
(4140, 1, 'Pensil Menggambar', '', 'prod_1772019402.jpg', 'Pensil mewarnai', 0, 0, '2026-02-25 05:36:42'),
(4704, 1, 'Pensil 2B Faber Castle ', '', 'prod_1772019542.jpg', 'Pensil 2B merk Faber Castle', 0, 2, '2026-02-25 05:39:02'),
(5870, 1, 'Pensil Menggambar Needle', '', 'prod_1772019485.jpg', 'Pensil mewarnai merk Silver Needle', 0, 0, '2026-02-25 05:38:05'),
(6727, 1, 'Pulpen Sanitizer', '', 'prod_1772019019.jpg', 'Pulpen Sanitizer', 0, 4, '2026-02-25 05:30:19'),
(8323, 1, 'Pulpen Standard B\'Live', '', 'prod_1772019064.jpg', 'Pulpen Standard merk B\'Live', 0, 2, '2026-02-25 05:31:04'),
(9393, 1, 'Buku Agenda Sampul Kulit', '', 'prod_1772112178.jpg', 'Buku agenda sampul kulit biru dongker', 0, 0, '2026-02-26 07:22:58');

-- --------------------------------------------------------

--
-- Table structure for table `produk_galeri`
--

CREATE TABLE `produk_galeri` (
  `id_galeri` int(11) NOT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `foto_tambahan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk_galeri`
--

INSERT INTO `produk_galeri` (`id_galeri`, `id_produk`, `foto_tambahan`) VALUES
(2, 1, '2a470b08685eae98fd9e39a30be16d32.jpeg'),
(3, 1, '4a6ac860de520a69ccedaea94ec08eb9.jpg'),
(4, 1, 'c9c4636e5a1da4a3e753bc78a65ed744.jpg'),
(5, 3, '8d17a876827d77ecad3e3e2b923a7eba.jpg'),
(6, 2, 'f812c53f342f05461d7693f80c8d402c.jpg'),
(9, 2, '4dbcaaa8b75b967fdd9109db40b2d43e.jpeg'),
(12, 2, 'd25bf902150d8a6958942605fe7ea1f6.jpg'),
(15, 3194, '16ecc6c9d54c2205535621c822f52b87.jpg'),
(16, 3194, '1077ca86b8cd689fd8134af445e5cdae.jpg'),
(17, 3194, 'cda61577f1da7a607be2b366c365c4cb.jpg'),
(18, 3194, '45627fb2387dac9034a6c139dd53c883.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `testimoni`
--

CREATE TABLE `testimoni` (
  `id_testi` int(11) NOT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `nama_pelanggan` varchar(100) DEFAULT NULL,
  `instansi` varchar(100) DEFAULT NULL,
  `isi_testimoni` text DEFAULT NULL,
  `foto_pelanggan` varchar(255) DEFAULT NULL,
  `status` enum('pending','tampil') DEFAULT 'pending',
  `date_created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `testimoni`
--

INSERT INTO `testimoni` (`id_testi`, `id_kategori`, `nama_pelanggan`, `instansi`, `isi_testimoni`, `foto_pelanggan`, `status`, `date_created`) VALUES
(1, 1, 'Muhammad Alfian', 'tes', 'tes mantap', 'apple_iphone-12-spring21_purple_04202021_big_jpg_large_2x.jpg', 'tampil', '2026-02-12 14:53:23'),
(2, 2, 'crf', 'crf', 'crf', 'apple_iphone-12-spring21_purple_04202021_big_jpg_large_2x1.jpg', 'tampil', '2026-02-12 14:59:23'),
(3, 2, 'revo', 'revo', 'revo mantap', 'HAMyi04acAAb0qo.jpg', 'tampil', '2026-02-12 15:10:47'),
(6, 1, 'Muhammad Fajar', 'Fajar Express', 'mencoba multi upload', 'default_user.png', 'tampil', '2026-02-13 06:47:30'),
(7, 1, 'Sakti', 'Sakti Express', 'tes hapus foto', 'default_user.png', 'tampil', '2026-02-13 06:58:43'),
(8, 1, 'sadsad', 'wdszdxzd', 'sdaasdsad', 'default_user.png', 'tampil', '2026-02-13 14:22:24');

-- --------------------------------------------------------

--
-- Table structure for table `testimoni_foto`
--

CREATE TABLE `testimoni_foto` (
  `id_foto` int(11) NOT NULL,
  `id_testi` int(11) NOT NULL,
  `nama_foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `testimoni_foto`
--

INSERT INTO `testimoni_foto` (`id_foto`, `id_testi`, `nama_foto`) VALUES
(1, 5, '09447453a4dca13bc38db04d84dc6fda.jpg'),
(2, 5, '6a7f4404de5e5e4a5fc99f93cf8648b4.jpg'),
(3, 5, '8f125d89caea12071e1e5c7628dfd279.png'),
(4, 5, 'df8f2f46b6f0101e13ce799f9d6ef1f8.jpg'),
(5, 6, '3e7caa30eb217ee7457b28a693b62e90.png'),
(6, 6, '91275d5a4897b6fc6bf931171804370a.jpg'),
(7, 6, 'babbfa2de5e6e1f1d4e06d1b4b0e49d4.jpg'),
(8, 6, '92834169f2fc61fe4ec81f771224f200.png'),
(9, 6, '87fac6150a5bea25999a482cead49f53.jpg'),
(10, 6, 'f8995438bf66a55dcd929263fe258eca.jpg'),
(11, 6, '64ad9b20086003f66cc8ad095aaa94ec.jpg'),
(12, 6, '6050dd68e58f4f483c321b7bad600caa.jpg'),
(13, 6, 'b18bb41c517cc31cf46f201241f2ab00.jpg'),
(15, 7, '362f1760d9c03529e63c822cb4a47a9d.jpg'),
(16, 7, '2a4d11887134b51118e5e1d78669e37b.jpg'),
(17, 7, '899eebc06be1cb3f96fbd5d97cd50e84.png'),
(18, 7, '3682cfed26aa81a7b34eb8f5e205a5d6.jpg'),
(19, 7, 'dfac5629a75c2da3cb51acb369e114d2.jpg'),
(20, 7, 'f38c2abd95ebcbf0e24e65ed9147e477.jpg'),
(21, 7, '6c530c330a06130ff24b147c8185984b.jpg'),
(22, 7, '6c17d9d90a1ada43b583f77fe6d7e2ea.jpg'),
(23, 8, '205b81f69d3f41587b4c080b9aaf749b.jpg'),
(24, 8, '9fff26396ad101e3a978807b280d94c3.jpg'),
(25, 8, '49a09ee351f4da3c57655d1d8334c683.png'),
(26, 8, '08a00ff49fb8788315a4eb48f1646746.jpg'),
(27, 8, '6bfb93b4a68673a5fcbb7d83ace261e3.jpeg'),
(28, 8, '13958b3ce22d6aa64638657d69e241d3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`) VALUES
(1, 'Admin', '$2y$10$6o95CNvuwikWDKIs0exRnevtrkJ8r9wDrzj1kNlODVRBo7r/Z3rBa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `pencarian`
--
ALTER TABLE `pencarian`
  ADD PRIMARY KEY (`id_pencarian`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `produk_galeri`
--
ALTER TABLE `produk_galeri`
  ADD PRIMARY KEY (`id_galeri`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `testimoni`
--
ALTER TABLE `testimoni`
  ADD PRIMARY KEY (`id_testi`);

--
-- Indexes for table `testimoni_foto`
--
ALTER TABLE `testimoni_foto`
  ADD PRIMARY KEY (`id_foto`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pencarian`
--
ALTER TABLE `pencarian`
  MODIFY `id_pencarian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `produk_galeri`
--
ALTER TABLE `produk_galeri`
  MODIFY `id_galeri` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `testimoni`
--
ALTER TABLE `testimoni`
  MODIFY `id_testi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `testimoni_foto`
--
ALTER TABLE `testimoni_foto`
  MODIFY `id_foto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE CASCADE;

--
-- Constraints for table `produk_galeri`
--
ALTER TABLE `produk_galeri`
  ADD CONSTRAINT `produk_galeri_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
