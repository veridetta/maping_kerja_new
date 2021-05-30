-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Bulan Mei 2021 pada 15.30
-- Versi server: 10.4.17-MariaDB
-- Versi PHP: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mapping_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `data`
--

CREATE TABLE `data` (
  `id` int(11) NOT NULL,
  `nama` text NOT NULL,
  `hp` text NOT NULL,
  `alamat` text NOT NULL,
  `keahlian` text NOT NULL,
  `pengalaman` text NOT NULL,
  `pendidikan` text NOT NULL,
  `ktp` text NOT NULL,
  `poto` text NOT NULL,
  `status` int(11) NOT NULL,
  `pekerjaan` text NOT NULL,
  `partner` text NOT NULL,
  `tanggal` text NOT NULL,
  `lat` text NOT NULL,
  `lng` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `data`
--

INSERT INTO `data` (`id`, `nama`, `hp`, `alamat`, `keahlian`, `pengalaman`, `pendidikan`, `ktp`, `poto`, `status`, `pekerjaan`, `partner`, `tanggal`, `lat`, `lng`) VALUES
(11, 'Ahmad Jalaluddin Rabbany', '089619669223', 'Jl. Dwi Pantara', 'Bahasa Pemrograman HTML', 'Staff Google', 'S1', '3274033006970006', '15-08-2020-14-08-1115-08-2020-13-49-4725-07-2020-16-47-14man.png07-03-2020-13-44-48.png', 1, 'Programming', '2', '15-08-2020-14-08-11', '-6.761', '108.545');

-- --------------------------------------------------------

--
-- Struktur dari tabel `datakmeanspkh`
--

CREATE TABLE `datakmeanspkh` (
  `id` int(11) NOT NULL,
  `nama` text NOT NULL,
  `hp` text NOT NULL,
  `ttl` text NOT NULL,
  `alamat` text NOT NULL,
  `status_pkh` text NOT NULL,
  `pendapatan` text NOT NULL,
  `skala_pendapatan` text NOT NULL,
  `tanggungan` text NOT NULL,
  `skala_tanggungan` text NOT NULL,
  `cluster` text NOT NULL,
  `lat` text NOT NULL,
  `lng` text NOT NULL,
  `partner` text NOT NULL,
  `poto` text NOT NULL,
  `tanggal` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `datakmeanspkh`
--

INSERT INTO `datakmeanspkh` (`id`, `nama`, `hp`, `ttl`, `alamat`, `status_pkh`, `pendapatan`, `skala_pendapatan`, `tanggungan`, `skala_tanggungan`, `cluster`, `lat`, `lng`, `partner`, `poto`, `tanggal`) VALUES
(9, 'AAM AMINAH', '089327401017060832', 'KOTA CIREBON, 10-09-1978', 'KAMPUNG CIBOGO RW 09 RT 06', '1', '1000000', '1', '3', '2', 'C1', '-6.764', '108.532', '2', '11-04-2021-17-14-2307-12-2020-06-50-1007-12-2020-06-41-4515-08-2020-14-01-32png-transparent-muslim-graphy-illustration-islamists-child-boy-cartoon-thumbnail.png', '11-04-2021-17-14-23'),
(10, 'AAN ANALIA', '089327401016300004', 'KOTA CIREBON, 01-06-1985', 'KEDUNG MENDENG RT 01 RW 03', '1', '600000', '1', '6', '1', 'C1', '-6.764', '108.530', '2', '11-04-2021-17-16-0007-12-2020-06-46-2407-12-2020-06-41-4515-08-2020-14-01-32png-transparent-muslim-graphy-illustration-islamists-child-boy-cartoon-thumbnail.png', '11-04-2021-17-16-00'),
(11, 'AAN SETIANINGSIH', '089327401016000184', 'KOTA CIREBON, 01-07-1978', 'CADASNGAMPAR RT 05 RW 08', '2', '1300000', '2', '1', '3', 'C2', '-6.762', '108.543', '2', '11-04-2021-17-18-3607-12-2020-06-46-2407-12-2020-06-41-4515-08-2020-14-01-32png-transparent-muslim-graphy-illustration-islamists-child-boy-cartoon-thumbnail.png', '11-04-2021-17-18-36'),
(12, 'AAS ASITI', '089327401017060491', 'KOTA CIREBON, 18-10-1974', 'SUMUR WUNI RT 02 RW 07', '3', '800000', '1', '2', '3', 'C2', '-6.764', '108.545', '2', '11-04-2021-17-20-5107-12-2020-06-54-5507-12-2020-06-41-4515-08-2020-14-01-32png-transparent-muslim-graphy-illustration-islamists-child-boy-cartoon-thumbnail.png', '11-04-2021-17-20-51'),
(13, 'AAT ADMIRAH', '089327401000100164', 'KOTA CIREBON, 07-08-1973', 'KEDUNG KRISIK RW 06 RT 05', '1', '1600000', '2', '3', '2', 'C2', '-6.765', '108.535', '2', '11-04-2021-17-22-0707-12-2020-06-50-1007-12-2020-06-41-4515-08-2020-14-01-32png-transparent-muslim-graphy-illustration-islamists-child-boy-cartoon-thumbnail.png', '11-04-2021-17-22-07'),
(14, 'ADE SANIRAH YUNI', '088327401017060134', 'KOTA CIREBON, 01-06-1985', 'JL AMD KEDUNG MENDENG RT 02 RW 003', '1', '2800000', '3', '1', '3', 'C3', '-6.764', '108.548', '2', '11-04-2021-17-24-5507-12-2020-06-50-1007-12-2020-06-41-4515-08-2020-14-01-32png-transparent-muslim-graphy-illustration-islamists-child-boy-cartoon-thumbnail.png', '11-04-2021-17-24-55'),
(15, 'ADIJAH', '081327401016001950', 'KOTA CIREBON, 02-05-1972', 'SURAPANDAN RT 002 RW 004 ARGASUNYA', '8', '900000', '1', '6', '1', 'C1', '-6.764', '108.530', '2', '11-04-2021-17-26-5107-12-2020-06-54-5507-12-2020-06-41-4515-08-2020-14-01-32png-transparent-muslim-graphy-illustration-islamists-child-boy-cartoon-thumbnail.png', '11-04-2021-17-26-51'),
(16, 'ADMI', '087327401000100879', 'KOTA CIREBON, 02-05-1972', 'SURAPANDAN RT 002 RW 004 ARGASUNYA', '4', '1500000', '2', '7', '1', 'C1', '-6.763', '108.536', '2', '11-04-2021-17-28-4512-08-2020-07-43-0711-08-2020-11-24-5125-07-2020-16-47-14man.png07-03-2020-13-44-48.png', '11-04-2021-17-28-45');

-- --------------------------------------------------------

--
-- Struktur dari tabel `datapkh`
--

CREATE TABLE `datapkh` (
  `id` int(11) NOT NULL,
  `nama` text NOT NULL,
  `ttl` text NOT NULL,
  `alamat` text NOT NULL,
  `kriteriawarga` text NOT NULL,
  `kode_kriteriawarga` text NOT NULL,
  `kriteriapkh` text NOT NULL,
  `kode_kriteriapkh` text NOT NULL,
  `tanggal` text NOT NULL,
  `lat` text NOT NULL,
  `lng` text NOT NULL,
  `partner` text NOT NULL,
  `poto` text NOT NULL,
  `hp` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `datapkh`
--

INSERT INTO `datapkh` (`id`, `nama`, `ttl`, `alamat`, `kriteriawarga`, `kode_kriteriawarga`, `kriteriapkh`, `kode_kriteriapkh`, `tanggal`, `lat`, `lng`, `partner`, `poto`, `hp`) VALUES
(22, 'Aam Aminah', 'Cirebon, 16 Maret 2002', 'Jl. Menjangan Putra', 'Kurang Mampu', '2', '', '6', '15-08-2020-13-54-14', '-6.764', '108.540', '3', '15-08-2020-13-54-14png-transparent-muslim-graphy-illustration-islamists-child-boy-cartoon-thumbnail.png', '08944754196'),
(23, 'Ani Maryani', 'Cirebon, 1 Maret 1978', 'Jl. Sulawesi', 'Kurang Mampu', '2', '', '1', '15-08-2020-14-01-32', '-6.761', '108.543', '2', '15-08-2020-14-01-32png-transparent-muslim-graphy-illustration-islamists-child-boy-cartoon-thumbnail.png', '0894475241'),
(24, 'Muhammad Hasan', 'Cirebon, 1 Juli 1923', 'Jl. Karya Bhakti', 'Kurang Mampu', '2', '', '7', '15-08-2020-14-03-25', '-6.765', '108.544', '2', '15-08-2020-14-03-25tua.png', '08972341526');

-- --------------------------------------------------------

--
-- Struktur dari tabel `datawarga`
--

CREATE TABLE `datawarga` (
  `id` int(11) NOT NULL,
  `nama` text NOT NULL,
  `ttl` text NOT NULL,
  `alamat` text NOT NULL,
  `penghasilan` text NOT NULL,
  `partner` text NOT NULL,
  `poto` text NOT NULL,
  `tanggal` text NOT NULL,
  `lat` text NOT NULL,
  `lng` text NOT NULL,
  `hp` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `datawarga`
--

INSERT INTO `datawarga` (`id`, `nama`, `ttl`, `alamat`, `penghasilan`, `partner`, `poto`, `tanggal`, `lat`, `lng`, `hp`) VALUES
(6, 'Ahmad Jalaluddin Rabbany', 'Cirebon, 30 Juni 1997', 'Jl. Dwi Pantara', '10000000', '3', '15-08-2020-13-49-4725-07-2020-16-47-14man.png07-03-2020-13-44-48.png', '15-08-2020-13-49-47', '-6.761', '108.545', '089619669223');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `nama` text NOT NULL,
  `hp` text NOT NULL,
  `alamat` text NOT NULL,
  `poto` text NOT NULL,
  `role` text NOT NULL,
  `status` int(11) NOT NULL,
  `tanggal` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `nama`, `hp`, `alamat`, `poto`, `role`, `status`, `tanggal`) VALUES
(2, 'ahmadjalaluddinrabbany@gmail.com', 'ayampelung485617', 'Ahmad Jalaluddin Rabbany', '089619669223', 'Argasunya, Cirebon', 'order.png07-03-2020-12-14-02.png', 'admin', 1, ''),
(3, 'jalaluddinrabbany@gmail.com', 'ayampelung485617', 'Ahmad Jalaluddin Rabbany', '089619669223', 'Jl. Dwi Pantara', '15-08-2020-13-47-0125-07-2020-16-47-14man.png07-03-2020-13-44-48.png', 'partner', 1, '15-08-2020 13:47:01');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `data`
--
ALTER TABLE `data`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `datakmeanspkh`
--
ALTER TABLE `datakmeanspkh`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `datapkh`
--
ALTER TABLE `datapkh`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `datawarga`
--
ALTER TABLE `datawarga`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `data`
--
ALTER TABLE `data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `datakmeanspkh`
--
ALTER TABLE `datakmeanspkh`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `datapkh`
--
ALTER TABLE `datapkh`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `datawarga`
--
ALTER TABLE `datawarga`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
