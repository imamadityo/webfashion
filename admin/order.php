<?= pesan($_GET['alert']) ?>
<br>
<a href="?p=order&st=Semua"><button type="button" class="btn btn-primary">TRANSAKSI SEMUA</button></a>
Status Order :
<a href="?p=order&st=Baru"><button type="button" class="btn btn-primary">Baru</button> </a>
<a href="?p=order&st=Lunas"><button type="button" class="btn btn-primary">Lunas</button></a>
<a href="?p=order&st=Dikirim"><button type="button" class="btn btn-primary">Dikirim</button></a>
<a href="?p=order&st=Diterima"><button type="button" class="btn btn-primary">Diterima</button></a>

<div class="mt-3">
    <div class="col">
        <?php
        $nama_halaman = "order";
        $page = "order";
        $batas = 2;
        $order = isset($_GET['order']) ? (int)$_GET['order'] : 1;
        $order_awal = ($order > 1) ? ($order * $batas) - $batas : 0;

        $previous = $order - 1;
        $next = $order + 1;

        $data = mysqli_query($kon, "SELECT * from orders");
        $jumlah_data = mysqli_num_rows($data);
        $total_order = ceil($jumlah_data / $batas);

        if ($_GET["st"] == "Semua") {
            $status = "";
            $st = $_GET["st"];
        } else {
            $status = "where statusorder='$_GET[st]'";
            $st = "Semua";
        }
        $sqlo = mysqli_query($kon, "SELECT * from orders $status order by tglorder desc limit $order_awal, $batas");
        $no = 1;
        while ($ro = mysqli_fetch_array($sqlo)) {
            if ($ro['statusorder'] == "Baru") {
                $pilb = " selected";
                $pill = "";
                $pilk = "";
                $pilt = "";
            }
            if ($ro['statusorder'] == "Lunas") {
                $pilb = "";
                $pill = " selected";
                $pilk = "";
                $pilt = "";
            }
            if ($ro['statusorder'] == "Dikirim") {
                $pilb = "";
                $pill = "";
                $pilk = " selected";
                $pilt = "";
            }
            if ($ro['statusorder'] == "Diterima") {
                $pilb = "";
                $pill = "";
                $pilk = "";
                $pilt = " selected";
            }
            $sqlod = mysqli_query($kon, "SELECT * from orders where idorder='$ro[idorder]'");
            $rod = mysqli_fetch_array($sqlod);
            $sqlag = mysqli_query($kon, "SELECT * from anggota where idanggota='$rod[idanggota]'");
            $rag = mysqli_fetch_array($sqlag);
            $sqlko = mysqli_query($kon, "SELECT * from pembayaran where idorder='$rod[idorder]'");
            $row = mysqli_num_rows($sqlko);
            $rko = mysqli_fetch_array($sqlko);
            $sqlj = mysqli_query($kon, "SELECT * from kota_kirim where idorder='$ro[idorder]'");
            $rj = mysqli_fetch_array($sqlj);

            $query_resi = mysqli_query($kon, "SELECT * from resi where idorder='$rod[idorder]'");
            $rows = mysqli_num_rows($query_resi);
            $resi = mysqli_fetch_array($query_resi);
            if ($rows > 0) {
                $ket = "<div style='color:green'>" . $resi['resi'] . "</div>";
            } else {
                $ket = "<div style='color:red'>Nomor Resi Belum Diinput</div>";
            }

        ?>

            <div class="card mb-3">
                <div class="card-body shadow-lg">
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
                                    <li class="text-muted">Nomor Resi : <span class="badge text-bg-success"><?= $resi['resi']; ?> </span></li>
                                <?php } ?>

                            </ul>
                        </div>
                    </div>

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
                                $berat = 0;
                                $harga = 0;
                                while ($rordt = mysqli_fetch_array($sqlordt)) {
                                    $sqlpr = mysqli_query($kon, "SELECT * from produk where idproduk='$rordt[idproduk]'");
                                    $rpr = mysqli_fetch_array($sqlpr);
                                    $bar = kali($rpr['berat'], $rordt['jumlahbeli']);
                                    $har = kali($rordt['jumlahbeli'], disk($rpr["diskon"], $rpr['harga']));
                                ?>
                                    <tr>
                                        <td align="center"><?= $no++ ?></td>
                                        <td><?= $rpr['nama'] ?></td>
                                        <td align="center"><?= formatRupiah(disk($rpr["diskon"], $rpr['harga'])) ?></td>
                                        <td align="center"><?= $rordt['jumlahbeli'] ?> Unit</td>
                                        <td align="center"><?= $bar ?> Kg</td>
                                        <td align="right"><?= formatRupiah(kali($rordt['jumlahbeli'], disk($rpr["diskon"], $rpr['harga']))) ?></td>
                                    </tr>
                                <?php
                                    $berat += $bar;
                                    $harga += $har;
                                }
                                ?>
                                <tr>
                                    <td colspan="4" align="center">Total Berat</td>
                                    <td align="center">
                                        <?= $berat ?> Kg
                                    </td>
                                    <td align="right">
                                        <?= formatRupiah(kali($rj['bayar'], $berat)) ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="4" align="center">Total Bayar</td>
                                    <td align="right" colspan="2">
                                        <?= formatRupiah(tambah($harga, $berat)) ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <hr>
                    </div>



                    <center>
                        <?php if ($row > 0) { ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <center>
                                        <h3>Bukti Dibayar</h3>

                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#<?= $ro ?>">
                                            Lihat Bukti Bayar
                                        </button>

                                    </center>
                                    <?php if ($ro['statusorder'] == "Lunas") { ?>
                                </div>
                                <div class="col-md-6 mt-4">
                                    <form action="?p=aksi&order=orderdetail&id=<?= $ro['idorder'] ?>" method="post">
                                        <table width="100%">
                                            <tr>
                                                <td align="center>
                                                    <input type=" hidden" name="st" value="<?= $_GET['st'] ?>">
                                                    <div align="right">
                                                        <input type="text" name="nomor" class="form-control mt-3">
                                                    </div>

                                                </td>
                                                <td align="center">
                                                    <input type='submit' name="simpan" class='btn btn-info mt-3' value='Nomor Resi'>
                                                </td>
                                            </tr>
                                        </table>
                                    </form>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } else { ?>
                        <center>
                            <h3>Produk Belum Dibayar</h3>
                        </center>
                    <?php } ?>
                    </center>

                </div>
            </div>

            <div class="modal fade" id="<?= $ro ?>" tabindex="-1" aria-labelledby="<?= $ro ?>Label" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="<?= $ro ?>Label">Bukti Bayar</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <center>
                                <img src=" ../assets/img/buktibayar/<?= $rko['bukti'] ?>" width="100%" alt="">
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>


        <nav>
            <center>
                <ul class="pagination justify-content-center">
                    <li class="page-item">
                        <a class="page-link" <?php if ($order > 1) {
                                                    echo "href='?p=order&order=$previous&st=$st'";
                                                } ?>>Previous</a>
                    </li>
                    <?php
                    for ($x = 1; $x <= $total_order; $x++) {
                        if ($_GET['order'] == $x) {
                            $active = "active";
                        } else {
                            $active = "";
                        }

                        if (!isset($_GET['order']) && $x == 1) {
                            $active = "active";
                        }
                    ?>
                        <li class="page-item <?= $active ?>"><a class="page-link" href="?p=order&order=<?php echo $x ?>&st=<?= $st ?>"><?php echo $x; ?></a></li>
                    <?php
                    }
                    ?>
                    <li class="page-item">
                        <a class="page-link" <?php if ($order < $total_order) {
                                                    echo "href='?p=order&order=$next&st=$st'";
                                                } ?>>Next</a>
                    </li>
                </ul>
            </center>
        </nav>
    </div>
</div>