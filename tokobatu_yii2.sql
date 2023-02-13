-- Adminer 4.8.1 MySQL 5.7.33 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `category` (`id`, `name`, `img`) VALUES
(1,	'Makanan',	'11674023608.png'),
(2,	'Elektronik',	'11674097629.png'),
(3,	'Minuman',	'11674097648.png'),
(4,	'Baju',	'11674097662.png'),
(5,	'Alat Tulis',	'crChA3GUeEE9DdH2fwjOl2aWO1oxzGwq.png');

DROP TABLE IF EXISTS `jasa_kirim`;
CREATE TABLE `jasa_kirim` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `jasa_kirim` (`id`, `name`, `slug`) VALUES
(1,	'JNE',	'jne'),
(10,	'POS Indonesia',	'pos'),
(14,	'TIKI',	'tiki');

DROP TABLE IF EXISTS `pesanan`;
CREATE TABLE `pesanan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `jasa_id` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `kode_unik` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `paket` varchar(100) DEFAULT NULL,
  `ongkir` int(11) DEFAULT NULL,
  `estimasi` varchar(100) DEFAULT NULL,
  `status_pemesanan` enum('pending','dikonfirmasi','dalam perjalanan','sukses','gagal') NOT NULL DEFAULT 'pending',
  `code_transaksi_midtrans` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `jasa_id` (`jasa_id`),
  CONSTRAINT `pesanan_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `pesanan_ibfk_4` FOREIGN KEY (`jasa_id`) REFERENCES `jasa_kirim` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `pesanan` (`id`, `user_id`, `jasa_id`, `status`, `kode_unik`, `total_harga`, `paket`, `ongkir`, `estimasi`, `status_pemesanan`, `code_transaksi_midtrans`, `created_at`, `updated_at`) VALUES
(11,	28,	10,	1,	85047,	179000,	'Pos Reguler',	76000,	'11 HARI',	'dalam perjalanan',	'8b5a6ada-fca8-4215-9e20-fce430ff1001',	'2023-02-08 09:53:09',	'2023-02-08 09:53:09'),
(12,	28,	10,	1,	81669,	131000,	'Pos Reguler',	14000,	'2 HARI',	'pending',	'2b1947f9-6bad-4003-8968-cb9f570d7213',	'2023-02-08 10:02:10',	'2023-02-08 10:02:10'),
(13,	28,	1,	1,	75294,	175000,	'OKE',	17000,	'7-8',	'pending',	'cba50905-97f8-4bd6-8b46-abe1488b51ce',	'2023-02-08 10:10:06',	'2023-02-08 11:03:09'),
(16,	23,	14,	1,	24155,	150000,	'ECO',	20000,	'4',	'dikonfirmasi',	'a910086a-8abc-4f42-a08a-2539b0fe261f',	'2023-02-09 08:38:05',	'2023-02-09 08:38:05'),
(17,	23,	1,	1,	37934,	100000,	'OKE',	17000,	'7-8',	'dikonfirmasi',	'1a456ed1-8fc9-4d33-b466-cb8ea6cadc84',	'2023-02-09 09:04:11',	'2023-02-09 09:04:11'),
(18,	23,	NULL,	0,	48954,	50000,	NULL,	NULL,	NULL,	'pending',	NULL,	'2023-02-09 13:18:01',	'2023-02-09 13:18:01'),
(22,	26,	NULL,	0,	84443,	217000,	NULL,	NULL,	NULL,	'pending',	NULL,	'2023-02-10 10:10:40',	'2023-02-10 10:10:40');

DROP TABLE IF EXISTS `pesanan_detail`;
CREATE TABLE `pesanan_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `products_id` int(11) NOT NULL,
  `pesanan_id` int(11) NOT NULL,
  `jml` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `products_id` (`products_id`),
  KEY `pesanan_id` (`pesanan_id`),
  CONSTRAINT `pesanan_detail_ibfk_3` FOREIGN KEY (`products_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `pesanan_detail_ibfk_4` FOREIGN KEY (`pesanan_id`) REFERENCES `pesanan` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `pesanan_detail` (`id`, `products_id`, `pesanan_id`, `jml`, `total`) VALUES
