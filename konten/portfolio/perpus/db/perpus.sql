-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Jan 2019 pada 13.25
-- Versi server: 10.1.36-MariaDB
-- Versi PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpus`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggota`
--

CREATE TABLE `anggota` (
  `id_anggota` int(14) NOT NULL,
  `nama_anggota` varchar(50) NOT NULL,
  `alamat_anggota` text NOT NULL,
  `jk_anggota` enum('L','P') NOT NULL,
  `hp_anggota` varchar(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `anggota`
--

INSERT INTO `anggota` (`id_anggota`, `nama_anggota`, `alamat_anggota`, `jk_anggota`, `hp_anggota`) VALUES
(53, 'Binangun', 'Solo', 'L', '08654698459684'),
(55, 'Arcana', 'Banjarmasin', 'P', '97324723647236'),
(56, 'Candil', 'Sulawesi', 'L', '98458345856596'),
(57, 'Bihuin', 'Sumatra ', 'P', '94835734873857'),
(58, 'Katun', 'Kalimantan', 'L', '95468945684968'),
(59, 'Darto', 'Banyuwangi', 'L', '08973426346273');

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `id_buku` int(10) NOT NULL,
  `judul_buku` varchar(50) NOT NULL,
  `deskripsi_buku` text NOT NULL,
  `jumlah_buku` int(10) NOT NULL,
  `cover_buku` varchar(50) NOT NULL,
  `id_kategori` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`id_buku`, `judul_buku`, `deskripsi_buku`, `jumlah_buku`, `cover_buku`, `id_kategori`) VALUES
(2, 'Biologi', 'Biologi Umum', 4, 'Desert.jpg', 1),
(3, 'Sejarah Medieval', 'Sejarah jaman pertengahan', 1, 'full.jpg', 2),
(4, 'Vue js ', 'Framework frontend javascript', 7, 'icon.jpg', 3),
(6, 'Bela diri', 'Seni bela diri tradisional', 1, 'Untitled-1.jpg', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(10) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'IPA'),
(2, 'IPS'),
(3, 'Programming'),
(4, 'Fiksi'),
(5, 'Non fiksi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kembali`
--

CREATE TABLE `kembali` (
  `id_kembali` int(11) NOT NULL,
  `id_pinjam` int(11) NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `denda` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `petugas`
--

CREATE TABLE `petugas` (
  `id_petugas` int(11) NOT NULL,
  `nama_petugas` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `petugas`
--

INSERT INTO `petugas` (`id_petugas`, `nama_petugas`, `username`, `password`) VALUES
(1, 'awal', 'awal', '$2y$10$DeEp.ttx6FgDSbMzIbUURusMOhv/ged6KTpzxOg1y2mYEgye.d3jS'),
(2, 'prasetyo', 'prasetyo', '$2y$10$fGILx9Tk9boA.n0I3ivmlO8Vrz3/.vtF45xDgIOgc/I2jAV7ZYjWu'),
(3, 'admin', 'admin', '$2y$10$X3zx4ikOW5Iso3vNyw8FEOJG0P/lK7HFd6ydDWbFwwXUxQ3Jt3wBC');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pinjam`
--

CREATE TABLE `pinjam` (
  `id_pinjam` int(10) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `id_anggota` int(11) NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_jatuh_tempo` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id_anggota`);

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`),
  ADD KEY `buku_fk` (`id_kategori`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `kembali`
--
ALTER TABLE `kembali`
  ADD PRIMARY KEY (`id_kembali`),
  ADD KEY `kembali_fk` (`id_pinjam`);

--
-- Indeks untuk tabel `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id_petugas`);

--
-- Indeks untuk tabel `pinjam`
--
ALTER TABLE `pinjam`
  ADD PRIMARY KEY (`id_pinjam`),
  ADD KEY `pinjam_fk1` (`id_anggota`),
  ADD KEY `pinjam_fk2` (`id_buku`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id_anggota` int(14) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT untuk tabel `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `kembali`
--
ALTER TABLE `kembali`
  MODIFY `id_kembali` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id_petugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `pinjam`
--
ALTER TABLE `pinjam`
  MODIFY `id_pinjam` int(10) NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `buku_fk` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`);

--
-- Ketidakleluasaan untuk tabel `kembali`
--
ALTER TABLE `kembali`
  ADD CONSTRAINT `kembali_fk` FOREIGN KEY (`id_pinjam`) REFERENCES `pinjam` (`id_pinjam`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pinjam`
--
ALTER TABLE `pinjam`
  ADD CONSTRAINT `pinjam_fk1` FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id_anggota`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `pinjam_fk2` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
