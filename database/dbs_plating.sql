-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 18, 2014 at 10:48 AM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dbs_plating`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE IF NOT EXISTS `barang` (
  `no_part` varchar(15) NOT NULL,
  `nm_part` varchar(30) NOT NULL,
  `id_cust` varchar(5) NOT NULL,
  `spesifikasi` varchar(30) NOT NULL,
  `satuan` varchar(15) NOT NULL,
  `luas` decimal(5,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`no_part`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`no_part`, `nm_part`, `id_cust`, `spesifikasi`, `satuan`, `luas`) VALUES
('543715471SH31', 'LY/PW 71', 'AIS', 'NiCr', 'pcs/kg', '0.75');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `id_cust` varchar(5) NOT NULL,
  `nm_cust` varchar(30) NOT NULL,
  `alamat_cust` text NOT NULL,
  `tlp_cust` varchar(15) NOT NULL,
  PRIMARY KEY (`id_cust`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id_cust`, `nm_cust`, `alamat_cust`, `tlp_cust`) VALUES
('AIS', 'PT. Aisin Indonesia', 'Jl. Delta silicon 3 kawasan industri lippo cikarang', '021345678');

-- --------------------------------------------------------

--
-- Table structure for table `defect`
--

CREATE TABLE IF NOT EXISTS `defect` (
  `id_defect` int(5) NOT NULL AUTO_INCREMENT,
  `nm_defect` varchar(30) NOT NULL,
  `id_line` int(5) NOT NULL,
  PRIMARY KEY (`id_defect`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `defect`
--

INSERT INTO `defect` (`id_defect`, `nm_defect`, `id_line`) VALUES
(1, 'Kasar', 1);

-- --------------------------------------------------------

--
-- Table structure for table `detail_trans`
--

CREATE TABLE IF NOT EXISTS `detail_trans` (
  `no_trans` char(10) NOT NULL,
  `no_part` varchar(15) NOT NULL,
  `jml_target` int(5) NOT NULL,
  `OK` decimal(5,2) NOT NULL DEFAULT '0.00',
  `NG` decimal(5,2) NOT NULL DEFAULT '0.00',
  `id_defect` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_trans`
--

INSERT INTO `detail_trans` (`no_trans`, `no_part`, `jml_target`, `OK`, `NG`, `id_defect`) VALUES
('F071700001', '543715471SH31', 100, '100.00', '0.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `lead_produksi`
--

CREATE TABLE IF NOT EXISTS `lead_produksi` (
  `id_lead` int(5) NOT NULL AUTO_INCREMENT,
  `nm_lead` varchar(30) NOT NULL,
  `shift` int(5) NOT NULL,
  `jam_kerja` varchar(15) NOT NULL,
  `id_line` int(5) NOT NULL,
  `grup_shift` varchar(20) NOT NULL,
  PRIMARY KEY (`id_lead`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `lead_produksi`
--

INSERT INTO `lead_produksi` (`id_lead`, `nm_lead`, `shift`, `jam_kerja`, `id_line`, `grup_shift`) VALUES
(1, 'Randy', 1, '07.00-16.00', 1, '1/Randy/N1');

-- --------------------------------------------------------

--
-- Table structure for table `line`
--

CREATE TABLE IF NOT EXISTS `line` (
  `id_line` int(5) NOT NULL AUTO_INCREMENT,
  `nm_line` varchar(20) NOT NULL,
  `spesifikasi` varchar(32) NOT NULL,
  `satuan` varchar(10) NOT NULL,
  PRIMARY KEY (`id_line`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `line`
--

INSERT INTO `line` (`id_line`, `nm_line`, `spesifikasi`, `satuan`) VALUES
(1, 'N1', 'Nickel', 'Hanger');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE IF NOT EXISTS `transaksi` (
  `no_trans` char(10) NOT NULL,
  `tgl_trans` date NOT NULL,
  `id_lead` int(5) NOT NULL,
  `target_kerja` int(5) NOT NULL,
  `actual_kerja` int(5) NOT NULL,
  `efisiensi` decimal(5,2) NOT NULL COMMENT '(Aktual Kerja/Target Kerja) *100%',
  `jml_org` int(5) NOT NULL,
  `actual_jam` int(5) NOT NULL,
  `man_hour` int(5) NOT NULL,
  `stop_line` int(5) NOT NULL,
  PRIMARY KEY (`no_trans`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`no_trans`, `tgl_trans`, `id_lead`, `target_kerja`, `actual_kerja`, `efisiensi`, `jml_org`, `actual_jam`, `man_hour`, `stop_line`) VALUES
('F071700001', '2014-07-17', 1, 8, 8, '100.00', 20, 8, 160, 8);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `nama_lengkap` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `no_telp` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `level` varchar(20) COLLATE latin1_general_ci NOT NULL DEFAULT 'user',
  `blokir` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  `id_session` varchar(100) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `nama_lengkap`, `email`, `no_telp`, `level`, `blokir`, `id_session`) VALUES
('ADM01', '21232f297a57a5a743894a0e4a801fc3', 'Administrator', 'admin@gmail.com', '021654040252', 'admin', 'N', 'i5i1ff0l37jacgofoouhslkpa1'),
('USR01', '000d358bf3c68422b703977c80e632e6', 'Sholuha', 'sholu@gmail.com', '021721535851', 'user', 'N', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