(14,	17,	11,	2,	40000),
(15,	20,	11,	3,	39000),
(16,	18,	11,	2,	100000),
(17,	20,	12,	2,	26000),
(18,	21,	12,	3,	105000),
(19,	21,	13,	5,	175000),
(25,	8,	16,	2,	100000),
(26,	18,	16,	1,	50000),
(27,	18,	17,	2,	100000),
(28,	8,	18,	1,	50000),
(29,	8,	22,	2,	100000),
(30,	17,	22,	3,	60000),
(31,	18,	22,	1,	50000),
(32,	19,	22,	1,	7000);

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `toko_id` int(11) DEFAULT NULL,
  `img` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `deskripsi_produk` text NOT NULL,
  `berat` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `category_id` (`category_id`),
  KEY `toko_id` (`toko_id`),
  CONSTRAINT `products_ibfk_5` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `products_ibfk_6` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE,
  CONSTRAINT `products_ibfk_8` FOREIGN KEY (`toko_id`) REFERENCES `toko` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `products` (`id`, `name`, `user_id`, `category_id`, `toko_id`, `img`, `harga`, `stok`, `deskripsi_produk`, `berat`) VALUES
(8,	'Es Coklat',	26,	3,	42,	'xZaGjKkeJoH0yXxWEd_8T8a4mf2mAVKW.jpg',	50000,	960,	'Lorem ipsum dolor yahaha',	'2'),
(14,	'Jersi merah',	26,	4,	42,	'Y6pC6oPyMOeUxFeyXQhMhpRw28dXpOqH.jfif',	135000,	0,	'lorem ipsum dolor lorem ipsum dolor lorem ipsum dolor lorem ipsum dolor lorem ipsum dolor lorem ipsum dolor lorem ipsum dolor lorem ipsum dolor lorem ipsum dolor lorem ipsum dolor lorem ipsum dolor lorem ipsum dolor lorem ipsum dolor lorem ipsum dolor lorem ipsum dolor lorem ipsum dolor lorem ipsum dolor lorem ipsum dolor lorem ipsum dolor lorem ipsum dolor lorem ipsum dolor lorem ipsum dolor lorem ipsum dolor lorem ipsum dolor lorem ipsum dolor lorem ipsum dolor lorem ipsum dolor lorem ipsum dolor lorem ipsum dolor lorem ipsum dolor lorem ipsum dolor lorem ipsum dolor lorem ipsum dolor lorem ipsum dolor lorem ipsum dolor lorem ipsum dolor',	'3'),
(17,	'Mangga',	23,	1,	45,	'HTfshHQNxDXs7cZ7RGL2Vj2Z7DHbNFgI.jfif',	20000,	798,	'lorem',	'1500'),
(18,	'Keluarga Mangga',	23,	1,	45,	'fo3I8QjfHBAcv5XRF55dUgA9dgRk9FQV.jfif',	50000,	963,	'lorem',	'7000'),
(19,	'Kripik Singkong',	23,	1,	45,	'ljrNNxtSMNx53PkRGUGsdin4AMc2wgPF.jpg',	7000,	299,	'lorem',	'700'),
(20,	'Radfer',	23,	3,	45,	'lm6gyZohEp4WgVaD1lcICtqI9KZboE0d.jfif',	13000,	885,	'lorem',	'900'),
(21,	'Semangka',	23,	1,	45,	'9e0m5oE8dkgLNqq1zLyOnYsUmVtJ7sA5.png',	35000,	7973,	'lorem',	'10000'),
(22,	'Buku Tugas',	19,	5,	NULL,	'hIzzRSzHEGrUQ_nUhyzWWPT7_327O0hl.jpeg',	15000,	200,	'Banyak Tugas \r\n',	'1500'),
(23,	'Kimchi',	23,	1,	45,	'U44MlHPv3P9rXW5r3qS02vKBrOnVOuDY.png',	19500,	800,	'lorem ipsum kimci yahahahahaha haha',	'5600'),
(24,	'Kripik Kentang',	23,	1,	45,	'dEqEIwG9WhkWl_LcPtlTleOTurQce1bh.jfif',	9000,	900,	'lorem ppp',	'1300'),
(25,	'Es Jeruk',	23,	3,	45,	'6FzG8Ypn3IwQd2dszwFgwJwBzHOLeCH_.png',	7000,	700,	'lorem jeruk kwkwkwkwk yahaha',	'1200'),
(26,	'Jersi Oranye',	26,	4,	42,	'75IgBay5BIVgfIe0QEegqdr6b-tTQvEo.jfif',	36000,	1200,	'lorem ipsum dlolll',	'1000');

