-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 16, 2022 at 06:38 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `superlaundry`
--

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `karyawan_id` char(4) NOT NULL,
  `nama_karyawan` varchar(50) NOT NULL,
  `jeniskelamin` varchar(10) NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `gaji_perbulan` int(11) NOT NULL,
  `tgl_bergabung` date NOT NULL,
  `tgl_berhenti` date NOT NULL,
  `aktif` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`karyawan_id`, `nama_karyawan`, `jeniskelamin`, `alamat`, `no_hp`, `gaji_perbulan`, `tgl_bergabung`, `tgl_berhenti`, `aktif`) VALUES
('K000', 'Bambang', 'Laki', 'sleman', '12345678900', 0, '2020-01-01', '0000-00-00', 2),
('K001', 'Budi', 'Laki', 'kaliurang', '12345678900', 100000, '2021-01-16', '0000-00-00', 1),
('K002', 'siti', 'Perempuan', 'depok', '12345678900', 150000, '2022-06-16', '0000-00-00', 1),
('K003', 'Anggi', 'Perempuan', 'Balung', '12345678900', 300000, '2022-06-16', '0000-00-00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(11) NOT NULL,
  `pelanggan_id` char(150) NOT NULL,
  `nama_pelanggan` varchar(50) NOT NULL,
  `jeniskelamin` varchar(10) NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `pelanggan_id`, `nama_pelanggan`, `jeniskelamin`, `alamat`, `no_hp`) VALUES
(11, 'P0011', 'budi', 'Laki', 'sudirman', '01213334344340'),
(12, 'P003', 'Ratna', 'Perempuan', 'kaliurang', '12345678999');

-- --------------------------------------------------------

--
-- Table structure for table `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `pengeluaran_id` varchar(14) NOT NULL,
  `total` int(11) NOT NULL,
  `detail` varchar(100) NOT NULL,
  `tgl_pengeluaran` date NOT NULL,
  `karyawan_id` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengeluaran`
--

INSERT INTO `pengeluaran` (`pengeluaran_id`, `total`, `detail`, `tgl_pengeluaran`, `karyawan_id`) VALUES
('20220616143753', 500000, 'sabun', '2022-06-16', 'K002'),
('20220616183344', 550000, 'Employee Salary Payment June 2022', '2022-06-16', 'K000');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `transaksi_id` varchar(14) NOT NULL,
  `pelanggan_id` char(7) NOT NULL,
  `karyawan_id` char(6) NOT NULL,
  `berat` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `tgl_order` date NOT NULL,
  `tgl_selesai` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`transaksi_id`, `pelanggan_id`, `karyawan_id`, `berat`, `total`, `tgl_order`, `tgl_selesai`) VALUES
('20220609102108', 'P003', 'K002', 1, 7000, '2022-01-01', '2022-01-02'),
('20220616184557', 'P0011', 'K001', 10, 70000, '2022-06-16', '2022-06-16'),
('20220616184629', 'P0011', 'K001', 100, 700000, '2022-06-16', '2022-06-16'),
('20220616185204', 'P003', 'K001', 1000, 7000000, '2022-06-16', '2022-06-16'),
('20220616193701', 'P003', 'K002', 150, 1050000, '2022-06-16', '0000-00-00'),
('20220616233114', 'P003', 'K003', 13, 91000, '2022-06-16', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` char(4) NOT NULL,
  `namauser` varchar(30) DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `level` char(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `namauser`, `username`, `password`, `level`) VALUES
('U001', 'Budi', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'superuser');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`karyawan_id`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`pelanggan_id`),
  ADD UNIQUE KEY `UNIQUE` (`id`) USING BTREE;

--
-- Indexes for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`pengeluaran_id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`transaksi_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD CONSTRAINT `pengeluaran_ibfk_1` FOREIGN KEY (`karyawan_id`) REFERENCES `karyawan` (`karyawan_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggan` (`pelanggan_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`karyawan_id`) REFERENCES `karyawan` (`karyawan_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
