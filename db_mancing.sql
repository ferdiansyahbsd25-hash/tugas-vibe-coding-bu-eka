-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 19, 2026 at 01:25 PM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_mancing`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_lokasi`
--

CREATE TABLE `tb_lokasi` (
  `id_lokasi` int NOT NULL,
  `nama_pantai` varchar(100) NOT NULL,
  `karakteristik_air` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_lokasi`
--

INSERT INTO `tb_lokasi` (`id_lokasi`, `nama_pantai`, `karakteristik_air`) VALUES
(1, 'Pesisir Utara Situbondo', 'Tenang, Berbatu'),
(2, 'Dermaga Pelabuhan', 'Dalam, Berarus');

-- --------------------------------------------------------

--
-- Table structure for table `tb_tangkapan`
--

CREATE TABLE `tb_tangkapan` (
  `id_tangkapan` int NOT NULL,
  `id_lokasi` int DEFAULT NULL,
  `tanggal` date NOT NULL,
  `kondisi_cuaca` varchar(50) NOT NULL,
  `jenis_umpan` varchar(50) NOT NULL,
  `ikan_target` varchar(100) NOT NULL,
  `jumlah_ekor` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_tangkapan`
--

INSERT INTO `tb_tangkapan` (`id_tangkapan`, `id_lokasi`, `tanggal`, `kondisi_cuaca`, `jenis_umpan`, `ikan_target`, `jumlah_ekor`) VALUES
(1, 2, '2025-10-25', 'mendung', 'udang kupas', 'kerapu', 5),
(2, 1, '2026-08-06', 'hujan sedang', 'cacing laut', 'ikan selayur', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_lokasi`
--
ALTER TABLE `tb_lokasi`
  ADD PRIMARY KEY (`id_lokasi`);

--
-- Indexes for table `tb_tangkapan`
--
ALTER TABLE `tb_tangkapan`
  ADD PRIMARY KEY (`id_tangkapan`),
  ADD KEY `id_lokasi` (`id_lokasi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_lokasi`
--
ALTER TABLE `tb_lokasi`
  MODIFY `id_lokasi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_tangkapan`
--
ALTER TABLE `tb_tangkapan`
  MODIFY `id_tangkapan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_tangkapan`
--
ALTER TABLE `tb_tangkapan`
  ADD CONSTRAINT `tb_tangkapan_ibfk_1` FOREIGN KEY (`id_lokasi`) REFERENCES `tb_lokasi` (`id_lokasi`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
