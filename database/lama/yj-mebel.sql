-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Jul 2020 pada 03.59
-- Versi server: 10.1.31-MariaDB
-- Versi PHP: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yj-mebel`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_produk`
--

CREATE TABLE `kategori_produk` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL,
  `keterangan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategori_produk`
--

INSERT INTO `kategori_produk` (`id_kategori`, `nama_kategori`, `keterangan`) VALUES
(1, 'meja', 'aneka jenis meja'),
(2, 'Lemari', 'Lemari yang terbuat dari kayu jati'),
(3, 'Kursi', 'Kursii yang terbuat dari kayu jati'),
(4, 'Ranjang', 'Ranjang dari Kayu'),
(7, 'Kitchen Set', 'Peralatan dapur'),
(8, 'Set Pintu', 'Set Pintu dan Jendela');

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporan_penjualan`
--

CREATE TABLE `laporan_penjualan` (
  `id_laporan` int(11) NOT NULL,
  `id_penjualan` int(11) NOT NULL,
  `modal` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_barang` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `keterangan` text NOT NULL,
  `harga` varchar(15) NOT NULL,
  `gambar` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_barang`, `id_kategori`, `nama_barang`, `keterangan`, `harga`, `gambar`) VALUES
(7, 2, 'Almari Alumunium', 'Almari 2 sekat', '500000', 'kt-almari.jpg'),
(8, 4, 'Tempat Tidur ', 'Dengan ukiran wajah orangnya', '2000000', 'kt-ranjang.jpg'),
(10, 3, 'Sofa Busa', 'Bisa ditambah double busa biar empuk', '2000000', 'kt-sofabusa.jpg'),
(11, 1, 'Meja Makan', 'Meja Makan Unik Sekali', '3000000', 'kt-mejatv.jpg'),
(16, 4, 'Set Meja', 'Set Meja dan Kursi dengan ukuran bisa custom', '2500000', 'setmeja.jpg'),
(17, 3, 'Meja Teras', 'Meja teras untuk bersantai bersama keluarga', '200000', 'kt-mejamakan.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `username`, `password`) VALUES
(1, 'Admin', '1234'),
(2, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_customer`
--

