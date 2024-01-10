-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Jan 2024 pada 12.30
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `si_fornitur`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `idadmin` int(10) UNSIGNED NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `namalengkap` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`idadmin`, `username`, `password`, `namalengkap`, `status`) VALUES
(1, 'admin', 'admin', 'Administrator', 'Aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggota`
--

CREATE TABLE `anggota` (
  `idanggota` int(11) NOT NULL,
  `email` varchar(255) NOT NULL DEFAULT '0',
  `password` varchar(255) NOT NULL DEFAULT '0',
  `nama` varchar(255) NOT NULL DEFAULT '0',
  `jk` varchar(15) NOT NULL DEFAULT '0',
  `tgllahir` date DEFAULT NULL,
  `alamat` text NOT NULL,
  `nohp` varchar(12) NOT NULL DEFAULT '',
  `tgldaftar` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `anggota`
--

INSERT INTO `anggota` (`idanggota`, `email`, `password`, `nama`, `jk`, `tgllahir`, `alamat`, `nohp`, `tgldaftar`) VALUES
(2, 'rocky@gmail.com', 'rocky', 'Rocky Rahmad', 'L', '2023-09-01', 'Padang', '0812918271', '2023-09-08 21:27:45'),
(3, 'gadangjam97@gmail.com', 'qwerty', 'Jhon Chena', 'L', '1998-12-12', 'Siak', '081291827128', '2023-09-19 13:24:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cart`
--

CREATE TABLE `cart` (
  `idcart` int(11) NOT NULL,
  `idproduk` int(11) NOT NULL DEFAULT 0,
  `idanggota` int(11) NOT NULL DEFAULT 0,
  `jumlahbeli` int(11) NOT NULL DEFAULT 0,
  `tglcart` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `cart`
--

INSERT INTO `cart` (`idcart`, `idproduk`, `idanggota`, `jumlahbeli`, `tglcart`) VALUES
(16, 11, 1, 1, '2023-09-12 13:09:38'),
(21, 5, 2, 1, '2023-12-17 08:21:32');

-- --------------------------------------------------------

--
-- Struktur dari tabel `info`
--

CREATE TABLE `info` (
  `id` int(11) NOT NULL,
  `info` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `info`
--

INSERT INTO `info` (`id`, `info`) VALUES
(1, '<p><strong>Informasi</strong>, <strong>penerangan</strong>, atau <strong>embaran</strong> adalah pesan (ucapan atau ekspresi) atau kumpulan pesan yang terdiri dari <a href=\"https://id.wikipedia.org/w/index.php?title=Teori_Order&amp;action=edit&amp;redlink=1\">order</a> <a href=\"https://id.wikipedia.org/w/index.php?title=Sekuens&amp;action=edit&amp;redlink=1\">sekuens</a> dari <a href=\"https://id.wikipedia.org/wiki/Simbol\">simbol</a>, atau makna yang dapat ditafsirkan dari pesan atau kumpulan pesan. Informasi dapat direkam atau ditransmisikan. Hal ini dapat dicatat sebagai tanda-tanda, atau sebagai <a href=\"https://id.wikipedia.org/wiki/Sinyal\">sinyal</a> berdasarkan <a href=\"https://id.wikipedia.org/wiki/Gelombang\">gelombang</a>. Informasi adalah jenis acara yang mempengaruhi suatu negara dari <a href=\"https://id.wikipedia.org/wiki/Sistem_dinamis\">sistem dinamis</a>. Para konsep memiliki banyak arti lain dalam konteks yang berbeda. Informasi bisa dikatakan sebagai pengetahuan yang didapatkan dari pembelajaran, pengalaman, atau instruksi. Informasi telah digunakan untuk seluruh segi kehidupan manusia secara individual, kelompok maupun organisasi. Pada tingkat individu, informasi digunakan untuk pengetahuan tentang pendidikan, kesehatan, lapangan pekerjaan maupun jenis produk atau jasa. Kegunaan informasi ditentukan oleh tujuan pengguna, ketelitian pengolahan data, ruang dan waktu serta bentuk dan keadaan semantik.</p>');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `idkat` int(11) NOT NULL,
  `namakat` varchar(255) NOT NULL DEFAULT '0',
  `ketkat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`idkat`, `namakat`, `ketkat`) VALUES
(1, 'Baju Laki-Laki', 'Menjual Baju Laki-Laki'),
(2, 'Baju Wanita', 'Menajua Baju Wanita'),
(5, 'Sepatu Pria', 'Menjual Sepatu Pria'),
(6, 'Sepatu Wanita', 'Menjual Sepatu Wanita'),
(7, 'Topi Pria', 'Menjual Topi Pria'),
(8, 'Topi Wanita', 'Menjual Topi Wanita');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kota_kirim`
--

CREATE TABLE `kota_kirim` (
  `idorder` int(11) NOT NULL,
  `prov` varchar(100) NOT NULL,
  `tipe` varchar(100) NOT NULL,
  `kota` varchar(100) NOT NULL,
  `kode` varchar(100) NOT NULL,
  `ekspedisi` varchar(100) NOT NULL,
  `paket` varchar(100) NOT NULL,
  `bayar` int(11) NOT NULL,
  `estimasi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kota_kirim`
--

INSERT INTO `kota_kirim` (`idorder`, `prov`, `tipe`, `kota`, `kode`, `ekspedisi`, `paket`, `bayar`, `estimasi`) VALUES
(1, 'Kalimantan Timur', 'Kota', 'Samarinda', '75133', 'POS INDONESIA', 'Pos Reguler', 63000, '6 HARI'),
(2, 'Lampung', 'Kabupaten', 'Lampung Selatan', '35511', 'POS INDONESIA', 'Pos Reguler', 39000, '6 HARI'),
(3, 'Maluku', 'Kota', 'Tual', '97612', 'JNE', 'OKE', 94000, '5-7'),
(4, 'Kalimantan Utara', 'Kabupaten', 'Malinau', '77511', 'JNE', 'REG', 101000, '3-5'),
(5, 'Sulawesi Barat', 'Kabupaten', 'Majene', '91411', 'POS INDONESIA', 'Pos Reguler', 63000, '6 HARI'),
(6, 'Sumatera Barat', 'Kota', 'Padang', '25112', 'JNE', 'CTCYES', 11000, '1-1'),
(7, 'Bengkulu', 'Kota', 'Bengkulu', '38229', 'JNE', 'OKE', 29000, '3-4'),
(8, 'Sumatera Barat', 'Kota', 'Pariaman', '25511', 'JNE', 'YES', 13000, '1-1'),
(9, 'Sumatera Barat', 'Kota', 'Solok', '27315', 'JNE', 'REG', 11000, '3-5');

-- --------------------------------------------------------

--
-- Struktur dari tabel `masuk`
--

CREATE TABLE `masuk` (
  `idlogin` int(11) NOT NULL,
  `idanggota` int(11) NOT NULL DEFAULT 0,
  `banyak` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `masuk`
--

INSERT INTO `masuk` (`idlogin`, `idanggota`, `banyak`) VALUES
(1, 1, 3),
(2, 2, 2),
(3, 3, 2),
(4, 4, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `orderdetail`
--

CREATE TABLE `orderdetail` (
  `idorder` int(11) NOT NULL,
  `idproduk` int(11) NOT NULL,
  `jumlahbeli` int(11) NOT NULL,
  `subtotal` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `orderdetail`
--

INSERT INTO `orderdetail` (`idorder`, `idproduk`, `jumlahbeli`, `subtotal`) VALUES
(1, 9, 2, 152000),
(1, 11, 4, 601920),
(1, 12, 3, 203700),
(2, 12, 1, 67900),
(3, 11, 1, 150480),
(4, 11, 1, 150480),
(5, 11, 1, 150480),
(6, 11, 1, 150480),
(6, 13, 2, 43120),
(7, 12, 3, 203700),
(7, 13, 3, 64680),
(7, 7, 3, 213750),
(8, 8, 10, 336600),
(8, 5, 5, 370500),
(9, 13, 10, 215600),
(9, 7, 1, 71250);

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `idorder` int(11) NOT NULL,
  `noorder` double NOT NULL,
  `idanggota` int(11) NOT NULL,
  `alamatkirim` text NOT NULL,
  `total` double NOT NULL,
  `tglorder` datetime DEFAULT NULL,
  `statusorder` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `orders`
--

INSERT INTO `orders` (`idorder`, `noorder`, `idanggota`, `alamatkirim`, `total`, `tglorder`, `statusorder`) VALUES
(1, 20230908131458, 1, 'asd', 2198742, '2023-09-08 20:14:58', 'Baru'),
(2, 20230908132010, 1, 'sdsadas', 155302, '2023-09-08 20:20:10', 'Baru'),
(3, 20230908132352, 1, 'dadasdas', 347962, '2023-09-08 20:23:52', 'Baru'),
(4, 20230908132617, 1, 'qweqweqw', 351462, '2023-09-08 20:26:17', 'Baru'),
(5, 20230908132815, 1, 'eqweqweqweqwe', 332462, '2023-09-08 20:28:15', 'Diterima'),
(6, 20230908143036, 2, 'Taluak Bayua', 403702, '2023-09-08 21:30:36', 'Diterima'),
(7, 20230910143316, 1, 'bali', 1094762, '2023-09-10 21:33:16', 'Baru'),
(8, 20230919082740, 3, 'Jln. Jendral Sudirman', 1485852, '2023-09-19 13:27:40', 'Diterima'),
(9, 20230920060035, 4, 'padang', 634202, '2023-09-20 11:00:35', 'Baru');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `idbayar` int(11) NOT NULL,
  `idorder` int(11) NOT NULL,
  `namabankpengirim` varchar(50) NOT NULL,
  `namapengirim` varchar(50) NOT NULL,
  `jumlahtransfer` double NOT NULL,
  `tgltransfer` date DEFAULT NULL,
  `namabankpenerima` varchar(50) NOT NULL,
  `bukti` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`idbayar`, `idorder`, `namabankpengirim`, `namapengirim`, `jumlahtransfer`, `tgltransfer`, `namabankpenerima`, `bukti`) VALUES
(1, 5, 'Jhon', 'BRI', 332462, '2023-09-08', 'Website', '6-Berhasil.jpg'),
(2, 6, 'BRI', 'Rocky Rahmad', 403702, '2023-09-08', 'Website', '6-Berhasil.jpg'),
(3, 8, 'BRK', 'Jhon', 1485852, '2023-09-19', 'Website', '6-Berhasil.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `idproduk` int(11) NOT NULL,
  `idkat` int(11) NOT NULL DEFAULT 0,
  `nama` varchar(255) NOT NULL DEFAULT '0',
  `harga` double NOT NULL DEFAULT 0,
  `diskon` int(11) NOT NULL DEFAULT 0,
  `berat` float NOT NULL DEFAULT 0,
  `stok` int(11) NOT NULL DEFAULT 0,
  `detail` text NOT NULL,
  `foto` text NOT NULL,
  `tgl_produk` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`idproduk`, `idkat`, `nama`, `harga`, `diskon`, `berat`, `stok`, `detail`, `foto`, `tgl_produk`) VALUES
(4, 1, 'Kemeja PDL Lengan Pendek', 114750, 2, 0.05, 100, '<p>Kemeja yang kami produksi menggunakan kualitas terbaik, hasil dari kurasi tim Bikin.co. Kemeja custom dengan bahan dan kualitas terbaik, cocok untuk melengkapi kegiatan kamu sehari hari baik untuk acara indoor maupun outdoor.&nbsp;Kami juga menyediakan berbagai macam bahan kemeja yang bisa disesuaikan dengan kebutuhan.&nbsp;Hubungi CS kami untuk info lebih lanjut mengenai produksi kami.</p>', '-Konveksi-Baju-Kemeja-Lengan-Pendek-1.jpg', '2023-09-07 10:24:32'),
(5, 2, 'Kemeja Wanita NATUSHA SHIRT ', 78000, 5, 0.05, 95, '<p>Bahan Toyobo<br>Busui Friendly Kancing Hidup<br>Lingkar Dada 110 cm<br>Panjang Tangan 56 cm<br>Panjang Baju 62 cm<br>Berat Produk 200 Gram<br>Pilihan Warna Blue Pink Mocca</p>', '-5005f7d6-6a67-4a01-b5a4-066723bad09d.jpg', '2023-09-07 11:11:47'),
(7, 6, 'Sepatu Sneakers', 75000, 5, 0.5, 96, '<p>•Warna : Hitam dan Putih<br>•Tinggi Sol : 2 cm<br>• Bahan :<br>- Putih = Sintetis<br>- Hitam = Kanvas<br><br>•PROSEDUR PENGIRIMAN :<br>- Setiap hari MINGGU TIDAK ADA PENGIRIMAN (orderan masuk di hari Minggu dikirimkan hari Senin).<br>-Setiap orderan yang masuk melewati pukul 13.00 WIB , akan MASUK PENGIRIMAN BESOKNYA.<br><br>•NB:Barang yang sudah dibeli artinya tidak dapat dikembalikan/ditukar lagi, barang dapat dikembalikan/ditukar apabila terjadi kesalahan toko dalam mengirim barang yang tidak sesuai dengan pesanan.</p>', 'Sepatu Sneakers-casual1.jpeg', '2023-09-08 15:17:20'),
(8, 5, 'Sneakers NEO NEW', 34000, 1, 0.5, 90, '<ul><li>Kondisi: Baru</li><li>Min. Pemesanan: 1 Buah</li><li>Etalase: <a href=\"https://www.tokopedia.com/ambar-shoes/etalase/all\"><strong>Semua Etalase</strong></a></li></ul><p>No Brand<br>Stock Ready<br>Bahan kampas<br>Motif Sablon Tidak Mudah Luntur<br>Sol Bawah Tidak Licin<br>Size 39-43<br>Warna :Abu,Merah.Hitam<br>Paking pakai Dus<br>Bisa Bayar Di Tempat</p>', 'Sneakers NEO NEW-cek.jpg', '2023-09-08 15:19:29'),
(9, 2, 'Baju Kemeja Laura Shirt Termurah - Mustard', 80000, 5, 0.5, 98, '<ul><li>Kondisi: Baru</li><li>Min. Pemesanan: 1 Buah</li><li>Etalase: <a href=\"https://www.tokopedia.com/suryastore/etalase/baju-wanita\"><strong>Baju Wanita</strong></a></li></ul><p>Kemeja super nyaman nih ! Jgn lupa cepet di cekout mumpung masih awal bulan 😆, kepake bgt buat daily wear bisa dijadiin inner juga ga sih di mixmatch sm blazer lucu kan 😍 ada 6 varian warna 👌🏻<br>.<br>Laura Shirt<br>Colour : bw, cream, grey, black, mustard, navy<br>.<br>Material : wolpis premium<br>Size : All size fit L<br>Lingkar dada : 100cm<br>Panjang blouse : depan 60cm , belakang 70cm<br>Read Caption Sebelum Order 👌<br><br>KHUSUS PENGIRIMAN SI CEPAT YA KAK🙏😊</p>', '-BAJU WAN.jpg', '2023-09-08 15:22:33'),
(10, 2, 'BAJU KEMEJA WANITA / TAMI TOP / KEMEJA KOREA - Denim', 85000, 5, 1, 100, '<ul><li>Kondisi: Baru</li><li>Min. Pemesanan: 1 Buah</li><li>Etalase: <a href=\"https://www.tokopedia.com/shalsabillastore/etalase/all\"><strong>Semua Etalase</strong></a></li></ul><p><br>Bahan : moshcrape<br>Warna : denim, dusty, dan mocca<br>Ukuran : Allsize fit to L<br>L : Ld 100 cm Pb 60 cm<br><br><br>WELCOME RESELLER &amp; DROPSHIPER<br><br>Dapatkan Banyak Keuntungan Dengan Begabung Menjadi RESELLER &amp; DROPSHIP di Toko Kami<br>- Mudah , Tanpa syarat Apapun<br>- Jaminan Harga Temurah<br>- Kualitas Barang Baik<br>Untuk Bergabung Silahkan Langsung Chat Dan Pesan Segera</p>', '-BAJ.png', '2023-09-08 15:25:04'),
(11, 1, 'Kemeja Flannel Pria Lengan Panjang Kotak Kotak Premium Branded Distro', 158400, 5, 0.5, 92, '<p><strong>Deskripsi</strong></p><p>PENTING UNTUK DI BACA !!!</p><p>Next Inspiration - The Greatest Inspiration For You.</p><p>We are here to provide the best inspiration for you every day.<br>We believe our product and services will make you have a great experience.</p><p>Kemeja Flannel merupakan salah satu outfit pria yang timeless dan selalu kekinian. Dengan stylenya yang bisa dipakai dengan 2 mode; full kancing dan lepas kancing, membuat kemeja flannel ini cocok digunakan untuk acara santai, nongkrong bersama teman ataupun acara semi-formal.</p><p>Kemeja Flannel - Red Collection memiliki 4 pattern yang bisa kalian pilih sesuai selera kalian. Stock terbatas, karena bahan tidak selalu sama dan tidak selalu ready di pasaran.</p>', '-ASD.jpg', '2023-09-08 15:31:54'),
(12, 7, 'Creart Concept Casual Look Topi Pria', 70000, 3, 0.5, 93, '<p><strong>Deskripsi Produk</strong></p><p>Aksesoris topi berkualitas untuk menambah penampilan semakin trendi. Terbuat dari material berkualitas akan nyaman saat dipakai sepanjang hari.</p><p>Size chart: (Lingkar kepala)<br>F = 54 cm</p><p>Toleransi ukuran hingga (-/+) 2 cm</p>', '-28062660_1.webp', '2023-09-08 15:39:47'),
(13, 8, 'BUCKET SMILE', 22000, 2, 0.5, 90, '<ul><li>Kondisi: Baru</li><li>Min. Pemesanan: 1 Buah</li><li>Etalase: <a href=\"https://www.tokopedia.com/rny-baby/etalase/topi-distro-kombinasi\"><strong>TOPI DISTRO KOMBINASI</strong></a></li></ul><p>TOPI BUCKET BORDIR SMILE PRODUK BUATAN INDONESIA KARYA ANAK BANGSA✅ Ready Stock Dan Dikirim dalam waktu 24jam !✅ Dropship/Reseller/Wholesale are welcome !✅ Ikuti kami untuk info DISKON dan BARANG BARU ! FOTO HASIL JEPRET SENDIRI 100% REAL PIC Rincian produk -jenis topi : bucket (pria/wanita)-material :American Dril- satu topi 2 kombinasi warna (bagian dalam dan luar berbeda warnanya)-metode jahit DOUBLE STICK jadi bagian dalam dan luar sama bisa dipakai bolak-balik - detail bordir tebal dan rapi Catatan kepada calon pembeli :⚠ TIDAK MENERIMA SISIPAN WARNA VIA CHAT⚠ ORDER SESUAI VARIASI WARNA YANG DIINGINKAN.⚠ Jangan Lupa Baca Peraturan Toko-Maksimal transfer adalah dua hari setelah pemesanan karena stok bisa berubah dan untuk meminimalisir pembatalan pesanan otomatis oleh sistem :)Mohon kerja samanya ya kak :)</p>', '-QWE.jpg', '2023-09-08 15:43:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `resi`
--

CREATE TABLE `resi` (
  `idresi` int(11) NOT NULL,
  `idorder` int(11) NOT NULL,
  `resi` varchar(100) NOT NULL,
  `tglresi` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `resi`
--

INSERT INTO `resi` (`idresi`, `idorder`, `resi`, `tglresi`) VALUES
(1, 6, '000148003628', '2023-09-09 08:59:39'),
(2, 5, '0098789987', '2023-09-10 21:36:43'),
(3, 8, 'MAJ19281KAL1', '2023-09-19 13:32:47');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`idadmin`);

--
-- Indeks untuk tabel `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`idanggota`);

--
-- Indeks untuk tabel `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`idcart`);

--
-- Indeks untuk tabel `info`
--
ALTER TABLE `info`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`idkat`);

--
-- Indeks untuk tabel `kota_kirim`
--
ALTER TABLE `kota_kirim`
  ADD PRIMARY KEY (`idorder`);

--
-- Indeks untuk tabel `masuk`
--
ALTER TABLE `masuk`
  ADD PRIMARY KEY (`idlogin`);

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`idorder`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`idbayar`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`idproduk`);

--
-- Indeks untuk tabel `resi`
--
ALTER TABLE `resi`
  ADD PRIMARY KEY (`idresi`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `idadmin` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `anggota`
--
ALTER TABLE `anggota`
  MODIFY `idanggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `cart`
--
ALTER TABLE `cart`
  MODIFY `idcart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `info`
--
ALTER TABLE `info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `idkat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `kota_kirim`
--
ALTER TABLE `kota_kirim`
  MODIFY `idorder` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `masuk`
--
ALTER TABLE `masuk`
  MODIFY `idlogin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `idorder` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `idbayar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `idproduk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `resi`
--
ALTER TABLE `resi`
  MODIFY `idresi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
