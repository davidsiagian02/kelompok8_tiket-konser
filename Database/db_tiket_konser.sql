-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 09, 2025 at 09:20 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_tiket_konser`
--

-- --------------------------------------------------------

--
-- Stand-in structure for view `daftarkonser`
-- (See below for the actual view)
--
CREATE TABLE `daftarkonser` (
`id_konser` int(11)
,`nama_konser` varchar(255)
,`artis` varchar(255)
,`tanggal` date
,`lokasi` varchar(255)
,`gambar_url` varchar(255)
,`harga_tiket` decimal(10,2)
,`stok_tiket` int(11)
);

-- --------------------------------------------------------

--
-- Table structure for table `konser`
--

CREATE TABLE `konser` (
  `id_konser` int(11) NOT NULL,
  `nama_konser` varchar(255) NOT NULL,
  `artis` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `gambar_url` varchar(255) DEFAULT NULL,
  `harga_tiket` decimal(10,2) NOT NULL,
  `stok_tiket` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `konser`
--

INSERT INTO `konser` (`id_konser`, `nama_konser`, `artis`, `tanggal`, `lokasi`, `gambar_url`, `harga_tiket`, `stok_tiket`) VALUES
(4, 'Night Christmast Special', 'Judika, Agnez Monica, Lyodra, Ari Lasso', '2025-12-25', 'Stadion Gelora Bung Karno', 'https://cdn.pixabay.com/photo/2021/12/17/13/29/concert-6876577_1280.jpg', 0.00, 5000),
(5, 'Alan Walker to Indonesia', 'Alan Walker', '2025-06-26', 'Stadion Keramat Jati', 'https://blue.kumparan.com/image/upload/fl_progressive,fl_lossy,c_fill,f_auto,q_auto:best,w_640/v1634025439/01hg9wpqerf01y2rj0002758ax.jpg', 1500000.00, 0),
(6, 'Dewa 19: featuring All Stars 2.0', 'Dewa 19', '2025-06-30', 'Stadion Gelora Bung Karno', '', 500000.00, 0),
(7, 'Cigarettes After Sex: X\'s World Tour 2025', 'Cigarettes After Sex', '2025-08-07', 'Beach City International Stadium, Ancol, Jakarta', '', 1500000.00, 18980),
(8, 'SEVENTEEN: Right Here World Tour in Asia', 'Seventeen', '2025-07-12', 'Stadion Gelora Bung Karno', '', 850000.00, 7000),
(9, 'NCT DREAM', 'NCT DREAM', '2025-09-19', 'Jakarta International Stadium (JIS)', '', 1800000.00, 29900),
(10, 'Judika Tour Asia', 'Judika', '2025-07-31', 'Gelora Bung Karno', '', 2000000.00, 7000);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_konser` int(11) NOT NULL,
  `nama_pembeli` varchar(255) NOT NULL,
  `jumlah_tiket` int(11) NOT NULL,
  `total_harga` decimal(12,2) DEFAULT NULL,
  `tanggal_pembelian` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_konser`, `nama_pembeli`, `jumlah_tiket`, `total_harga`, `tanggal_pembelian`) VALUES
(1, 4, 'rizki', 10, 0.00, '2025-06-26 07:00:51'),
(2, 5, 'rizki', 2, 3000000.00, '2025-06-26 07:00:57'),
(3, 4, 'rizki', 49990, 0.00, '2025-06-26 07:08:00'),
(4, 7, 'rizki', 20, 30000000.00, '2025-06-26 07:08:13'),
(5, 9, 'rizki', 100, 180000000.00, '2025-06-26 07:08:22'),
(6, 8, 'rizki', 1000, 850000000.00, '2025-06-26 07:08:32'),
(7, 5, 'rizki', 14998, 9999999999.99, '2025-07-08 01:59:52'),
(8, 6, 'sarvin', 20000, 9999999999.99, '2025-07-08 02:16:22'),
(0, 7, 'david', 1000, 1500000000.00, '2025-07-09 19:09:11'),
(0, 10, 'david', 1000, 2000000000.00, '2025-07-09 19:17:36'),
(0, 10, 'david', 2000, 4000000000.00, '2025-07-09 19:19:51');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `role`, `created_at`) VALUES
(3, 'david', '$2y$10$0kwbsq3HKi401rPnkG/ViujxmbCn7QbCrJ3PZjLmxf8eQX768BPJa', 'user', '2025-06-26 06:36:55'),
(5, 'sarvin', '$2y$10$N2S/buSev1YwEjs7D4tMpulVs5IC1u7lAMjwRVS5dJdz37VPpVZlq', 'user', '2025-07-08 02:15:57'),
(6, 'admin', '$2y$10$u0OJAPNwm6Vj6/FuEwSlruQbID2ANVxElhlBW8ihzpfDiiDkDWOTW', 'admin', '2025-07-08 02:17:39');

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_laporan_penjualan`
-- (See below for the actual view)
--
CREATE TABLE `v_laporan_penjualan` (
`id_transaksi` int(11)
,`nama_konser` varchar(255)
,`artis` varchar(255)
,`nama_pembeli` varchar(255)
,`jumlah_tiket` int(11)
,`total_harga` decimal(12,2)
,`tanggal_pembelian` timestamp
);

-- --------------------------------------------------------

--
-- Structure for view `daftarkonser`
--
DROP TABLE IF EXISTS `daftarkonser`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `daftarkonser`  AS SELECT `konser`.`id_konser` AS `id_konser`, `konser`.`nama_konser` AS `nama_konser`, `konser`.`artis` AS `artis`, `konser`.`tanggal` AS `tanggal`, `konser`.`lokasi` AS `lokasi`, `konser`.`gambar_url` AS `gambar_url`, `konser`.`harga_tiket` AS `harga_tiket`, `konser`.`stok_tiket` AS `stok_tiket` FROM `konser` ;

-- --------------------------------------------------------

--
-- Structure for view `v_laporan_penjualan`
--
DROP TABLE IF EXISTS `v_laporan_penjualan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_laporan_penjualan`  AS SELECT `t`.`id_transaksi` AS `id_transaksi`, `k`.`nama_konser` AS `nama_konser`, `k`.`artis` AS `artis`, `t`.`nama_pembeli` AS `nama_pembeli`, `t`.`jumlah_tiket` AS `jumlah_tiket`, `t`.`total_harga` AS `total_harga`, `t`.`tanggal_pembelian` AS `tanggal_pembelian` FROM (`transaksi` `t` join `konser` `k` on(`t`.`id_konser` = `k`.`id_konser`)) ORDER BY `t`.`tanggal_pembelian` DESC ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `konser`
--
ALTER TABLE `konser`
  ADD KEY `idx_nama_konser` (`nama_konser`),
  ADD KEY `idx_artis` (`artis`),
  ADD KEY `idx_tanggal` (`tanggal`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD KEY `idx_nama_pembeli` (`nama_pembeli`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
