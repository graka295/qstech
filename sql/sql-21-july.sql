-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Waktu pembuatan: 21 Jul 2021 pada 16.03
-- Versi server: 5.7.26
-- Versi PHP: 7.4.2
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
--
-- Database: `qStech`
--
-- --------------------------------------------------------
--
-- Struktur dari tabel `admin`
--
CREATE TABLE `admin` (
    `id` int(11) NOT NULL,
    `first_name` varchar(30) NOT NULL,
    `last_name` varchar(30) DEFAULT NULL,
    `email` varchar(40) NOT NULL,
    `handphone` varchar(20) NOT NULL,
    `password` text NOT NULL,
    `image` varchar(40) DEFAULT NULL,
    `created_at` date DEFAULT NULL,
    `created_by` int(11) DEFAULT NULL,
    `updated_at` date DEFAULT NULL,
    `updated_by` int(11) DEFAULT NULL,
    `is_active` tinyint(1) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8;
--
-- Dumping data untuk tabel `admin`
--
INSERT INTO `admin` (
        `id`,
        `first_name`,
        `last_name`,
        `email`,
        `handphone`,
        `password`,
        `image`,
        `created_at`,
        `created_by`,
        `updated_at`,
        `updated_by`,
        `is_active`
    )
VALUES (
        5,
        'GALANG',
        'RAKA SIWI',
        'superadmin@gmail.com',
        '082121555342',
        '$2y$10$15mgK/Nk1bI6KHwnYi0CBum3zup/jXLkJ1d7GvRHk68CwUv4LkpWi',
        NULL,
        '2021-07-07',
        1,
        '2021-07-07',
        5,
        1
    );
-- --------------------------------------------------------
--
-- Struktur dari tabel `category_food`
--
CREATE TABLE `category_food` (
    `id` int(11) NOT NULL,
    `name` varchar(30) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8;
--
-- Dumping data untuk tabel `category_food`
--
INSERT INTO `category_food` (`id`, `name`)
VALUES (1, 'Makanan'),
    (2, 'Minuman');
-- --------------------------------------------------------
--
-- Struktur dari tabel `food`
--
CREATE TABLE `food` (
    `id` int(11) NOT NULL,
    `name` varchar(30) NOT NULL,
    `price` double NOT NULL,
    `description` text NOT NULL,
    `recommended` tinyint(4) NOT NULL,
    `id_category` int(11) NOT NULL,
    `created_by` int(11) NOT NULL,
    `created_at` date NOT NULL,
    `updated_by` date NOT NULL,
    `updated_at` int(11) NOT NULL,
    `is_active` tinyint(4) NOT NULL,
    `deleted_at` date DEFAULT NULL,
    `deleted_by` int(11) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8;
--
-- Dumping data untuk tabel `food`
--
INSERT INTO `food` (
        `id`,
        `name`,
        `price`,
        `description`,
        `recommended`,
        `id_category`,
        `created_by`,
        `created_at`,
        `updated_by`,
        `updated_at`,
        `is_active`,
        `deleted_at`,
        `deleted_by`
    )
VALUES (
        5,
        'MINUM JIWA',
        32000,
        'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, ',
        1,
        2,
        1,
        '2021-07-07',
        '0000-00-00',
        2021,
        1,
        NULL,
        5
    ),
    (
        6,
        'TOAST JIWA',
        40000,
        'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, ',
        0,
        1,
        1,
        '2021-07-07',
        '0000-00-00',
        2021,
        1,
        NULL,
        0
    ),
    (
        7,
        'MINUM JIWA 2',
        23000,
        'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, ',
        0,
        2,
        1,
        '2021-07-07',
        '0000-00-00',
        2021,
        1,
        NULL,
        5
    ),
    (
        8,
        'JIWA TOAST 2',
        12000,
        'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, ',
        1,
        1,
        5,
        '2021-07-07',
        '0000-00-00',
        2021,
        1,
        NULL,
        0
    );
-- --------------------------------------------------------
--
-- Struktur dari tabel `message`
--
CREATE TABLE `message` (
    `id` int(11) NOT NULL,
    `value` varchar(30) NOT NULL,
    `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `is_read` tinyint(4) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8;
--
-- Dumping data untuk tabel `message`
--
INSERT INTO `message` (`id`, `value`, `date`, `is_read`)
VALUES (
        1,
        'You have new order form NO 1',
        '2021-07-09 15:05:24',
        1
    ),
    (
        2,
        'You have new order form NO 1',
        '2021-07-09 15:36:47',
        1
    ),
    (
        3,
        'You have new order form NO 1',
        '2021-07-09 16:10:13',
        1
    ),
    (
        4,
        'You have new order form NO 1',
        '2021-07-09 16:10:13',
        1
    ),
    (
        5,
        'You have new order form NO 1',
        '2021-07-09 16:10:13',
        1
    ),
    (
        6,
        'You have new order form NO 1',
        '2021-07-09 16:10:31',
        1
    ),
    (
        7,
        'You have new order form NO 1',
        '2021-07-09 16:10:54',
        1
    ),
    (
        8,
        'You have new order form NO 1',
        '2021-07-09 16:12:16',
        1
    ),
    (
        9,
        'You have new order form NO 1',
        '2021-07-09 16:12:16',
        1
    ),
    (
        10,
        'You have new order form NO 1',
        '2021-07-09 16:12:42',
        1
    ),
    (
        11,
        'You have new order form NO 1',
        '2021-07-09 16:13:38',
        1
    ),
    (
        12,
        'You have new order form NO 1',
        '2021-07-09 16:21:33',
        1
    ),
    (
        13,
        'You have new order form NO 2',
        '2021-07-09 17:21:19',
        1
    ),
    (
        14,
        'You have new order form NO 2',
        '2021-07-09 17:22:39',
        1
    ),
    (
        15,
        'You have new order form NO 2',
        '2021-07-09 17:26:53',
        1
    ),
    (
        16,
        'You have new order form NO 1',
        '2021-07-10 04:25:24',
        1
    ),
    (
        17,
        'You have new order form NO 1',
        '2021-07-21 13:01:11',
        1
    ),
    (
        18,
        'You have new order form NO 1',
        '2021-07-21 13:01:11',
        1
    ),
    (
        19,
        'You have new order form NO 2',
        '2021-07-21 13:01:11',
        1
    ),
    (
        20,
        'You have new order form NO 2',
        '2021-07-21 14:49:31',
        1
    ),
    (
        21,
        'You have new order form NO 1',
        '2021-07-21 14:49:31',
        1
    ),
    (
        22,
        'You have new order form NO 1',
        '2021-07-21 08:49:00',
        0
    ),
    (
        23,
        'You have new order form NO 2',
        '2021-07-21 08:50:00',
        0
    );
-- --------------------------------------------------------
--
-- Struktur dari tabel `order`
--
CREATE TABLE `order` (
    `id` int(11) NOT NULL,
    `id_table` varchar(100) NOT NULL,
    `id_food` int(11) NOT NULL,
    `name_food` varchar(30) NOT NULL,
    `qty` int(11) NOT NULL,
    `price` double NOT NULL,
    `total` double NOT NULL,
    `note` text NOT NULL,
    `is_paid` tinyint(4) NOT NULL,
    `is_served` tinyint(4) NOT NULL,
    `created_by` int(11) NOT NULL,
    `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `updated_by` int(11) NOT NULL,
    `updated_at` date NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8;
--
-- Dumping data untuk tabel `order`
--
INSERT INTO `order` (
        `id`,
        `id_table`,
        `id_food`,
        `name_food`,
        `qty`,
        `price`,
        `total`,
        `note`,
        `is_paid`,
        `is_served`,
        `created_by`,
        `created_at`,
        `updated_by`,
        `updated_at`
    )
VALUES (
        52,
        '4',
        6,
        'TOAST JIWA',
        1,
        40000,
        40000,
        '',
        1,
        0,
        0,
        '2021-07-21 13:07:02',
        0,
        '0000-00-00'
    ),
    (
        53,
        '4',
        7,
        'MINUM JIWA 2',
        1,
        23000,
        23000,
        '',
        1,
        0,
        0,
        '2021-07-21 13:07:02',
        0,
        '0000-00-00'
    ),
    (
        54,
        '3',
        6,
        'TOAST JIWA',
        2,
        40000,
        80000,
        '',
        1,
        1,
        0,
        '2021-07-21 13:06:53',
        5,
        '2021-07-21'
    ),
    (
        55,
        '3',
        8,
        'JIWA TOAST 2',
        1,
        12000,
        12000,
        '',
        1,
        1,
        0,
        '2021-07-21 13:06:53',
        5,
        '2021-07-21'
    ),
    (
        56,
        '3',
        5,
        'MINUM JIWA',
        3,
        32000,
        96000,
        'es banyakan',
        1,
        1,
        0,
        '2021-07-21 13:06:53',
        5,
        '2021-07-21'
    ),
    (
        57,
        '3',
        6,
        'TOAST JIWA',
        1,
        40000,
        40000,
        '',
        1,
        1,
        0,
        '2021-07-21 15:50:08',
        5,
        '2021-07-21'
    ),
    (
        58,
        '4',
        6,
        'TOAST JIWA',
        1,
        40000,
        40000,
        '',
        1,
        0,
        0,
        '2021-07-21 15:50:42',
        0,
        '0000-00-00'
    ),
    (
        59,
        '4',
        7,
        'MINUM JIWA 2',
        1,
        23000,
        23000,
        '',
        1,
        0,
        0,
        '2021-07-21 15:50:42',
        0,
        '0000-00-00'
    );
-- --------------------------------------------------------
--
-- Struktur dari tabel `photo_food`
--
CREATE TABLE `photo_food` (
    `id` int(11) NOT NULL,
    `id_food` int(11) NOT NULL,
    `name` varchar(30) NOT NULL,
    `created_by` int(11) NOT NULL,
    `created_at` date NOT NULL,
    `updated_by` int(11) NOT NULL,
    `updated_at` date NOT NULL,
    `deleted_by` int(11) NOT NULL,
    `deleted_at` date NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8;
--
-- Dumping data untuk tabel `photo_food`
--
INSERT INTO `photo_food` (
        `id`,
        `id_food`,
        `name`,
        `created_by`,
        `created_at`,
        `updated_by`,
        `updated_at`,
        `deleted_by`,
        `deleted_at`
    )
VALUES (
        4,
        6,
        '20210707161250_RECVJ.png',
        1,
        '2021-07-07',
        0,
        '0000-00-00',
        0,
        '0000-00-00'
    ),
    (
        5,
        6,
        '20210707161343_RPUHV.png',
        1,
        '2021-07-07',
        0,
        '0000-00-00',
        0,
        '0000-00-00'
    ),
    (
        6,
        7,
        '20210707161431_PCMFT.png',
        1,
        '2021-07-07',
        0,
        '0000-00-00',
        0,
        '0000-00-00'
    ),
    (
        7,
        8,
        '20210707162850_YFPXZ.png',
        5,
        '2021-07-07',
        0,
        '0000-00-00',
        0,
        '0000-00-00'
    ),
    (
        8,
        5,
        '20210707164734_QWMII.png',
        0,
        '0000-00-00',
        0,
        '0000-00-00',
        0,
        '0000-00-00'
    ),
    (
        10,
        5,
        '20210707164912_RCKWI.png',
        5,
        '0000-00-00',
        5,
        '2021-07-07',
        0,
        '0000-00-00'
    );
-- --------------------------------------------------------
--
-- Struktur dari tabel `suggestions`
--
CREATE TABLE `suggestions` (
    `id` int(11) NOT NULL,
    `name` varchar(100) NOT NULL,
    `title` varchar(100) NOT NULL,
    `value` text NOT NULL,
    `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE = InnoDB DEFAULT CHARSET = utf8;
--
-- Dumping data untuk tabel `suggestions`
--
INSERT INTO `suggestions` (`id`, `name`, `title`, `value`, `created_at`)
VALUES (
        4,
        'GALANG RAKA SIWI',
        'SARAN1',
        'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.',
        '2021-07-12 19:12:26'
    ),
    (
        5,
        'GALANG RAK',
        'SARAN2',
        'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.',
        '2021-07-12 19:12:33'
    ),
    (
        6,
        'GALANG',
        'SARAN3',
        'LREO',
        '2021-07-12 19:13:42'
    );
-- --------------------------------------------------------
--
-- Struktur dari tabel `table`
--
CREATE TABLE `table` (
    `id` int(11) NOT NULL,
    `name` varchar(100) NOT NULL,
    `code` varchar(30) NOT NULL,
    `description` text NOT NULL,
    `is_active` tinyint(4) NOT NULL,
    `created_by` int(11) NOT NULL,
    `created_at` date NOT NULL,
    `updated_by` int(11) NOT NULL,
    `updated_at` date NOT NULL,
    `deleted_at` date DEFAULT NULL,
    `deleted_by` int(11) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8;
--
-- Dumping data untuk tabel `table`
--
INSERT INTO `table` (
        `id`,
        `name`,
        `code`,
        `description`,
        `is_active`,
        `created_by`,
        `created_at`,
        `updated_by`,
        `updated_at`,
        `deleted_at`,
        `deleted_by`
    )
VALUES (
        3,
        'NO 1',
        '599828',
        'DESC NO 1',
        1,
        5,
        '2021-07-08',
        5,
        '2021-07-09',
        NULL,
        0
    ),
    (
        4,
        'NO 2',
        '608792',
        'DESC 2',
        1,
        5,
        '2021-07-08',
        0,
        '0000-00-00',
        NULL,
        0
    );
-- --------------------------------------------------------
--
-- Struktur dari tabel `token_firebase`
--
CREATE TABLE `token_firebase` (
    `id` int(11) NOT NULL,
    `value` text NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8;
--
-- Dumping data untuk tabel `token_firebase`
--
INSERT INTO `token_firebase` (`id`, `value`)
VALUES (
        2,
        'fLSYQFsipGGlp1oV-jqaRv:APA91bGa_4wEZJLnrnpf5UhHH478tReboXfKNE95z6Pi-wCYYxlAEIHtkg6HohKgjjUSAiA7fvlnE9ZTSGVAUZQl0qPJpDMwNDk9deHyPiH37DyDM4dlXFV2KWqX2JJKwOQ1IaO2z8p9'
    );
-- --------------------------------------------------------
--
-- Struktur dari tabel `transaction`
--
CREATE TABLE `transaction` (
    `id` int(11) NOT NULL,
    `id_table` int(11) NOT NULL,
    `total` double NOT NULL,
    `money_paid` double NOT NULL,
    `money_changes` double NOT NULL,
    `created_by` int(11) NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8;
--
-- Dumping data untuk tabel `transaction`
--
INSERT INTO `transaction` (
        `id`,
        `id_table`,
        `total`,
        `money_paid`,
        `money_changes`,
        `created_by`,
        `created_at`
    )
VALUES (
        26,
        3,
        188000,
        190000,
        2000,
        5,
        '2021-07-19 13:08:59'
    ),
    (27, 4, 63000, 63000, 0, 5, '2021-07-21 13:09:02'),
    (
        28,
        3,
        40000,
        50000,
        10000,
        5,
        '2021-07-21 08:50:08'
    ),
    (
        29,
        4,
        63000,
        70000,
        7000,
        5,
        '2021-06-01 08:50:42'
    );
-- --------------------------------------------------------
--
-- Struktur dari tabel `transaction_order`
--
CREATE TABLE `transaction_order` (
    `id` int(11) NOT NULL,
    `id_trx` int(11) NOT NULL,
    `id_order` int(11) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8;
--
-- Dumping data untuk tabel `transaction_order`
--
INSERT INTO `transaction_order` (`id`, `id_trx`, `id_order`)
VALUES (59, 26, 54),
    (60, 26, 55),
    (61, 26, 56),
    (62, 27, 52),
    (63, 27, 53),
    (64, 28, 57),
    (65, 29, 58),
    (66, 29, 59);
--
-- Indexes for dumped tables
--
--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
ADD PRIMARY KEY (`id`);
--
-- Indeks untuk tabel `category_food`
--
ALTER TABLE `category_food`
ADD PRIMARY KEY (`id`);
--
-- Indeks untuk tabel `food`
--
ALTER TABLE `food`
ADD PRIMARY KEY (`id`);
--
-- Indeks untuk tabel `message`
--
ALTER TABLE `message`
ADD PRIMARY KEY (`id`);
--
-- Indeks untuk tabel `order`
--
ALTER TABLE `order`
ADD PRIMARY KEY (`id`);
--
-- Indeks untuk tabel `photo_food`
--
ALTER TABLE `photo_food`
ADD PRIMARY KEY (`id`);
--
-- Indeks untuk tabel `suggestions`
--
ALTER TABLE `suggestions`
ADD PRIMARY KEY (`id`);
--
-- Indeks untuk tabel `table`
--
ALTER TABLE `table`
ADD PRIMARY KEY (`id`);
--
-- Indeks untuk tabel `token_firebase`
--
ALTER TABLE `token_firebase`
ADD PRIMARY KEY (`id`);
--
-- Indeks untuk tabel `transaction`
--
ALTER TABLE `transaction`
ADD PRIMARY KEY (`id`);
--
-- Indeks untuk tabel `transaction_order`
--
ALTER TABLE `transaction_order`
ADD PRIMARY KEY (`id`);
--
-- AUTO_INCREMENT untuk tabel yang dibuang
--
--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 6;
--
-- AUTO_INCREMENT untuk tabel `category_food`
--
ALTER TABLE `category_food`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 3;
--
-- AUTO_INCREMENT untuk tabel `food`
--
ALTER TABLE `food`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 9;
--
-- AUTO_INCREMENT untuk tabel `message`
--
ALTER TABLE `message`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 24;
--
-- AUTO_INCREMENT untuk tabel `order`
--
ALTER TABLE `order`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 60;
--
-- AUTO_INCREMENT untuk tabel `photo_food`
--
ALTER TABLE `photo_food`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 11;
--
-- AUTO_INCREMENT untuk tabel `suggestions`
--
ALTER TABLE `suggestions`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 7;
--
-- AUTO_INCREMENT untuk tabel `table`
--
ALTER TABLE `table`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 5;
--
-- AUTO_INCREMENT untuk tabel `token_firebase`
--
ALTER TABLE `token_firebase`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 3;
--
-- AUTO_INCREMENT untuk tabel `transaction`
--
ALTER TABLE `transaction`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 30;
--
-- AUTO_INCREMENT untuk tabel `transaction_order`
--
ALTER TABLE `transaction_order`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 67;