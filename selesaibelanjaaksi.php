<?php

$sqlc = mysqli_query($kon, "SELECT * from cart  where idanggota='$_POST[idag]'");
while ($rc = mysqli_fetch_array($sqlc)) {
    $isikeranjang[] = $rc;
    $jml = count($isikeranjang);
}

$tgl = date("d");
$bln = date("m");
$thn = date("Y");
$jam = date("H");
$mnt = date("i");
$dtk = date("s");

mysqli_query($kon, "INSERT into orders (noorder, idanggota, alamatkirim, total, tglorder, statusorder) values ('$thn$bln$tgl$jam$mnt$dtk', '$_POST[idag]', '$_POST[alamatkirim]', '0',NOW(), 'Baru')");
$idorder = mysqli_insert_id($kon);
mysqli_query($kon, "INSERT into kota_kirim (idorder, prov, tipe, kota, kode, ekspedisi, paket, bayar, estimasi) values
  ('$idorder','$_POST[prov]','$_POST[tipe]','$_POST[kota]','$_POST[kode]','$_POST[ekspedisi]','$_POST[paket]','$_POST[bayar]','$_POST[estimasi]')");


//Menghapus data dalam tabel Cart
for ($i = 0; $i < $jml; $i++) {
    mysqli_query($kon, "DELETE from cart where idcart={$isikeranjang[$i]['idcart']}");
}

// Merubah stok di tabel produk
for ($i = 0; $i < $jml; $i++) {
    $sqlp = mysqli_query($kon, "SELECT * from produk where idproduk='{$isikeranjang[$i]['idproduk']}'");
    $rp = mysqli_fetch_array($sqlp);
    $stok = $rp["stok"];
    $jumlahbeli = "{$isikeranjang[$i]['jumlahbeli']}";
    $stokakhir = $stok - $jumlahbeli;
    mysqli_query($kon, "UPDATE produk set stok='$stokakhir' where idproduk={$isikeranjang[$i]['idproduk']}");
}
?>
<div class="container mt-3 ">
    <div class="card shadow-lg">
        <div class="card-body">
            <div class="container mb-5 mt-3">
                <div class="row d-flex align-items-baseline">
                    <div class="col-xl-9">
                        <p style="color: #7e8d9f;font-size: 20px;">NO. ORDER <strong>#<?php echo "$thn$bln$tgl$jam$mnt$dtk" ?></strong>
                            <span class="badge bg-warning text-black fw-bold">
                                Baru
                            </span>
                        </p>
                    </div>
                </div>
                <hr>
                <div class="container">

                    <div class="row">
                        <div class="col-xl-8">
                            <ul class="list-unstyled">
                                <li class="text-muted">Nama: <span><?= $_POST['nama']; ?></span></li>
                                <li class="text-muted">Alamat : <?= $_POST['alamatkirim']; ?>, </li>
                                <li class="text-muted">Provinsi <?= $_POST['tipe']; ?>, <?= $_POST['tipe']; ?> <?= $_POST['kota']; ?> (<?= $_POST['kode']; ?>)</li>
                                <li class="text-muted"><i class="fa fa-phone-square" aria-hidden="true"></i> <?= $_POST['nohp']; ?></li>
                                <li class="text-muted"><i class="fa fa-envelope" aria-hidden="true"></i><?= $_POST['email']; ?></li>
                            </ul>
                        </div>
                        <div class="col-xl-4">
                            <p class="text-muted">Ekspedisi Pengiriman</p>
                            <ul class="list-unstyled">
                                <li class="text-muted">Nama : <span><?= $_POST['ekspedisi']; ?></span></li>
                                <li class="text-muted">Jenis : <span><?= $_POST['paket']; ?> ( <?= $_POST['estimasi']; ?> Hari )</span></li>
                                <li class="text-muted">Harga : <span><?= formatRupiah($_POST['bayar']); ?> / Kg</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="mt-3">
                        <center>
                            <h4>Produk Yang Dibeli :</h4>
                        </center>
                        <hr style="border-top: 3px double #8c8b8b;">
                    </div>
                    <?php
                    for ($i = 0; $i < $jml; $i++) {
                        $no = $i + 1;
                        $sqlp = mysqli_query($kon, "SELECT * from produk where idproduk = {$isikeranjang[$i]['idproduk']}");
                        $rp = mysqli_fetch_array($sqlp);
                        $disk = ($rp['diskon'] * $rp['harga']) / 100;
                        $hrgbaru = $rp['harga'] - $disk;
                        $subtotal = "{$isikeranjang[$i]['jumlahbeli']}" * $hrgbaru;
                        $tot = $tot + $subtotal;
                        $brt = "{$isikeranjang[$i]['jumlahbeli']}" * $rp["berat"];
                        $berat = $berat + $brt;
                        $st = formatRupiah($subtotal);
                        $hrg = formatRupiah($rp["harga"]);
                        $hrgbr = formatRupiah($hrgbaru);
                        if ($rp['diskon'] > 0) {
                            $diskon = "<font color='red'>-$rp[diskon]% </font>";
                            $hrglama = "<font style='text-decoration:line-through'>" . $hrg . "</font>";
                        } else {
                            $diskon = "";
                            $hrglama = "";
                        }

                        if (!empty($rp["foto"])) {
                            $foto = "assets/img/produk/$rp[foto]";
                        } else {
                            $foto = "fotoproduk/avatar.png";
                        } ?>
                        <div class="row my-2 mx-1 justify-content-center">
                            <div class="col-md-2 mb-4 mb-md-0">
                                <div class="bg-image ripple rounded-5 mb-4 overflow-hidden d-block" data-ripple-color="light">
                                    <img src="<?= $foto ?>" class="w-100" height="100px" alt="Elegant shoes and shirt" />
                                    <a href="#!">
                                        <div class="hover-overlay">
                                            <div class="mask" style="background-color: hsla(0, 0%, 98.4%, 0.2)"></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-7 mb-4 mb-md-0">
                                <p class="fw-bold"><?= $rp['nama']; ?></p>
                                <p>
                                    <span class="text-muted me-2">Banyak :</span><span><?= "<big>{$isikeranjang[$i]['jumlahbeli']} Unit</big>"; ?></span><br>
                                    <span class="text-muted me-2">Diskon :</span><span><?= $hrglama ?> <?= $diskon; ?> <?= $hrgbr ?></span>
                                </p>
                            </div>
                            <div class="col-md-3 mb-4 mb-md-0 text-end">
                                <br>
                                <h5 class="mt-5">
                                    <span class="align-middle">Total : <?= $st ?></span>
                                </h5>
                            </div>
                        </div>
                    <?php
                        mysqli_query($kon, "INSERT into orderdetail (idorder, idproduk, jumlahbeli, subtotal) values ('$idorder', {$isikeranjang[$i]['idproduk']}, {$isikeranjang[$i]['jumlahbeli']}, '$subtotal')");
                    }
                    $tarif = $berat * $_POST['bayar'];
                    $total = $tot + $tarif;
                    ?>
                    <hr>
                    <div class="row">
                        <div class="col-xl-8">
                            <p class="ms-3">Tambahkan catatan tambahan dan informasi pembayaran</p>
                            <p class="text-muted ms-3">Transfer</p>
                            <ul class="list-unstyled ms-3">
                                <li class="text-muted">Nama Bank : <span>BRI (Website)</span></li>
                                <li class="text-muted">Norek : <span>1234567890</span></li>
                            </ul>
                        </div>
                        <div class="col-xl-4 text-end">
                            <ul class="list-unstyled">
                                <li class="text-muted ms-3"><span class="text-black me-4">Total Berat :</span><?= $berat; ?> Kg</li>
                                <li class="text-muted ms-3 mt-2"><span class="text-black me-4">Tarif Kirim : </span><?= formatRupiah($tarif) ?></li>
                            </ul>
                            <p class="text-black text-end"><span class="text-black me-3"> Jumlah Total : </span><span style="font-size: 25px;"><?= formatRupiah($total) ?></span></p>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            // Update data total
            mysqli_query($kon, "UPDATE orders set total='$total' where idorder='$idorder'");
            ?>
            <div align="right">
                <a href="javascript:window.print()">
                    <button type='button' class='btn btn-primary'>Cetak Faktur</button>
                </a>
            </div>
        </div>
    </div>
</div>
<br>