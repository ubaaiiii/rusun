-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2020 at 10:35 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rusun`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `foto` text NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `admin` int(11) NOT NULL,
  `cookie` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `nama`, `email`, `password`, `foto`, `no_telp`, `admin`, `cookie`) VALUES
(1, 'Rusun 1', 'anugerahgustir@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'user3.png', '085325115407', 1, ''),
(2, 'Rusun 2', 'timtam.rpl@gmail.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'user2.png', '085325115407', 1, ''),
(3, 'Ubai', 'e@e.e', 'd033e22ae348aeb5660fc2140aec35850c4da997', '8f9f31a7b6c8ae1e3ec3f3cb38a0d952.jpg', '087877200523', 1, ''),
(4, 'Tonny', 'emailnya@tonny.com', '3da541559918a808c2402bba5012f6c60b27661c', 'king.png', '087825464658', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `code_booking` int(10) DEFAULT NULL,
  `user_nik` varchar(20) NOT NULL,
  `kamar_id` int(20) NOT NULL,
  `jumlah` int(2) DEFAULT NULL,
  `tanggal_booking` datetime NOT NULL,
  `tanggal_mulai` datetime DEFAULT NULL,
  `tanggal_selesai` datetime NOT NULL,
  `tanggal_lunas` datetime DEFAULT NULL,
  `upload_bukti` text NOT NULL,
  `rek_id` int(2) DEFAULT NULL,
  `status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `code_booking`, `user_nik`, `kamar_id`, `jumlah`, `tanggal_booking`, `tanggal_mulai`, `tanggal_selesai`, `tanggal_lunas`, `upload_bukti`, `rek_id`, `status`) VALUES
(2, 380770214, '327307090371003', 1, 3, '2020-02-11 00:00:00', '2020-02-12 00:00:00', '2020-03-12 00:00:00', '2020-03-17 01:12:16', 'link.jpg', 2, 3),
(3, 1072961200, '928402984092384', 2, 2, '2020-02-13 00:00:00', '2020-02-12 00:00:00', '2020-03-12 00:00:00', '2020-03-17 01:12:11', 'bca.jpg', 3, 3),
(9, 1411392328, '123123123', 10, 8, '2020-03-17 01:15:31', '2020-03-26 07:30:00', '2020-11-26 07:30:00', '2020-03-17 01:17:59', '65437c55311c3edf1c53adb181e3b7ed.jpg', 2, 2),
(10, 120935074, '54466489564', 7, 12, '2020-03-17 02:25:19', '2020-03-17 02:25:00', '2021-03-17 02:25:00', '2020-03-17 02:26:57', '4971b7dda6cda37ce1fd79bedc3a6c0a.png', 3, 2),
(13, 515398327, '1232', 3, 12, '2020-03-23 03:48:14', '2020-03-23 03:48:00', '2021-03-23 03:48:00', '2020-03-23 04:45:05', 'e1adfa3b2dc6725411f97c48f5074d6a.jpg', 2, 4),
(17, 1643772807, '1232', 11, 2, '2020-04-14 15:10:42', '2020-04-14 15:10:00', '2020-06-14 15:10:00', NULL, '', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `foto` text NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `foto`, `deskripsi`) VALUES
(8, 'IMG_20170422_1454461.jpg', 'Halaman Depan Rusun'),
(9, 'IMG_20170422_1455503.jpg', 'Toilet'),
(10, 'IMG_20170422_1458001.jpg', 'Parkiran'),
(12, 'IMG-20171104-WA00021.jpg', 'Kegiatan Senam Sehat'),
(13, 'IMG_20170422_1458321.jpg', 'Halaman Utama'),
(14, 'rusun15.jpg', 'Lingkungan Dalam'),
(19, 'ae3b6bbc752943f841c42cbc0e0024a4.jpg', 'Tangga Rusun');

-- --------------------------------------------------------

--
-- Table structure for table `kamar`
--

