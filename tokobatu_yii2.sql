-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2023 at 08:09 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tokobatu_yii2`
--

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE `banner` (
  `id` int(11) NOT NULL,
  `image` varchar(50) NOT NULL,
  `date_start` datetime NOT NULL,
  `date_end` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`id`, `image`, `date_start`, `date_end`, `created_at`) VALUES
(6, 'Y2FjnxqHF1Upyxbg4mFEpZ4dnf8ykCZw.jpg', '2023-05-26 00:00:00', '2023-05-25 00:00:00', '2023-05-26 08:35:57'),
(8, 'Yx3rSuZRRyAOyXXdZC1bNfx7PUgds-by.jpg', '2023-05-26 00:00:00', '2023-05-25 00:00:00', '2023-05-26 09:01:22');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `img`, `created_at`, `updated_at`) VALUES
(2, 'Elektronik', '_CwzLnBk173bwb2Otfs7IsXWW320Z5B0.png', '2023-05-13 16:30:53', '2023-05-17 10:51:23'),
(4, 'Fashion Anak & Bayi', 'LU79B4GDTDzzHN4vA-ygkdQ8G9PkApDJ.png', '2023-05-13 16:30:59', '2023-05-24 08:53:31'),
(14, 'Handphone & Tablet', '2Rpdf5Tf5I4BSJr7Nr-hoXIxmh0MWYdE.png', '2023-05-18 10:02:53', '2023-05-24 08:55:08'),
(15, 'Gaming', NULL, '2023-05-18 10:04:09', '2023-05-24 08:54:37'),
(16, 'Film & Musik', NULL, '2023-05-18 10:04:15', '2023-05-24 08:54:22'),
(17, 'Fashion Pria', NULL, '2023-05-18 10:04:23', '2023-05-24 08:54:03'),
(18, 'Fashion Muslim', NULL, '2023-05-18 10:04:33', '2023-05-24 08:53:50'),
(19, 'Dapur', NULL, '2023-05-18 10:04:46', '2023-05-24 08:53:08'),
(20, 'Buku', NULL, '2023-05-18 10:05:29', '2023-05-24 08:52:59'),
(21, 'Ibu & Bayi', NULL, '2023-05-24 08:59:44', NULL),
(22, 'Kamera', NULL, '2023-05-24 08:59:53', NULL),
(23, 'Kecantikan', NULL, '2023-05-24 09:00:00', NULL),
(24, 'Kesehatan', NULL, '2023-05-24 09:00:09', NULL),
(25, 'Komputer & Laptop', NULL, '2023-05-24 09:00:21', NULL),
(26, 'Logam Mulia', NULL, '2023-05-24 09:00:33', NULL),
(27, 'Mainan & Hobi', NULL, '2023-05-24 09:00:42', NULL),
(28, 'Makanan & Minuman', NULL, '2023-05-24 09:00:58', NULL),
(29, 'Office & Stationary', NULL, '2023-05-24 09:01:18', NULL),
(30, 'Olahraga', NULL, '2023-05-24 09:01:28', NULL),
(31, 'Otomotif', NULL, '2023-05-24 09:01:35', NULL),
(32, 'Perawatan Hewan', NULL, '2023-05-24 09:01:43', NULL),
(33, 'Perawatan Tumbuhan', NULL, '2023-05-24 09:01:53', NULL),
(34, 'Perlengkapan Pesta & Craft', NULL, '2023-05-24 09:02:09', NULL),
(35, 'Pertukangan', NULL, '2023-05-24 09:02:40', NULL),
(36, 'Produk Lainnya', NULL, '2023-05-24 09:02:58', NULL),
(37, 'Property', NULL, '2023-05-24 09:03:21', NULL),
(38, 'Rumah Tangga', NULL, '2023-05-24 09:03:28', NULL),
(39, 'Tour & Travel', NULL, '2023-05-24 09:03:38', NULL),
(40, 'Wedding', NULL, '2023-05-24 09:03:47', NULL),
(41, 'Kesenian', NULL, '2023-05-24 09:03:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `favorit`
--

CREATE TABLE `favorit` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `products_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `favorit`
--

INSERT INTO `favorit` (`id`, `user_id`, `products_id`, `created_at`) VALUES
(14, 23, 68, '2023-05-25 08:13:40'),
(15, 23, 69, '2023-05-25 13:30:18');

-- --------------------------------------------------------

--
-- Table structure for table `jasa_kirim`
--

