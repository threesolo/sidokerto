-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 09, 2017 at 09:33 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `nagari`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_formulir`
--

CREATE TABLE IF NOT EXISTS `tb_formulir` (
`id_formulir` int(5) NOT NULL,
  `jenis_formulir` varchar(50) NOT NULL,
  `formulir` text NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_formulir`
--

INSERT INTO `tb_formulir` (`id_formulir`, `jenis_formulir`, `formulir`, `keterangan`) VALUES
(12, 'Surat Keterangan Kelahiran', 'Surat Keterangan Kelahiran.docx', 'Untuk mengurus surat kelahiran, silahkan download file dibawah ini dan isi dengan benar, setelah diisi silahkan upload melalui menu Pengajuan Surat');

-- --------------------------------------------------------

--
-- Table structure for table `tb_informasi`
--

CREATE TABLE IF NOT EXISTS `tb_informasi` (
`id_informasi` int(10) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `isi` text NOT NULL,
  `gambar` text NOT NULL,
  `tgl_post` datetime NOT NULL,
  `id_pengguna` int(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_informasi`
--

INSERT INTO `tb_informasi` (`id_informasi`, `judul`, `isi`, `gambar`, `tgl_post`, `id_pengguna`) VALUES
(15, 'Pembagian Sembako di Kantor Wali Nagari Padang Lua', 'Pembagian Sembako di Kantor Wali Nagari Padang Lua Pembagian Sembako di Kantor Wali Nagari Padang Lua&nbsp;Pembagian Sembako di Kantor Wali Nagari Padang Lua&nbsp;Pembagian Sembako di Kantor Wali Nagari Padang Lua&nbsp;\r\nPembagian Sembako di Kantor Wali Nagari Padang Lua Pembagian Sembako di Kantor Wali Nagari Padang Lua&nbsp;\r\nPembagian Sembako di Kantor Wali Nagari Padang Lua Pembagian Sembako di Kantor Wali Nagari Padang Lua&nbsp;Pembagian Sembako di Kantor Wali Nagari Padang Lua&nbsp;Pembagian Sembako di Kantor Wali Nagari Padang Lua&nbsp;Pembagian Sembako di Kantor Wali Nagari Padang Lua&nbsp;Pembagian Sembako di Kantor Wali Nagari Padang Lua&nbsp;\r\nPembagian Sembako di Kantor Wali Nagari Padang Lua Pembagian Sembako di Kantor Wali Nagari Padang Lua&nbsp;Pembagian Sembako di Kantor Wali Nagari Padang Lua&nbsp;\r\nPembagian Sembako di Kantor Wali Nagari Padang Lua Pembagian Sembako di Kantor Wali Nagari Padang Lua&nbsp;Pembagian Sembako di Kantor Wali Nagari Padang Lua&nbsp;Pembagian Sembako di Kantor Wali Nagari Padang Lua&nbsp;Pembagian Sembako di Kantor Wali Nagari Padang Lua&nbsp;Pembagian Sembako di Kantor Wali Nagari Padang Lua&nbsp;\r\nPembagian Sembako di Kantor Wali Nagari Padang Lua Pembagian Sembako di Kantor Wali Nagari Padang Lua&nbsp;Pembagian Sembako di Kantor Wali Nagari Padang Lua&nbsp;Pembagian Sembako di Kantor Wali Nagari Padang Lua&nbsp;', 'nasi-goreng-pattaya.jpg', '2017-09-29 00:40:43', 4);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengajuan`
--

CREATE TABLE IF NOT EXISTS `tb_pengajuan` (
`id_pengajuan` int(10) NOT NULL,
  `id_formulir` int(5) NOT NULL,
  `file_pengajuan` text NOT NULL,
  `status_pengajuan` varchar(30) NOT NULL,
  `catatan_admin` text NOT NULL,
  `tgl_pengajuan` datetime NOT NULL,
  `id_pengguna` int(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pengajuan`
--

INSERT INTO `tb_pengajuan` (`id_pengajuan`, `id_formulir`, `file_pengajuan`, `status_pengajuan`, `catatan_admin`, `tgl_pengajuan`, `id_pengguna`) VALUES
(2, 1, 'aaaaaaaaaa.xps', 'Selesai', '', '2017-09-28 16:10:39', 1),
(4, 1, 'aaa.xps', 'Selesai', 'sudah dapat dijemput', '2017-08-28 16:39:11', 1),
(5, 1, '2222.jpg', 'Selesai', 'dsf sdfsdfsd sdf', '2017-09-28 20:07:19', 1),
(6, 1, '19274983_233192843854151_4341009678153317585_n.jpg', 'Diproses', 'sdaf sdfsdf sd', '2017-09-28 20:09:16', 2),
(7, 7, 'Untitlddded.png', 'Menunggu', '', '2017-09-29 00:14:02', 3),
(8, 11, '750xauto-tips-jitu-dapat-pekerjaan-sesuai-dengan-impianmu--160119d.jpg', 'Selesai', 'sadsa dsa dsad sad sad asd as', '2017-09-29 00:15:48', 3),
(10, 12, 'Surat Keterangan Kelahiran.docx', 'Diproses', 'Sedang melakukan pengecekan pengajuan anda', '2017-09-29 01:12:18', 5);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengguna`
--

CREATE TABLE IF NOT EXISTS `tb_pengguna` (
`id_pengguna` int(10) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `telpon` varchar(20) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `level` varchar(20) NOT NULL,
  `tgl_daftar` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pengguna`
--

INSERT INTO `tb_pengguna` (`id_pengguna`, `nama_lengkap`, `alamat`, `telpon`, `username`, `password`, `level`, `tgl_daftar`) VALUES
(4, 'admin', 'Padang Lua', '085767720388', 'admin', '1', 'admin', '2017-09-29 00:38:19'),
(5, 'NR', 'Solok', '085767720388', 'nengelis', '1', 'pengguna', '2017-09-29 01:11:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_formulir`
--
ALTER TABLE `tb_formulir`
 ADD PRIMARY KEY (`id_formulir`);

--
-- Indexes for table `tb_informasi`
--
ALTER TABLE `tb_informasi`
 ADD PRIMARY KEY (`id_informasi`);

--
-- Indexes for table `tb_pengajuan`
--
ALTER TABLE `tb_pengajuan`
 ADD PRIMARY KEY (`id_pengajuan`);

--
-- Indexes for table `tb_pengguna`
--
ALTER TABLE `tb_pengguna`
 ADD PRIMARY KEY (`id_pengguna`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_formulir`
--
ALTER TABLE `tb_formulir`
MODIFY `id_formulir` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `tb_informasi`
--
ALTER TABLE `tb_informasi`
MODIFY `id_informasi` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `tb_pengajuan`
--
ALTER TABLE `tb_pengajuan`
MODIFY `id_pengajuan` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tb_pengguna`
--
ALTER TABLE `tb_pengguna`
MODIFY `id_pengguna` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
