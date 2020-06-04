-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 28, 2020 at 03:47 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prpn`
--

-- --------------------------------------------------------

--
-- Table structure for table `3mt`
--

CREATE TABLE `3mt` (
  `id_akun` bigint(4) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pendidikan` varchar(255) NOT NULL,
  `wa` varchar(255) NOT NULL,
  `line` varchar(255) NOT NULL,
  `asal` varchar(255) NOT NULL,
  `form_daftar` mediumblob NOT NULL,
  `karya` mediumblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `3mt`
--

INSERT INTO `3mt` (`id_akun`, `nama`, `password`, `email`, `pendidikan`, `wa`, `line`, `asal`, `form_daftar`, `karya`) VALUES
(3001, 'adam', 'adam', 'adamjunioselvaa@gmail.com', 'adam', 'adam', 'adam', 'adam', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `hstc`
--

CREATE TABLE `hstc` (
  `id_akun` bigint(4) NOT NULL,
  `nama_tim` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `ketua_tim` varchar(255) NOT NULL,
  `wa` varchar(255) NOT NULL,
  `line` varchar(255) NOT NULL,
  `pembimbing` varchar(255) NOT NULL,
  `no_pembimbing` varchar(255) NOT NULL,
  `asal_sma` varchar(255) NOT NULL,
  `asal_kota` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `bukti_form` mediumblob,
  `bukti_bayar` mediumblob,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hstc`
--

INSERT INTO `hstc` (`id_akun`, `nama_tim`, `password`, `ketua_tim`, `wa`, `line`, `pembimbing`, `no_pembimbing`, `asal_sma`, `asal_kota`, `email`, `bukti_form`, `bukti_bayar`, `status`) VALUES
(2001, 'adam', 'adam', 'adam', 'adam', 'adam', 'adam', 'adam', 'adam', 'adam', 'adamjunioselvaa@gmail.com', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kdpn`
--

CREATE TABLE `kdpn` (
  `id_akun` bigint(4) NOT NULL,
  `nama_tim` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `ketua_tim` varchar(255) NOT NULL,
  `asal_kota` varchar(255) NOT NULL,
  `asal_pt` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `wa` varchar(255) NOT NULL,
  `line` varchar(255) NOT NULL,
  `bukti_loc` mediumblob,
  `bukti_bayar` mediumblob,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kdpn`
--

INSERT INTO `kdpn` (`id_akun`, `nama_tim`, `password`, `ketua_tim`, `asal_kota`, `asal_pt`, `email`, `wa`, `line`, `bukti_loc`, `bukti_bayar`, `status`) VALUES
(1001, 'adam', 'adam', 'adam', 'adam', 'adam', 'adamjunioselvaa@gmail.com', 'adam', 'adam', '', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `suct`
--

CREATE TABLE `suct` (
  `id_akun` bigint(4) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `umur` int(2) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `profesi` varchar(255) NOT NULL,
  `asal` varchar(255) NOT NULL,
  `jk` varchar(1) NOT NULL,
  `wa` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `suct`
--

INSERT INTO `suct` (`id_akun`, `nama`, `password`, `email`, `umur`, `alamat`, `profesi`, `asal`, `jk`, `wa`, `link`) VALUES
(5001, 'adam', 'adam', 'adam', 12, 'adam', 'adam', 'adam', 'l', 'adam', 'adam');

-- --------------------------------------------------------

--
-- Table structure for table `tacap`
--

CREATE TABLE `tacap` (
  `id_akun` bigint(4) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nama_tim` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `wa` varchar(255) NOT NULL,
  `asal` varchar(255) NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `file` mediumblob,
  `link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tacap`
--

INSERT INTO `tacap` (`id_akun`, `nama`, `nama_tim`, `password`, `email`, `wa`, `asal`, `kategori`, `file`, `link`) VALUES
(4001, 'adam', 'adam', 'adam', 'adamjunioselvaa@gmail.com', 'adam', 'adam', 'adam', NULL, 'adam');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `3mt`
--
ALTER TABLE `3mt`
  ADD PRIMARY KEY (`id_akun`),
  ADD UNIQUE KEY `email_3mt` (`email`);

--
-- Indexes for table `hstc`
--
ALTER TABLE `hstc`
  ADD PRIMARY KEY (`id_akun`),
  ADD UNIQUE KEY `email_hstc` (`email`);

--
-- Indexes for table `kdpn`
--
ALTER TABLE `kdpn`
  ADD PRIMARY KEY (`id_akun`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `suct`
--
ALTER TABLE `suct`
  ADD PRIMARY KEY (`id_akun`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `tacap`
--
ALTER TABLE `tacap`
  ADD PRIMARY KEY (`id_akun`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `3mt`
--
ALTER TABLE `3mt`
  MODIFY `id_akun` bigint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3002;

--
-- AUTO_INCREMENT for table `hstc`
--
ALTER TABLE `hstc`
  MODIFY `id_akun` bigint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2002;

--
-- AUTO_INCREMENT for table `kdpn`
--
ALTER TABLE `kdpn`
  MODIFY `id_akun` bigint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1002;

--
-- AUTO_INCREMENT for table `suct`
--
ALTER TABLE `suct`
  MODIFY `id_akun` bigint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5002;

--
-- AUTO_INCREMENT for table `tacap`
--
ALTER TABLE `tacap`
  MODIFY `id_akun` bigint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4002;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