CREATE TABLE `jasa_kirim` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `jasa_kirim`
--

INSERT INTO `jasa_kirim` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'JNE', 'jne', '2023-05-13 16:33:11', '2023-05-13 16:33:11'),
(10, 'POS Indonesia', 'pos', '2023-05-13 16:33:15', '2023-05-13 16:33:15'),
(14, 'TIKI', 'tiki', '2023-05-13 16:33:19', '2023-05-14 15:45:29');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `jasa_id` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `kode_unik` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `paket` varchar(100) DEFAULT NULL,
  `ongkir` int(11) DEFAULT NULL,
  `estimasi` varchar(100) DEFAULT NULL,
  `status_pemesanan` enum('pending','dikonfirmasi','dalam perjalanan','sukses','gagal') NOT NULL DEFAULT 'pending',
  `code_transaksi_midtrans` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id`, `user_id`, `jasa_id`, `status`, `kode_unik`, `total_harga`, `paket`, `ongkir`, `estimasi`, `status_pemesanan`, `code_transaksi_midtrans`, `created_at`, `updated_at`) VALUES
(47, 23, 14, 1, 11829, 15000, 'ECO', 20000, '4', 'dikonfirmasi', '8f00e202-a52f-4db7-8868-c5e1ce72979b', '2023-05-25 13:11:06', '2023-05-25 13:11:06'),
(48, 23, NULL, 0, 73752, 7000, NULL, NULL, NULL, 'pending', NULL, '2023-05-25 14:59:36', '2023-05-25 14:59:36'),
(49, 26, 1, 1, 30034, 111000, 'OKE Rp. 29000', 29000, '7-8', 'dikonfirmasi', '6d45ff01-3bc8-4160-a1fb-d10d7453cc27', '2023-05-25 21:57:41', '2023-05-25 21:57:41');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan_detail`
--

