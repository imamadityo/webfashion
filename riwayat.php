<div class="container mt-3">
    <h2 align="right">Riwayat Pembelian</h2>
    <hr style="border: 3px solid gray; border-radius: 5px;">
    <?php
    $sqlo = mysqli_query($kon, "SELECT * from orders where idanggota='$rag[idanggota]' order by tglorder desc");
    $no = 1;
    while ($ro = mysqli_fetch_array($sqlo)) {
        $sqlod = mysqli_query($kon, "SELECT * from orders where idorder='$ro[idorder]'");
        $rod = mysqli_fetch_array($sqlod);
        $sqlj = mysqli_query($kon, "SELECT * from kota_kirim where idorder='$ro[idorder]'");
        $rj = mysqli_fetch_array($sqlj);

        $res = mysqli_query($kon, "SELECT * from resi  where idorder='$ro[idorder]'");
        $row = mysqli_num_rows($res);
        $resi = mysqli_fetch_array($res);

        $sqlag = mysqli_query($kon, "SELECT * from anggota where idanggota='$rod[idanggota]'");
        $rag = mysqli_fetch_array($sqlag);
    ?>

        <div class="card mb-3">
            <div class="card-body shadow-lg">
                <div class="container">
                    <div class="row d-flex align-items-baseline">
                        <div class="col-xl-9">
                            <p style="color: #7e8d9f;font-size: 20px;">NO. ORDER <strong>#<?= $ro['noorder'] ?></strong>
                                <span class="badge bg-warning text-black fw-bold">
                                    <?= $ro['statusorder'] ?>
                                </span>
                            </p>
                        </div>
                    </div>
                    <hr>
                    <div class="container">

                        <div class="row">
                            <div class="col-xl-8">
                                <ul class="list-unstyled">
                                    <li class="text-muted">Nama: <span><?= $rag['nama']; ?></span></li>
                                    <li class="text-muted"><?= $rod['alamatkirim']; ?>, </li>
                                    <li class="text-muted">Provinsi <?= $rj['tipe']; ?>, <?= $rj['tipe']; ?> <?= $rj['kota']; ?> (<?= $rj['kode']; ?>)</li>
                                    <li class="text-muted"><i class="fa fa-phone-square" aria-hidden="true"></i> <?= $rag['nohp']; ?></li>
                                    <li class="text-muted"><i class="fa fa-envelope" aria-hidden="true"></i> <?= $rag['email']; ?></li>
                                </ul>
                            </div>
                            <div class="col-xl-4 text-end">
                                <p class="text-muted">Ekspedisi Pengiriman</p>
                                <ul class="list-unstyled">
                                    <li class="text-muted">Nama : <span><?= $rj['ekspedisi']; ?></span></li>
                                    <li class="text-muted">Jenis : <span><?= $rj['paket']; ?> ( <?= $rj['estimasi']; ?> Hari )</span></li>
                                    <li class="text-muted">Harga : <span><?= formatRupiah($rj['bayar']); ?> / Kg</span></li>
                                    <?php if ($row > 0) { ?>
                                        <li class="text-muted">Nomor Resi : <span class="badge text-light bg-success"><?= $resi['resi']; ?> </span></li>
                                    <?php } ?>

                                </ul>
                            </div>
                        </div>
                        <center>
                            <h4>Produk Yang Dibeli :</h4>
                        </center>
                        <div class="row">

                            <table class="table table-striped">
                                <thead class=" fw-bold">
                                    <tr>
                                        <td align="center">No</td>
                                        <td align="center">Nama Produk</td>
                                        <td align="center">Harga</td>
                                        <td align="center">Banyak</td>
                                        <td align="center">Berat</td>
                                        <td align="center">Total</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sqlordt = mysqli_query($kon, "SELECT * from orderdetail where idorder='$ro[idorder]'");
                                    $banyak = mysqli_num_rows($sqlordt);
                                    $no = 1;
                                    $tot = 0;
                                    while ($rordt = mysqli_fetch_array($sqlordt)) {
                                        $sqlpr = mysqli_query($kon, "SELECT * from produk where idproduk='$rordt[idproduk]'");
                                        $rpr = mysqli_fetch_array($sqlpr);
                                        $hrg = formatRupiah($rpr['harga']);
                                        $disk = ($rpr["harga"] * $rpr["diskon"]) / 100;
                                        $hargabaru = $rpr["harga"] - $disk;
                                        $hrgbr = formatRupiah($hargabaru);
                                        $brt = $rordt["jumlahbeli"] * $rpr["berat"];
                                        $berat = $berat + $brt;
                                        $jml = $hargabaru * $rordt["jumlahbeli"];
                                        if ($rp["diskon"] > 0) {
                                            $diskon = "<font color='red'>-$rp[diskon]%</font>";
                                            $hargalama = "<font style='text-decoration:line-through'>IDR $hrg</font>";
                                        } else {
                                            $diskon = "";
                                            $hargalama = "";
                                        }
                                        $tot += $jml;
                                    ?>
                                        <tr>
                                            <td align="center"><?= $no++ ?></td>
                                            <td><?= $rpr['nama'] ?></td>
                                            <td align="center"><?= $hrgbr ?></td>
                                            <td align="center"><?= $rordt['jumlahbeli'] ?> Unit</td>
                                            <td align="center"><?= $rpr['berat'] ?> Kg</td>
                                            <td align="right"><?= formatRupiah($jml) ?></td>
                                        </tr>
                                    <?php }
                                    $tarif = $berat * $rj['bayar'];
                                    $total = $tot + $tarif;
                                    ?>
                                </tbody>
                            </table>
                            <hr>
                        </div>

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
                                    <li class="text-muted ms-3"><span class="text-black me-4">Total Berat : </span><?= $berat; ?> Kg</li>
                                    <li class="text-muted ms-3 mt-2"><span class="text-black me-4">Tarif Kirim : </span><?= formatRupiah($tarif) ?></li>
                                </ul>
                                <p class="text-black text-end"><span class="text-black me-3"> Jumlah Total : </span><span style="font-size: 25px;"><?= formatRupiah($total) ?></span></p>
                            </div>


                        </div>
                        <br>
                        <?php if ($ro["statusorder"] == "Dikirim") { ?>
                            <center>
                                <a href="?p=konfir&id=<?= $ro['idorder'] ?>" class="btn btn-primary btn-sm mt-3">Konfirmasi Barang Telah</a>
                            </center>
                        <?php } else {
                        } ?>
                    </div>
                </div>
            </div>
        </div>

    <?php } ?>
</div>