-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2025 at 09:52 AM
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
-- Table structure for table `audit_log`
--

CREATE TABLE `audit_log` (
  `id_log` int(11) NOT NULL,
  `tabel_terdampak` varchar(100) NOT NULL,
  `id_record_terdampak` int(11) NOT NULL,
  `aksi` varchar(50) NOT NULL,
  `deskripsi_perubahan` text DEFAULT NULL,
  `waktu_perubahan` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `audit_log`
--

INSERT INTO `audit_log` (`id_log`, `tabel_terdampak`, `id_record_terdampak`, `aksi`, `deskripsi_perubahan`, `waktu_perubahan`) VALUES
(1, 'konser', 4, 'UPDATE', 'Stok tiket diubah dari 50000 menjadi 49990.', '2025-06-26 07:00:51'),
(2, 'konser', 5, 'UPDATE', 'Stok tiket diubah dari 15000 menjadi 14998.', '2025-06-26 07:00:57'),
(3, 'konser', 4, 'UPDATE', 'Stok tiket diubah dari 49990 menjadi 0.', '2025-06-26 07:08:00'),
(4, 'konser', 7, 'UPDATE', 'Stok tiket diubah dari 20000 menjadi 19980.', '2025-06-26 07:08:13'),
(5, 'konser', 9, 'UPDATE', 'Stok tiket diubah dari 30000 menjadi 29900.', '2025-06-26 07:08:22'),
(6, 'konser', 8, 'UPDATE', 'Stok tiket diubah dari 8000 menjadi 7000.', '2025-06-26 07:08:32');

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
(4, 'Night Christmast Special', 'Judika, Agnez Monica, Lyodra, Ari Lasso', '2025-12-25', 'Stadion Gelora Bung Karno', 'https://cdn.pixabay.com/photo/2021/12/17/13/29/concert-6876577_1280.jpg', 0.00, 0),
(5, 'Alan Walker to Indonesia', 'Alan Walker', '2025-06-26', 'Stadion Keramat Jati', 'https://blue.kumparan.com/image/upload/fl_progressive,fl_lossy,c_fill,f_auto,q_auto:best,w_640/v1634025439/01hg9wpqerf01y2rj0002758ax.jpg', 1500000.00, 14998),
(6, 'Dewa 19: featuring All Stars 2.0', 'Dewa 19', '2025-06-30', 'Stadion Gelora Bung Karno', '', 500000.00, 20000),
(7, 'Cigarettes After Sex: X\'s World Tour 2025', 'Cigarettes After Sex', '2025-08-07', 'Beach City International Stadium, Ancol, Jakarta', '', 1500000.00, 19980),
(8, 'SEVENTEEN: Right Here World Tour in Asia', 'Seventeen', '2025-07-12', 'Stadion Gelora Bung Karno', '', 850000.00, 7000),
(9, 'NCT DREAM', 'NCT DREAM', '2025-09-19', 'Jakarta International Stadium (JIS)', '', 1800000.00, 29900);

--
-- Triggers `konser`
--
DELIMITER $$
CREATE TRIGGER `trg_log_perubahan_konser` AFTER UPDATE ON `konser` FOR EACH ROW BEGIN
    DECLARE deskripsi TEXT DEFAULT '';
    IF OLD.harga_tiket <> NEW.harga_tiket THEN
        SET deskripsi = CONCAT('Harga tiket diubah dari Rp ', FORMAT(OLD.harga_tiket, 0), ' menjadi Rp ', FORMAT(NEW.harga_tiket, 0), '. ');
    END IF;
    IF OLD.stok_tiket <> NEW.stok_tiket THEN
        SET deskripsi = CONCAT(deskripsi, 'Stok tiket diubah dari ', OLD.stok_tiket, ' menjadi ', NEW.stok_tiket, '.');
    END IF;
    IF deskripsi <> '' THEN
        INSERT INTO audit_log (tabel_terdampak, id_record_terdampak, aksi, deskripsi_perubahan)
        VALUES ('konser', NEW.id_konser, 'UPDATE', deskripsi);
    END IF;
END
$$
DELIMITER ;

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
(6, 8, 'rizki', 1000, 850000000.00, '2025-06-26 07:08:32');

--
-- Triggers `transaksi`
--
DELIMITER $$
CREATE TRIGGER `trg_update_stok_tiket` BEFORE INSERT ON `transaksi` FOR EACH ROW BEGIN
    DECLARE harga_per_tiket DECIMAL(10,2);
    DECLARE stok_saat_ini INT;
    SELECT harga_tiket, stok_tiket INTO harga_per_tiket, stok_saat_ini FROM konser WHERE id_konser = NEW.id_konser;
    IF stok_saat_ini < NEW.jumlah_tiket THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Stok tiket tidak mencukupi.';
    END IF;
    SET NEW.total_harga = harga_per_tiket * NEW.jumlah_tiket;
    UPDATE konser SET stok_tiket = stok_tiket - NEW.jumlah_tiket WHERE id_konser = NEW.id_konser;
END
$$
DELIMITER ;

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
(3, 'david', '$2y$10$0kwbsq3HKi401rPnkG/ViujxmbCn7QbCrJ3PZjLmxf8eQX768BPJa', 'admin', '2025-06-26 06:36:55'),
(4, 'rizki', '$2y$10$HytLToOgbwiQIC0Yksl3.e3D4rtRJ/HQAeAxAZuBFVxnFtxB4kZsa', 'user', '2025-06-26 06:38:23');

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
-- Structure for view `v_laporan_penjualan`
--
DROP TABLE IF EXISTS `v_laporan_penjualan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_laporan_penjualan`  AS SELECT `t`.`id_transaksi` AS `id_transaksi`, `k`.`nama_konser` AS `nama_konser`, `k`.`artis` AS `artis`, `t`.`nama_pembeli` AS `nama_pembeli`, `t`.`jumlah_tiket` AS `jumlah_tiket`, `t`.`total_harga` AS `total_harga`, `t`.`tanggal_pembelian` AS `tanggal_pembelian` FROM (`transaksi` `t` join `konser` `k` on(`t`.`id_konser` = `k`.`id_konser`)) ORDER BY `t`.`tanggal_pembelian` DESC ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audit_log`
--
ALTER TABLE `audit_log`
  ADD PRIMARY KEY (`id_log`);

--
-- Indexes for table `konser`
--
ALTER TABLE `konser`
  ADD PRIMARY KEY (`id_konser`),
  ADD KEY `idx_nama_konser` (`nama_konser`),
  ADD KEY `idx_artis` (`artis`),
  ADD KEY `idx_tanggal` (`tanggal`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_konser` (`id_konser`),
  ADD KEY `idx_nama_pembeli` (`nama_pembeli`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `audit_log`
--
ALTER TABLE `audit_log`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `konser`
--
ALTER TABLE `konser`
  MODIFY `id_konser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_konser`) REFERENCES `konser` (`id_konser`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