DROP TABLE IF EXISTS `role`;
CREATE TABLE `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `role` (`id`, `name`) VALUES
(1,	'user'),
(2,	'admin'),
(3,	'penjual');

DROP TABLE IF EXISTS `toko`;
CREATE TABLE `toko` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `alamat` text NOT NULL,
  `no_whatsapp` varchar(13) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `flag` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `toko_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `toko` (`id`, `id_user`, `name`, `deskripsi`, `alamat`, `no_whatsapp`, `created_at`, `updated_at`, `flag`) VALUES
(42,	26,	'Barokah_shop',	'Lorem ipsum dolor Lorem ipsum dolor sit amet is a Latin phrase that translates to “ pain is an illusion.” The phrase is often used in psychological and philosophical discussions about the nature of pain. The phrase lorem',	'jl.Mawar,No.1,Kec.Bungkal,Kab.Ponorogo',	'081234567890',	'2023-01-25 10:08:47',	'2023-01-28 10:57:08',	'ArnVjmNeCXZqZQc7vCLQ5Kn7rGSR0KgK.jpg'),
(45,	23,	'Phoenix_go_id',	'lorem ipsum',	'jl.Mawar,No.1,Kec.Bungkal,Kab.Ponorogo',	'083999292011',	'2023-02-01 10:15:12',	'2023-02-01 10:15:12',	'5mgZqmEJavZ13iLpz8_zNFX1agik4_WN.png');

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `user_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `user` (`id`, `name`, `email`, `password`, `alamat`, `kota`, `provinsi`, `type`, `no_hp`, `codepos`, `status`, `role_id`, `img`, `created_at`, `updated_at`) VALUES
(19,	'admin',	'admin@gmail.com',	'$2y$13$8Gubjltl.f4T4LtXVwcGDONP3qNjYQsognz.RSZOa69GFhAticLmS',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	10,	2,	NULL,	NULL,	NULL),
(23,	'Kelvin',	'kv@gmail.com',	'$2y$13$LkPSvHrU1NRoVLvs1Vs2/.lFvcS03IoyNJrtB/jSvkqbe1tzKmm4a',	'Jl. Mawar Putih,No.55',	'Kabupaten Ponorogo',	'Jawa Timur',	'Kabupaten',	'085708217852',	63411,	10,	3,	'eNpCkTrVmrNW1MvabXoh4QnLVQEU_cY-.jpg',	'2023-01-21 16:36:38',	'2023-02-09 12:22:26'),
(26,	'Havid Rossihandanu',	'hv@gmail.com',	'$2y$13$uzC.AqtN04sFYcPsbPe6hOT6d4pqW5sO7IEhjwyi/gEpuwU7lGRbi',	'Jl. Mawar Putih,No.55',	'Ponorogo',	NULL,	NULL,	'082333444554',	96879,	10,	3,	'X0DbpVnSOjFJhxwfSU91Yszlo88qH81c.jpg',	'2023-01-23 15:27:34',	'2023-01-28 13:37:21'),
(28,	'Kelvin Rohmat Setiaji',	'kelvinrohmatsetiaji@gmail.com',	'$2y$13$g.fB3poV5.GWL8TgStA4huMre9tCKbZjFRCD6fxBw3/D1u5CV879e',	'Jl. Rosa, No.58',	'Kabupaten Ponorogo',	'Jawa Timur',	'Kabupaten',	'085708217852',	63411,	10,	1,	'NRBW9c-MHXfXDLW_-l265sh-2ttOVvYV.jfif',	'2023-02-01 09:26:20',	'2023-02-08 10:25:11');

-- 2023-02-13 00:21:31
