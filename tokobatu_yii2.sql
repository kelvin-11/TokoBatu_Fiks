-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2023 at 04:40 AM
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
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`id`, `image`, `created_at`) VALUES
(1, 'oIC9pWnx5Q6sP94yznOJ5L81bsBIdLMv.png', '2023-05-15 14:24:25');

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
(52, 'Mie Surga', 23, 28, 61, '', 10000, 1000, 'Mie dengan kualitas terbaik dari mie pedas Orins tanpa Lombok. Lengkap dengan toping ayam, sayur, Daging dan Krupuk. Bagi yg suka Kecap bisa ditambah.', '400'),
(53, 'Mie Jahannam', 23, 28, 61, '', 10000, 1000, 'Mie pedas Jahannam. Mie dengan kepedasan level lengkap dengan toping ayam, daging, sayur, kerupuk. Level S = 12. Level M = 24. Level L = 48. Bisa juga request lombok 1-10.', '400'),
(54, 'Mie Neraka', 23, 28, 61, '', 10000, 1000, 'Mie Neraka. Mie dengan level dan tambahan kecap lengkap dengan Toping ayam, daging, sayur, krupuk. Level S = 12. Level M =24. Level L = 48. Bisa request lombok 1 - 10', '400'),
(55, 'Ice blended coklat 350ml', 23, 28, 61, '', 6000, 1000, 'ice blend coklat yg lezat', '250'),
(56, 'Ice blended green tea 350ml', 23, 28, 61, '', 6000, 1000, 'lorem ipsum', '250'),
(57, 'Ice blended Taro 350ml', 23, 28, 61, '', 6000, 1000, 'lorem ipsum\r\n', '250'),
(58, 'Ice Tea', 23, 28, 61, '', 3000, 1000, 'lorem ipsum', '150'),
(59, 'Rengginang Cumi Pedas', 23, 28, 61, '', 25000, 1000, 'Rengginang asli dari tinta cumi bukan pewarna makanan. Tanpa jemur', '500'),
(60, 'Rengginang Cumi Ori', 23, 28, 61, '', 23000, 1000, 'lorem ipsum', '450'),
(66, 'Buku Mainan', 23, 20, 61, '', 18000, 1000, 'lorem ipsum\r\n', '400'),
(67, 'Sempol KWB', 23, 28, 61, '', 20000, 1000, 'lorem ipsum', '300'),
(68, 'Keripik Kentang', 23, 28, 61, '', 7000, 1000, 'lorem ipsum', '200'),
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
(23, 'Kelvin Rohmat Setiaji', 'kv@gmail.com', '$2y$13$LkPSvHrU1NRoVLvs1Vs2/.lFvcS03IoyNJrtB/jSvkqbe1tzKmm4a', 'Jl. Mawar Putih,No.51', 'Kabupaten Ponorogo', 'Jawa Timur', 'Kabupaten', '085708217852', 63411, 10, 3, 'wKtC1QIjCVFmRQGk_tpMIf74tvnLIlXJ.jpg', 'TOKOBATUMTY4NDMrdi1HZFBvRmg3aFFmcDcxUUt0MW_9jrq0_9hMnhJQWt6NVR3b3BDeG5VQSsxMzc2MA==S3CRETKEY', 'sID7NMqJMo_o_tRKhvatb_c8Fy8Tdfvr', '2023-01-21 16:36:38', '2023-05-22 10:57:47'),
(26, 'Customer', 'customer@gmail.com', '$2y$13$uzC.AqtN04sFYcPsbPe6hOT6d4pqW5sO7IEhjwyi/gEpuwU7lGRbi', 'Jl. Mawar Putih,No.55', 'Kabupaten Ponorogo', 'Jawa Timur', 'Kabupaten', '082333444554', 63411, 10, 1, 'X0DbpVnSOjFJhxwfSU91Yszlo88qH81c.jpg', 'TOKOBATUMTY3OTYrancxU09pK2h5Wk8wOGdReE_FY6bP_huVk9NMW5ndHI1WHBsb2YrNDA3OTI=S3CRETKEY', 'zuIzT9pvY-ES2_7ZxYTyhQhs3ejZqBmK', '2023-01-23 15:27:34', '2023-05-19 08:56:08'),
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `favorit`
--
ALTER TABLE `favorit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `jasa_kirim`
--
ALTER TABLE `jasa_kirim`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `pesanan_detail`
--
ALTER TABLE `pesanan_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `promo`
--
ALTER TABLE `promo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
