-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 15, 2023 at 09:18 AM
-- Server version: 8.0.32-0ubuntu0.22.04.2
-- PHP Version: 8.1.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `libraryci`
--

-- --------------------------------------------------------

--
-- Table structure for table `history_lelang`
--

CREATE TABLE `history_lelang` (
  `id_history` int NOT NULL,
  `id_lelang` int NOT NULL,
  `id_user` int DEFAULT NULL,
  `penawaran_harga` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `history_lelang`
--

INSERT INTO `history_lelang` (`id_history`, `id_lelang`, `id_user`, `penawaran_harga`) VALUES
(1, 2, NULL, 2000000);

--
-- Triggers `history_lelang`
--
DELIMITER $$
CREATE TRIGGER `INSERTTTTT` AFTER INSERT ON `history_lelang` FOR EACH ROW UPDATE tb_lelang SET harga_akhir = NEW.penawaran_harga WHERE id_lelang = NEW.id_lelang AND status = 1
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `VALIDATEEE` BEFORE INSERT ON `history_lelang` FOR EACH ROW IF NEW.penawaran_harga > (SELECT harga_akhir FROM tb_lelang WHERE id_lelang = NEW.id_lelang) THEN
    UPDATE tb_lelang SET tb_lelang.harga_akhir = new.penawaran_harga WHERE tb_lelang.id_lelang = NEW.id_lelang AND STATUS=1;
    ELSE
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Price must be greater than the previous record.';
  END IF
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_barang`
--

CREATE TABLE `tb_barang` (
  `id_barang` int NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `tgl` date NOT NULL,
  `harga_awal` int NOT NULL,
  `deskripsi_barang` text NOT NULL,
  `status_barang` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_barang`
--

INSERT INTO `tb_barang` (`id_barang`, `nama_barang`, `tgl`, `harga_awal`, `deskripsi_barang`, `status_barang`) VALUES
(1, 'CANDI BOROBUDUR', '2023-02-16', 12000, 'apa weee', 1),
(2, 'CANDI KESEMEK', '2023-02-17', 1000000, 'APAAJAAA', 1),
(3, 'CANDI PRAMBANAN', '2023-02-18', 12000, 'SHFUHSU', 1);

--
-- Triggers `tb_barang`
--
DELIMITER $$
CREATE TRIGGER `INSERTTT` AFTER INSERT ON `tb_barang` FOR EACH ROW INSERT INTO tb_lelang (id_barang,tgl_lelang,harga_akhir,id_user,id_petugas,status) VALUES(NEW.id_barang,NULL,NEW.harga_awal,0,NULL,1)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update` AFTER UPDATE ON `tb_barang` FOR EACH ROW UPDATE tb_lelang
SET tb_lelang.status = NEW.status_barang
WHERE tb_lelang.id_barang = NEW.id_barang
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_lelang`
--

CREATE TABLE `tb_lelang` (
  `id_lelang` int NOT NULL,
  `id_barang` int NOT NULL,
  `tgl_lelang` date DEFAULT NULL,
  `harga_akhir` int DEFAULT NULL,
  `id_user` int DEFAULT NULL,
  `id_petugas` int DEFAULT NULL,
  `status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_lelang`
--

INSERT INTO `tb_lelang` (`id_lelang`, `id_barang`, `tgl_lelang`, `harga_akhir`, `id_user`, `id_petugas`, `status`) VALUES
(1, 1, NULL, 12000, 0, NULL, 1),
(2, 2, NULL, 2000000, 0, NULL, 1),
(3, 3, NULL, 12000, 0, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_masyarakat`
--

CREATE TABLE `tb_masyarakat` (
  `id` int NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `telp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `history_lelang`
--
ALTER TABLE `history_lelang`
  ADD PRIMARY KEY (`id_history`);

--
-- Indexes for table `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `tb_lelang`
--
ALTER TABLE `tb_lelang`
  ADD PRIMARY KEY (`id_lelang`);

--
-- Indexes for table `tb_masyarakat`
--
ALTER TABLE `tb_masyarakat`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `history_lelang`
--
ALTER TABLE `history_lelang`
  MODIFY `id_history` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_barang`
--
ALTER TABLE `tb_barang`
  MODIFY `id_barang` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_lelang`
--
ALTER TABLE `tb_lelang`
  MODIFY `id_lelang` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_masyarakat`
--
ALTER TABLE `tb_masyarakat`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