CREATE TABLE `pesanan_detail` (
  `id` int(11) NOT NULL,
  `products_id` int(11) NOT NULL,
  `pesanan_id` int(11) NOT NULL,
  `jml` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `pesanan_detail`
--

INSERT INTO `pesanan_detail` (`id`, `products_id`, `pesanan_id`, `jml`, `total`, `created_at`) VALUES
(119, 52, 47, 1, 10000, '2023-05-25 13:11:06'),
(120, 68, 47, 1, 5000, '2023-05-25 13:11:06'),
(121, 68, 48, 1, 7000, NULL),
(122, 69, 49, 18, 90000, NULL),
(123, 68, 49, 3, 21000, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `toko_id` int(11) DEFAULT NULL,
  `img` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `deskripsi_produk` text NOT NULL,
  `berat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `user_id`, `category_id`, `toko_id`, `img`, `harga`, `stok`, `deskripsi_produk`, `berat`) VALUES
(52, 'Mie Surga', 23, 28, 61, 'htp4SgFMQOPSAPUNTuWzTMT2s5P4JLRL.jpg', 10000, 999, 'Mie dengan kualitas terbaik dari mie pedas Orins tanpa Lombok. Lengkap dengan toping ayam, sayur, Daging dan Krupuk. Bagi yg suka Kecap bisa ditambah.', '400'),
(54, 'Mie Neraka', 23, 28, 61, 'dYNpHNCz1pPl6Zva3-9N8J1KV9ppuzpi.jpg', 10000, 1000, 'Mie Neraka. Mie dengan level dan tambahan kecap lengkap dengan Toping ayam, daging, sayur, krupuk. Level S = 12. Level M =24. Level L = 48. Bisa request lombok 1 - 10', '400'),
(55, 'Ice blended coklat', 23, 28, 61, 'sLcJKZ_b0qBl16PH1EYyVvHDAlprDEEW.jpg', 6000, 1000, 'ice blend coklat yg lezat', '250'),
(57, 'Ice blended Taro', 23, 28, 61, '9YEJe9qVnX_HfSHar5kQN-CxrOPumon7.jpg', 6000, 1000, 'lorem ipsum\r\n', '250'),
(59, 'Renginang Cumi Pedas', 23, 28, 61, 'o6obxrQ6Gc-CiOcbjAOR-xMKV3-FKDYX.jfif', 25000, 1000, 'Rengginang asli dari tinta cumi bukan pewarna makanan. Tanpa jemur', '500'),
(60, 'Renginang Cumi Ori', 23, 28, 61, 'qba34Jgfq_rk34lsjGOvdnpJRsmELIwQ.jpg', 23000, 1000, 'lorem ipsum', '450'),
(66, 'Buku Mainan', 23, 20, 61, '57x5mZvnWsyKBsRXnvB6NWE9rbWqp2Dh.jpg', 18000, 1000, 'lorem ipsum\r\n', '400'),
(67, 'Sempol KWB', 23, 28, 61, 'XeaFdeASxXNLfDqd0wePRa7M1UJ8s7Jb.jpg', 20000, 1000, 'lorem ipsum', '300'),
(68, 'Keripik Kentang', 23, 28, 61, 'E3vb9tdISzjtj60YH11tvErS7ohp8VT8.jpg', 7000, 996, 'lorem ipsum', '200'),
(69, 'Buku Tulis', 23, 20, 61, '4v5okGL06CfkyLCG-mWYz-TFjBkLmdy8.jpg', 5000, 1000, 'lorem ipsum', '230');

-- --------------------------------------------------------

--
-- Table structure for table `promo`
--

CREATE TABLE `promo` (
  `id` int(11) NOT NULL,
  `products_id` int(11) NOT NULL,
  `toko_id` int(11) NOT NULL,
  `nilai` int(11) DEFAULT NULL,
  `date_start` datetime NOT NULL,
  `date_end` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `promo`
--

INSERT INTO `promo` (`id`, `products_id`, `toko_id`, `nilai`, `date_start`, `date_end`, `created_at`, `updated_at`) VALUES
(12, 68, 61, 2000, '2023-05-25 00:00:00', '2023-08-01 00:00:00', '2023-05-25 08:07:52', '2023-05-25 08:07:52'),
(13, 67, 61, 3000, '2023-05-25 00:00:00', '2023-08-01 00:00:00', '2023-05-25 08:08:18', '2023-05-25 08:08:18'),
(14, 69, 61, 1000, '2023-05-25 00:00:00', '2023-05-31 00:00:00', '2023-05-25 08:09:23', '2023-05-25 08:09:23');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'user'),
(2, 'admin'),
(3, 'penjual');

-- --------------------------------------------------------

--
-- Table structure for table `toko`
--

CREATE TABLE `toko` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `alamat` text NOT NULL,
  `no_whatsapp` varchar(13) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `flag` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `toko`
--

INSERT INTO `toko` (`id`, `id_user`, `name`, `deskripsi`, `alamat`, `no_whatsapp`, `created_at`, `updated_at`, `flag`) VALUES
(61, 23, 'Toko', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type', 'jl.Mawar,No.1,Kec.Jambon,Kab.Ponorogo', '081253223893', '2023-05-18 11:16:31', '2023-05-18 14:43:50', NULL),
(62, 38, 'TokoCustomer', 'lorem ipsum dolor', 'jl.jalan matahari', '083222333444', '2023-05-19 10:10:39', '2023-05-19 14:28:44', 'user/4d1f776f53a2ad8073ec850cc8f10f5891f35258.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `kota` varchar(255) DEFAULT NULL,
  `provinsi` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `codepos` int(11) DEFAULT NULL,
  `status` smallint(6) NOT NULL,
  `role_id` int(11) NOT NULL,
  `img` varchar(50) DEFAULT NULL,
  `secret_token` varchar(255) DEFAULT NULL,
  `refresh_token` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `alamat`, `kota`, `provinsi`, `type`, `no_hp`, `codepos`, `status`, `role_id`, `img`, `secret_token`, `refresh_token`, `created_at`, `updated_at`) VALUES
(19, 'admin', 'admin@gmail.com', '$2y$13$8Gubjltl.f4T4LtXVwcGDONP3qNjYQsognz.RSZOa69GFhAticLmS', NULL, NULL, NULL, NULL, NULL, NULL, 10, 2, NULL, NULL, NULL, NULL, NULL),
(23, 'Kelvin Rohmat Setiaji', 'kv@gmail.com', '$2y$13$LkPSvHrU1NRoVLvs1Vs2/.lFvcS03IoyNJrtB/jSvkqbe1tzKmm4a', 'Jl. Mawar Putih,No.51', 'Kabupaten Ponorogo', 'Jawa Timur', 'Kabupaten', '085708217852', 63411, 10, 3, 'wKtC1QIjCVFmRQGk_tpMIf74tvnLIlXJ.jpg', 'TOKOBATUMTY4NTArRzFIbEVaRDZKeFpxSm52S3ZqMHhBYW_Wp9yU_pqZFZBQTlxSXoyZTZ0eTdLb1ZMLVIrOTExNTQ=S3CRETKEY', 'PPa2NWEDNMus7XRs-6Ar1LiHoLe0mFSI', '2023-01-21 16:36:38', '2023-05-26 10:52:33'),
(26, 'Customer', 'customer@gmail.com', '$2y$13$uzC.AqtN04sFYcPsbPe6hOT6d4pqW5sO7IEhjwyi/gEpuwU7lGRbi', 'Jl. Mawar Putih,No.55', 'Bangli', 'Bali', 'Kabupaten', '082333444554', 80619, 10, 1, 'X0DbpVnSOjFJhxwfSU91Yszlo88qH81c.jpg', 'TOKOBATUMTY4NTArMDR0Q1dGdERZY0RFR2R1QXZRdllua1dOVE_W2SsM_MyczdqNG50ZkVsVXUxZU5LU2grMzRxZGcrNDUyNTA=S3CRETKEY', 'h6oZ3cTdg2yeFsFLrZClEpegtaQOuHBA', '2023-01-23 15:27:34', '2023-05-25 22:08:30'),
(38, 'Customer1', 'customer1@gmail.com', '$2y$13$Km6BvU4qJZBXks/9uw2kCeSxT/bRtAb/aSoSGy66pv192Q.POkmHa', 'Jl. MawarPutih Semarang No.55', 'Kota Bogor', 'Jawa Barat', 'Kota', '089988999897', 16119, 10, 3, NULL, 'TOKOBATUMTY4NDQrNk1wQktvbmpHQmt6aDJYQVVoTjhzZ3_QzeJD_BGUENBMG5jNHFBYTdvaXNoZGxrMCs5NDA2Mw==S3CRETKEY', 'lf3TCQDt96pcRaEPopOwxoG2YuZseHUp', '2023-05-19 09:48:00', '2023-05-19 14:26:58'),
(40, 'Customer2', 'customer2@gmail.com', '$2y$13$jmh5TWW9908hr7dBJzwqquMqL5LusSuf9mKLbiM.ttCZ6gHC.KU7K', NULL, NULL, NULL, NULL, NULL, NULL, 10, 1, NULL, 'TOKOBATUMTY4NDQrUVU2a0dIb3JubmF0VjhkOGxj_r-B7B_M3JLcTN3cTFxWnJ3Tll4Uk8rOTU5OTI=S3CRETKEY', 'BGA8CqstF9HJ05dkJFKA_VZriXxXi5Pe', '2023-05-19 10:43:53', '2023-05-19 13:33:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favorit`
--
ALTER TABLE `favorit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `products_id` (`products_id`);

--
-- Indexes for table `jasa_kirim`
--
ALTER TABLE `jasa_kirim`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `jasa_id` (`jasa_id`);

--
-- Indexes for table `pesanan_detail`
--
ALTER TABLE `pesanan_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_id` (`products_id`),
  ADD KEY `pesanan_id` (`pesanan_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `toko_id` (`toko_id`);

--
-- Indexes for table `promo`
--
ALTER TABLE `promo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_id` (`products_id`),
  ADD KEY `toko_id` (`toko_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `toko`
--
ALTER TABLE `toko`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `favorit`
--
ALTER TABLE `favorit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `jasa_kirim`
--
ALTER TABLE `jasa_kirim`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `pesanan_detail`
--
ALTER TABLE `pesanan_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `promo`
--
ALTER TABLE `promo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `toko`
--
ALTER TABLE `toko`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `favorit`
--
ALTER TABLE `favorit`
  ADD CONSTRAINT `products_id` FOREIGN KEY (`products_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pesanan_ibfk_4` FOREIGN KEY (`jasa_id`) REFERENCES `jasa_kirim` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pesanan_detail`
--
ALTER TABLE `pesanan_detail`
  ADD CONSTRAINT `pesanan_detail_ibfk_3` FOREIGN KEY (`products_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pesanan_detail_ibfk_4` FOREIGN KEY (`pesanan_id`) REFERENCES `pesanan` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_5` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_ibfk_6` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_ibfk_8` FOREIGN KEY (`toko_id`) REFERENCES `toko` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `promo`
--
ALTER TABLE `promo`
  ADD CONSTRAINT `toko_id` FOREIGN KEY (`toko_id`) REFERENCES `toko` (`id`);

--
-- Constraints for table `toko`
--
ALTER TABLE `toko`
  ADD CONSTRAINT `toko_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
