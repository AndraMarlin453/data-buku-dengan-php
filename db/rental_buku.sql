-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Sep 2023 pada 02.13
-- Versi server: 10.4.25-MariaDB
-- Versi PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rental_buku`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `id` int(11) NOT NULL,
  `judul` varchar(500) NOT NULL,
  `pengarang` varchar(255) NOT NULL,
  `penerbit` varchar(255) NOT NULL,
  `jumlah_halaman` int(4) NOT NULL,
  `harga` int(10) NOT NULL,
  `gambar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`id`, `judul`, `pengarang`, `penerbit`, `jumlah_halaman`, `harga`, `gambar`) VALUES
(2, 'Belajar CSS Dasar Untuk Pemula', 'Tatang Wahyudi', 'Erlangga', 45, 46000, '64efaf44a8c41.jpg'),
(3, 'Belajar Javascript Untuk Pemula', 'Eko Arwono', 'Sejahtera', 78, 65000, 'js.jpg'),
(4, 'Belajar PHP Untuk Pemula', 'Mega Kusnaedi', 'Gramedia', 80, 70000, 'php.jpg'),
(5, 'Belajar Bootstrap Untuk Pemula', 'Dodi Sunandar', 'Gramedia', 60, 50000, 'boot.jpg'),
(6, 'Apa Itu Algoritma', 'Udin Gambut', 'SukaSuka', 25, 30000, 'algo.jpg'),
(7, 'Belajar Pemrograman Web', 'Nia Karwo', 'Erlangga', 96, 95000, 'web.jpg'),
(8, 'Belajar React Untuk Pemula', 'Yayat Hidayat', 'Rumah Buku', 100, 120000, 'react.jpg'),
(9, 'Belajar Laravel Untuk Pemula', 'Andi Sunandi', 'Erlangga', 95, 90000, 'lara.jpg'),
(10, 'Belajar Vue Untuk Pemula', 'Irma Nasution', 'Rumah Buku', 80, 85000, 'vue.jpg'),
(11, 'Belajar GOLANG Untuk Pemula', 'Joko Santi', 'SukaSuka', 70, 65000, 'go.jpg'),
(12, 'Belajar C++ Sampai Mahir', 'Arie Wibowo', 'Erlangga', 200, 150000, 'cpp.jpg'),
(26, 'Belajar dasar pemrograman Java', 'Kurnia Dedy', 'Rumah Pintar', 123, 100000, 'java.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$d/r1oMkwrpsRLzk2w2MuIenCTCKb24JGqGgQnUcpsrjSa7GK8063y');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `buku`
--
ALTER TABLE `buku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
