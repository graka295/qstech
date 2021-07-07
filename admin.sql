-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Waktu pembuatan: 26 Nov 2020 pada 07.27
-- Versi server: 5.7.26
-- Versi PHP: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `eccom-online`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `first_name`, `last_name`, `email`, `handphone`, `password`, `image`, `created_at`, `created_by`, `updated_at`, `updated_by`, `is_active`) VALUES
(1, 'SUPER', 'ADMIN SEKALE', 'superadmin@gmail.com', '081121123111', '$2y$10$YXQeDtLnUEIVLxdY5WVb6OQSe4.0DKgO9KHVnD.ic5UE/55sbnYre', '2020_11_21_01_39_18.jpeg', NULL, NULL, '2020-11-21', 3, 1),
(3, 'GALANG', 'RAKA', 'graka295@gmail.com', '082121555342', '$2y$10$dj37VGtmgQLz2n33ZGqfYu7yyeY6hVLBcgpMWfgM.kKLYzS4hA7/.', '2020_11_21_01_03_27.jpg', '2020-11-10', 1, '2020-11-21', 3, 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