CREATE TABLE `tb_customer` (
  `id_cust` int(11) NOT NULL,
  `username_cust` varchar(20) NOT NULL,
  `password_cust` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `telepon` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_customer`
--

INSERT INTO `tb_customer` (`id_cust`, `username_cust`, `password_cust`, `nama`, `alamat`, `telepon`) VALUES
(1, 'maha', 'maha', 'maha', 'Malang', '628564923432'),
(12, 'agus', 'fdf169558242ee051cca1479770ebac3', 'agus', 'mlg', '62896747679'),
(13, 'raisa', '4b8ed057e4f0960d8413e37060d4c175', 'raisa', 'malang', '628967896752'),
(14, 'maharani', '06e3e081e1aa695794835cdd6a62ea1e', 'maha', 'Malang', '628457979087'),
(15, 'iya', '00e11252db1051387c47521767296b42', 'iya', 'Malang', '628970968590'),
(16, 'dimas', '7d49e40f4b3d8f68c19406a58303f826', 'Dimas', 'Jakarta', '62768978564');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_pembayaran`
--

CREATE TABLE `transaksi_pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_penjualan` int(11) NOT NULL,
  `tgl_bayar` datetime NOT NULL,
  `nominal` varchar(25) NOT NULL,
  `bukti_tf` text NOT NULL,
  `status` enum('LUNAS','BELUM LUNAS') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `transaksi_pembayaran`
--

INSERT INTO `transaksi_pembayaran` (`id_pembayaran`, `id_penjualan`, `tgl_bayar`, `nominal`, `bukti_tf`, `status`) VALUES
(5, 48, '2020-07-15 00:00:00', '100000', 'upload/bayar/2fb7972b1153f40156836c8dba73ab27.png', 'BELUM LUNAS'),
(6, 48, '2020-07-16 00:00:00', '90000', 'upload/bayar/616251d46e2f9cf34a16daa9fca07152.png', 'BELUM LUNAS'),
(7, 48, '2020-07-17 00:00:00', '10000', 'upload/bayar/304cb40810efd97b6493c3e205ce376f.png', 'LUNAS'),
(8, 54, '2020-07-16 00:00:00', '78', 'upload/bayar/a93966fae5ed81224385317113d96ab3.jpeg', 'BELUM LUNAS'),
(9, 49, '2020-07-16 00:00:00', '1000000', 'upload/bayar/d4d3e235556fd1e104fca690b274507e.jpg', 'LUNAS'),
(10, 57, '2020-07-17 00:00:00', '2500000', 'upload/bayar/de50347a584056e05ee7c24804621ec2.jpg', 'LUNAS'),
(11, 56, '2020-07-17 00:00:00', '300000', 'upload/bayar/ba99a60043dd698c3c52019387e77e7f.jpg', 'BELUM LUNAS'),
(12, 55, '2020-07-17 00:00:00', '250000', 'upload/bayar/ca9ff1cce9327d7d1694e23b737e656a.jpg', 'BELUM LUNAS'),
(13, 56, '2020-07-18 00:00:00', '300000', 'upload/bayar/5dd8e6fdbfcaa15a4c7183ff997e77a5.jpg', 'LUNAS');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_penjualan`
--

CREATE TABLE `transaksi_penjualan` (
  `id_penjualan` int(11) NOT NULL,
  `id_cust` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `jenis` enum('SESUAI','CUSTOM') NOT NULL,
  `tgl_jual` date NOT NULL,
  `total_harga` varchar(15) NOT NULL,
  `status_pesanan` enum('Pesan','Sedang Diproses','Selesai','Dibatalkan') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `transaksi_penjualan`
--

INSERT INTO `transaksi_penjualan` (`id_penjualan`, `id_cust`, `id_barang`, `keterangan`, `jenis`, `tgl_jual`, `total_harga`, `status_pesanan`) VALUES
(55, 16, 7, 'ok ok', 'CUSTOM', '2020-07-16', '500000', 'Sedang Diproses'),
(56, 15, 7, 'seminggu selesai ya', 'SESUAI', '2020-07-18', '500000', 'Selesai'),
(57, 15, 7, 'warna pink ya pak', '', '2020-07-18', '500000', 'Pesan'),
(58, 13, 7, 'warna pink ya pak', 'SESUAI', '2020-07-18', '500000', 'Pesan'),
(59, 15, 10, 'cepat ya pak', 'SESUAI', '2020-07-18', '2000000', 'Pesan');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `kategori_produk`
--
ALTER TABLE `kategori_produk`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `laporan_penjualan`
--
ALTER TABLE `laporan_penjualan`
  ADD PRIMARY KEY (`id_laporan`),
  ADD KEY `id_penjualan` (`id_penjualan`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indeks untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `tb_customer`
--
ALTER TABLE `tb_customer`
  ADD PRIMARY KEY (`id_cust`);

--
-- Indeks untuk tabel `transaksi_pembayaran`
--
ALTER TABLE `transaksi_pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indeks untuk tabel `transaksi_penjualan`
--
ALTER TABLE `transaksi_penjualan`
  ADD PRIMARY KEY (`id_penjualan`),
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `id_cust` (`id_cust`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `kategori_produk`
--
ALTER TABLE `kategori_produk`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `laporan_penjualan`
--
ALTER TABLE `laporan_penjualan`
  MODIFY `id_laporan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_customer`
--
ALTER TABLE `tb_customer`
  MODIFY `id_cust` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `transaksi_pembayaran`
--
ALTER TABLE `transaksi_pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `transaksi_penjualan`
--
ALTER TABLE `transaksi_penjualan`
  MODIFY `id_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
