<h3>Halaman Home</h3>
<hr class="style2">
<div class="row">
    <div class="col-md-4 col-xl-3">
        <div class="card bg-c-blue order-card shadow">
            <div class="card-block">
                <h6 class="m-b-20">Kategori</h6>
                <h2 class="text-right"><i class="fa fa-box-open fs-1 f-left"></i><span><?= rows("kategori") ?></span></h2>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-xl-3">
        <div class="card bg-c-green order-card shadow">
            <div class="card-block">
                <h6 class="m-b-20">Produk</h6>
                <h2 class="text-right"><i class="fa fa-folder-open fs-1 f-left"></i><span><?= rows("produk") ?></span></h2>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-xl-3">
        <div class="card bg-c-yellow order-card shadow">
            <div class="card-block">
                <h6 class="m-b-20">Kostamer</h6>
                <h2 class="text-right"><i class="fa fa-users fs-1 f-left"></i><span><?= rows("anggota") ?></span></h2>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-xl-3">
        <div class="card bg-c-pink order-card shadow">
            <div class="card-block">
                <h6 class="m-b-20">Transaksi</h6>
                <h2 class="text-right"><i class="fa fa-credit-card fs-1 f-left"></i><span><?= rows("orders") ?></span></h2>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-5">
        <div class="card shadow-lg">
            <div class="card-header bg-info">
                Data Customer
            </div>
            <div class="card-body">
                <center>
                    <table class="table table-responsive align-middle mb-0 bg-white">
                        <thead class="bg-light">
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Nomor Hp</th>
                                <th>Alamat</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $data = $kon->query("SELECT * FROM anggota limit 5");
                            foreach ($data as $key) {
                            ?>
                                <tr>
                                    <td>
                                        <p class="fw-bold mb-1"><?= $key['nama'] ?></p>
                                    </td>
                                    <td>
                                        <p class="text-muted mb-0"><?= $key['email'] ?></p>
                                    </td>
                                    <td>
                                        <p class="fw-normal mb-1"><?= $key['nohp'] ?></p>
                                    </td>
                                    <td>
                                        <?= $key['alamat'] ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </center>
            </div>
        </div>
    </div>

    <div class="col-md-7">
        <div class="card shadow-lg">
            <div class="card-header bg-danger">
                Data Produk
            </div>
            <div class="card-body">
                <table class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Foto</th>
                            <th scope="col">Nama Produk</th>
                            <th scope="col">Stok Produk</th>
                            <th scope="col">Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $a = "INNER JOIN kategori ON produk.idkat=kategori.idkat";
                        $query = $kon->query("SELECT * FROM produk $a ORDER BY tgl_produk DESC limit 5");
                        while ($data = mysqli_fetch_object($query)) {
                            $nama = "delete_produk" . $data->idproduk;
                            $alamat = "delete_produk";
                        ?>
                            <tr>
                                <td align="center"><br><?= $no++ ?></td>
                                <td align="center" width="10%"><img src="../assets/img/produk/<?= $data->foto ?>" width="100%" alt="" srcset=""></td>
                                <td><br><?= substr($data->nama, 0, 25) ?>....</td>
                                <td align="center" class="fw-bold"><br><?= stok($data->stok); ?></td>
                                <td align="right"><br><?= formatRupiah($data->harga) ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>