-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 05, 2026 at 03:10 AM
-- Server version: 8.0.30
-- PHP Version: 8.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `koperasiahmadi`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `idbarang` int NOT NULL,
  `idsuplier` int NOT NULL,
  `idmerk` int NOT NULL,
  `idkategori` int NOT NULL,
  `namabarang` varchar(50) NOT NULL,
  `harga` decimal(15,2) NOT NULL,
  `tanggalstok` date NOT NULL,
  `stok` int NOT NULL,
  `foto` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`idbarang`, `idsuplier`, `idmerk`, `idkategori`, `namabarang`, `harga`, `tanggalstok`, `stok`, `foto`) VALUES
(1, 1, 2, 3, 'nasi goreng mbok yem', '15000.00', '2026-09-21', 100, 'aisdhfhhaisdhfhaisduhf918287312hgghasidf'),
(2, 1, 2, 3, 'ayam bakar', '15000.00', '2026-09-21', 100, 'aisdhfhhaisdhfhaisduhf918287312hgghasidf'),
(3, 1, 2, 2, 'es teh dingin', '5000.00', '2026-09-21', 100, 'aisdhfhhaisdhfhaisduhf918287312hgghasidf'),
(4, 1, 1, 2, 'cimory', '9000.00', '2026-09-14', 100, 'kajshjhdfkasjdkfas');

-- --------------------------------------------------------

--
-- Table structure for table `detilpenjualan`
--

CREATE TABLE `detilpenjualan` (
  `iddetilpenjualan` int NOT NULL,
  `idpenjualan` int NOT NULL,
  `idbarang` int NOT NULL,
  `subtotal` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `idkategori` int NOT NULL,
  `namakategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`idkategori`, `namakategori`) VALUES
(1, 'makanan'),
(2, 'minuman'),
(3, 'atk');

-- --------------------------------------------------------

--
-- Table structure for table `merk`
--

CREATE TABLE `merk` (
  `idmerk` int NOT NULL,
  `namamerk` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `merk`
--

INSERT INTO `merk` (`idmerk`, `namamerk`) VALUES
(1, 'Lonovo'),
(2, 'Acer'),
(3, 'HP');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `idpelanggan` int NOT NULL,
  `namapelanggan` varchar(50) NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `nohp` char(14) DEFAULT NULL,
  `alamat` varchar(50) DEFAULT NULL,
  `foto` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`idpelanggan`, `namapelanggan`, `username`, `password`, `nohp`, `alamat`, `foto`) VALUES
(1, 'ahmadipelanggan1', 'ahmadi', 'ahmadi', '082398182739', 'paya raja', 'aisdhfhhaisdhfhaisduhf918287312hgghasidf'),
(2, 'ahmadipelanggan2', 'ahmadi', 'ahmadi', '082398182739', 'paya raja', 'aisdhfhhaisdhfhaisduhf918287312hgghasidf'),
(3, 'ahmadipelanggan3', 'ahmadi', 'ahmadi', '082398182739', 'paya raja', 'aisdhfhhaisdhfhaisduhf918287312hgghasidf');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `idpenjualan` int NOT NULL,
  `idpelanggan` int NOT NULL,
  `iduser` int NOT NULL,
  `tanggalpenjualan` date NOT NULL,
  `totalpenjualan` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `suplier`
--

CREATE TABLE `suplier` (
  `idsuplier` int NOT NULL,
  `namasuplier` varchar(50) NOT NULL,
  `nohp` char(14) NOT NULL,
  `alamat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `suplier`
--

INSERT INTO `suplier` (`idsuplier`, `namasuplier`, `nohp`, `alamat`) VALUES
(1, 'ahmadisuplier1', '08123123123', 'paya raja'),
(2, 'ahmadisuplier1', '08123123123', 'paya raja'),
(3, 'ahmadisuplier1', '08123123123', 'paya raja');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `iduser` int NOT NULL,
  `namauser` varchar(50) NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `nohp` char(14) DEFAULT NULL,
  `alamat` varchar(50) DEFAULT NULL,
  `foto` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`iduser`, `namauser`, `username`, `password`, `nohp`, `alamat`, `foto`) VALUES
(1, 'ahmadiuser1', 'ahmadi', 'ahmadi', '082398182739', 'paya raja', 'aisdhfhhaisdhfhaisduhf918287312hgghasidf'),
(2, 'ahmadiuser2', 'ahmadi', 'ahmadi', '082398182739', 'paya raja', 'aisdhfhhaisdhfhaisduhf918287312hgghasidf'),
(3, 'ahmadiuser3', 'ahmadi', 'ahmadi', '082398182739', 'paya raja', 'aisdhfhhaisdhfhaisduhf918287312hgghasidf');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`idbarang`),
  ADD KEY `idmerk` (`idmerk`),
  ADD KEY `idkategori` (`idkategori`),
  ADD KEY `idsuplier` (`idsuplier`);

--
-- Indexes for table `detilpenjualan`
--
ALTER TABLE `detilpenjualan`
  ADD KEY `idpenjualan` (`idpenjualan`),
  ADD KEY `idbarang` (`idbarang`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`idkategori`);

--
-- Indexes for table `merk`
--
ALTER TABLE `merk`
  ADD PRIMARY KEY (`idmerk`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`idpelanggan`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`idpenjualan`),
  ADD KEY `iduser` (`iduser`),
  ADD KEY `idpelanggan` (`idpelanggan`);

--
-- Indexes for table `suplier`
--
ALTER TABLE `suplier`
  ADD PRIMARY KEY (`idsuplier`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`iduser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `idbarang` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `idkategori` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `merk`
--
ALTER TABLE `merk`
  MODIFY `idmerk` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `idpelanggan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `idpenjualan` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `suplier`
--
ALTER TABLE `suplier`
  MODIFY `idsuplier` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `iduser` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `idkategori` FOREIGN KEY (`idkategori`) REFERENCES `kategori` (`idkategori`),
  ADD CONSTRAINT `idmerk` FOREIGN KEY (`idmerk`) REFERENCES `merk` (`idmerk`),
  ADD CONSTRAINT `idsuplier` FOREIGN KEY (`idsuplier`) REFERENCES `suplier` (`idsuplier`);

--
-- Constraints for table `detilpenjualan`
--
ALTER TABLE `detilpenjualan`
  ADD CONSTRAINT `idbarang` FOREIGN KEY (`idbarang`) REFERENCES `barang` (`idbarang`),
  ADD CONSTRAINT `idpenjualan` FOREIGN KEY (`idpenjualan`) REFERENCES `penjualan` (`idpenjualan`);

--
-- Constraints for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD CONSTRAINT `idpelanggan` FOREIGN KEY (`idpelanggan`) REFERENCES `pelanggan` (`idpelanggan`),
  ADD CONSTRAINT `iduser` FOREIGN KEY (`iduser`) REFERENCES `user` (`iduser`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
