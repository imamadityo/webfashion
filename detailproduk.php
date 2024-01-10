<?php
$sqlp = mysqli_query($kon, "SELECT * from produk where idproduk='$_GET[ID]'");
$rp = mysqli_fetch_array($sqlp);
?>
<div class="container mt-3 mb-3">
    <div class="card shadow-lg">
        <div class="card-header">
            <h3>Detail Produk</h3>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-5">
                    <center>
                        <img src="assets/img/produk/<?= $rp['foto'] ?>" alt="">
                    </center>
                </div>
                <div class="col-md-7">
                    <table style="font-size: 20px;">
                        <tr>
                            <td>Nama</td>
                            <td> : </td>
                            <td><?= $rp['nama'] ?></td>
                        </tr>
                        <tr>
                            <td>Harga</td>
                            <td> : </td>
                            <td><?= diskon($rp['diskon'], $rp['harga']) ?></td>
                        </tr>
                        <tr>
                            <td>Stok</td>
                            <td> : </td>
                            <td><?= stok($rp['stok']); ?></td>
                        </tr>
                        <tr>
                            <td>Berat</td>
                            <td> : </td>
                            <td><?= $rp['berat']; ?>Kg</td>
                        </tr>
                        <tr>
                            <td width="20%">Detail Produk</td>
                            <td> : </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td><?= $rp['detail'] ?></td>
                        </tr>
                    </table>
                    <center>
                        <br>
                        <a href='?p=keranjang&idp=<?= $rp['idproduk']; ?>&idag=<?= $idanggota ?>' class="btn btn-primary btn-round">Beli Produk</a>
                    </center>
                </div>
            </div>
        </div>
    </div>
</div>