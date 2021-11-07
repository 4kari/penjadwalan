-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Nov 2021 pada 13.35
-- Versi server: 10.4.19-MariaDB
-- Versi PHP: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lay_jadwal`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal`
--

CREATE TABLE `jadwal` (
  `id` int(11) NOT NULL,
  `judul` varchar(128) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `waktu` int(2) DEFAULT NULL,
  `ruangan` int(2) DEFAULT NULL,
  `periode` int(2) DEFAULT NULL,
  `penguji_1` varchar(18) DEFAULT NULL,
  `penguji_2` varchar(18) DEFAULT NULL,
  `penguji_3` varchar(18) DEFAULT NULL,
  `tipe` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `periode`
--

CREATE TABLE `periode` (
  `id` int(2) NOT NULL,
  `periode` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `periode`
--

INSERT INTO `periode` (`id`, `periode`) VALUES
(1, '2010/2011'),
(2, '2011/2012'),
(3, '2012/2013'),
(4, '2013/2014'),
(5, '2014/2015'),
(6, '2015/2016'),
(7, '2016/2017'),
(8, '2017/2018'),
(9, '2018/2019'),
(10, '2019/2020'),
(11, '2020/2021'),
(12, '2021/2022');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ruangan`
--

CREATE TABLE `ruangan` (
  `id` int(2) NOT NULL,
  `ruangan` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `ruangan`
--

INSERT INTO `ruangan` (`id`, `ruangan`) VALUES
(1, 'Auditorium'),
(2, 'RKBF 204'),
(3, 'Ruang Baca');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tipe`
--

CREATE TABLE `tipe` (
  `id` int(11) NOT NULL,
  `tipe` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tipe`
--

INSERT INTO `tipe` (`id`, `tipe`) VALUES
(1, 'seminar proposal'),
(2, 'sidang skripsi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `validasi`
--

CREATE TABLE `validasi` (
  `id` int(11) NOT NULL,
  `id_jadwal` int(11) NOT NULL,
  `penguji_1` varchar(18) DEFAULT NULL,
  `penguji_2` varchar(18) DEFAULT NULL,
  `penguji_3` varchar(18) DEFAULT NULL,
  `pembimbing_1` varchar(18) DEFAULT NULL,
  `pembimbing_2` varchar(18) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `waktu`
--

CREATE TABLE `waktu` (
  `id` int(2) NOT NULL,
  `waktu` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `waktu`
--

INSERT INTO `waktu` (`id`, `waktu`) VALUES
(1, '07:30-08:00'),
(2, '08:00-08:30'),
(3, '08:30-09:00'),
(4, '09:00-09:30'),
(5, '09:30-10:00'),
(6, '10:00-10:30'),
(7, '10:30-11:00'),
(8, '11:00-11:30'),
(9, '11:30-12:00'),
(10, '12:00-12:30'),
(11, '12:30-13:00'),
(12, '13:00-13:30'),
(13, '13:30-14:00'),
(14, '14:00-14:30'),
(15, '14:30-15:00'),
(16, '15:00-15:30'),
(17, '15:30-16:00');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jadwal_periode` (`periode`),
  ADD KEY `jadwal_ruangan` (`ruangan`),
  ADD KEY `jadwal_waktu` (`waktu`),
  ADD KEY `jadwal_tipe` (`tipe`);

--
-- Indeks untuk tabel `periode`
--
ALTER TABLE `periode`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ruangan`
--
ALTER TABLE `ruangan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tipe`
--
ALTER TABLE `tipe`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `validasi`
--
ALTER TABLE `validasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_jadwal` (`id_jadwal`);

--
-- Indeks untuk tabel `waktu`
--
ALTER TABLE `waktu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1001;

--
-- AUTO_INCREMENT untuk tabel `periode`
--
ALTER TABLE `periode`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `ruangan`
--
ALTER TABLE `ruangan`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tipe`
--
ALTER TABLE `tipe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `validasi`
--
ALTER TABLE `validasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1001;

--
-- AUTO_INCREMENT untuk tabel `waktu`
--
ALTER TABLE `waktu`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  ADD CONSTRAINT `jadwal_periode` FOREIGN KEY (`periode`) REFERENCES `periode` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jadwal_ruangan` FOREIGN KEY (`ruangan`) REFERENCES `ruangan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jadwal_tipe` FOREIGN KEY (`tipe`) REFERENCES `tipe` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jadwal_waktu` FOREIGN KEY (`waktu`) REFERENCES `waktu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `validasi`
--
ALTER TABLE `validasi`
  ADD CONSTRAINT `validasi_ibfk_1` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