CREATE TABLE `kamar` (
  `id` int(11) NOT NULL,
  `code` varchar(20) NOT NULL,
  `tingkat` int(11) NOT NULL,
  `harga` varchar(30) NOT NULL,
  `gender` int(1) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kamar`
--

INSERT INTO `kamar` (`id`, `code`, `tingkat`, `harga`, `gender`, `status`) VALUES
(1, 'A1', 1, '6000000', 1, 1),
(3, 'A3', 2, '550000', 1, 1),
(5, 'A5', 3, '500000', 1, 1),
(6, 'B6', 3, '500000', 2, 1),
(7, 'A7', 4, '450000', 1, 3),
(8, 'B8', 4, '450000', 2, 1),
(10, 'A9', 4, '2000000', 1, 3),
(11, 'B9', 4, '1500000', 2, 2),
(12, 'B1', 2, '234234', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `keuangan`
--

CREATE TABLE `keuangan` (
  `id` int(11) NOT NULL,
  `tanggal_confirm` date NOT NULL,
  `uang` varchar(50) NOT NULL,
  `deskripsi` text NOT NULL,
  `code_booking` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `keuangan`
--

INSERT INTO `keuangan` (`id`, `tanggal_confirm`, `uang`, `deskripsi`, `code_booking`) VALUES
(8, '2020-03-17', '1200000', 'Konfirmasi Pembayaran Booking', 1072961200),
(9, '2020-03-17', '18000000', 'Konfirmasi Pembayaran Booking', 380770214),
(10, '2020-03-17', '16000000', 'Konfirmasi Pembayaran Booking', 1411392328),
(11, '2020-03-17', '16000000', 'Konfirmasi Pembayaran Booking', 1411392328),
(12, '2020-03-17', '5400000', 'Konfirmasi Pembayaran Booking', 120935074);

-- --------------------------------------------------------

--
-- Table structure for table `perpanjang`
--

CREATE TABLE `perpanjang` (
  `id` int(11) NOT NULL,
  `code_booking` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `biaya` varchar(90) NOT NULL,
  `bulan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `perpanjang`
--

INSERT INTO `perpanjang` (`id`, `code_booking`, `tanggal`, `biaya`, `bulan`) VALUES
(1, 1, '2019-05-20', '1000000', '2');

-- --------------------------------------------------------

--
-- Table structure for table `rekening`
--

CREATE TABLE `rekening` (
  `id` int(11) NOT NULL,
  `no_rek` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `bank` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rekening`
--

INSERT INTO `rekening` (`id`, `no_rek`, `nama`, `bank`) VALUES
(2, '0983939392829', 'Mark Zukerberg', 'BNI'),
(3, '0809093049', 'Ilaham', 'BNI');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `deskripsi` text NOT NULL,
  `logo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `nama`, `alamat`, `no_telp`, `email`, `deskripsi`, `logo`) VALUES
(1, 'Rusunawa BPJS', 'Rumah Susun Sewa BPJS Ketenagakerjaan Jalan Kedasih IV Blok P1, Mekarmukti, Cikarang Utara, Bekasi, Jawa Barat 17530', '02189834237', 'rusunawa@gmail.com', 'Rusun BPJS Ketenagakerjaan Cikarang adalah rumah susun sewa pertama di kawasan industri Jababeka, Cikarang, Bekasi, Jawa Barat. Rumah susun ini didirikan oleh PT Jaminan Sosial Tenaga Kerja (Jamsostek). menurut Direktur Utama PT Jamsostek Djunaidi, rusun memiliki 245 unit kamar berkapasitas 980 orang. Harga sewa per orang berkisar Rp 110 ribu hingga Rp 125 ribu per bulan.\r\n\r\n\r\nSatu kamar yang bisa ditempati empat orang memiliki fasilitas kamar mandi di dalam. Beberapa kamar telah ditempati sejumlah karyawan yang bekerja di sekitar lokasi rusun. Sejauh ini, PT Jamsostek telah membangun rusun di Jakarta dengan jumlah kamar mencapai 2.071 unit berkapasitas 7.516 orang. Rusun juga dibangun di kawasan Batam, Riau, dan Makassar, Sulawesi Selatan.', 'villa.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `nik` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `alamat` text NOT NULL,
  `gender` int(11) NOT NULL,
  `foto` text NOT NULL,
  `ktp` text NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`nik`, `nama`, `email`, `password`, `no_telp`, `alamat`, `gender`, `foto`, `ktp`, `status`) VALUES
('123123123', 'Ahmad karim', 'timtam.rpl@gmail.compojan@gmail.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', '085230516559', 'Jember', 1, 'male.png', 'image.png', 1),
('1232', 'Asdf', 'w@w.w', '3da541559918a808c2402bba5012f6c60b27661c', '1234', 'asdf', 2, '6a3bf15ca95d1b9225990a64b36dc0a2.png', '5615dff8179fdace0ae03ec9555bdc56.jpg', 1),
('321', 'Asdf', 'q@q.q', '3da541559918a808c2402bba5012f6c60b27661c', '432423', 'fdas', 1, '88ff68df2292e594403a2b86d03efb92.png', '7999fdff30aa960242d787bc8ab3e8ab.jpg', 1),
('327307090371003', 'Achmad Hidayat', 'timtam.rpl@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '05325115407', 'timtam.rpl@gmail.com', 1, 'male.png', 'ktp1.jpg', 1),
('54466489564', 'Syahid Muhammad Hanif', 'syahid@email.com', '3da541559918a808c2402bba5012f6c60b27661c', '0215498498', 'jalan tamiya', 1, 'male.png', 'e5511a99d9c0ff5ddedb75b7121f42c5.jpg', 1),
('567765567', 'Jim Geovdei', 'ahmad@gmail.com', '85136c79cbf9fe36bb9d05d0639c70c265c18d37', '456456', 'dfgdfg', 2, 'female.png', '', 0),
('928402984092384', 'Ahmad Karim', 'ahmad@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '0853251154077', 'Jl.Raya Keting', 1, 'male.png', '52006045_120911035644266_3695607081835253419_n.jpg', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kamar`
--
ALTER TABLE `kamar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keuangan`
--
ALTER TABLE `keuangan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `perpanjang`
--
ALTER TABLE `perpanjang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rekening`
--
ALTER TABLE `rekening`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`nik`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `kamar`
--
ALTER TABLE `kamar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `keuangan`
--
ALTER TABLE `keuangan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `perpanjang`
--
ALTER TABLE `perpanjang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rekening`
--
ALTER TABLE `rekening`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
