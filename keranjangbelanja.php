<section class="breadcrumb-section set-bg" data-setbg="assets/img/bg/bg.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2 style="color: black;">Shopping Cart</h2>
                    <div class="breadcrumb__option">
                        <a style="color: black;" href="?p=home">Home</a>
                        <span style="color: black;">Shopping Cart</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="shoping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__table">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="shoping__product">Produk</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $a = "INNER JOIN produk ON cart.idproduk=produk.idproduk";
                            $sqlc = mysqli_query($kon, "SELECT * from cart $a where idanggota='$rag[idanggota]'");
                            $rowc = mysqli_num_rows($sqlc);
                            if ($rowc > 0) {
                                echo "<form action='?p=keranjangedit' method='post' enctype='multipart/form-data'>";
                                echo "<input type='hidden' name='idag' value='$rag[idanggota]'>";
                                $no = 1;
                                $total = 0;
                                while ($rc = mysqli_fetch_array($sqlc)) {
                                    $total += kali($rc['jumlahbeli'], disk($rc['diskon'], $rc['harga']));
                                    $nomor = $no++;
                            ?>
                                    <?= "<input type='hidden' name='id[$nomor]' value='$rc[idcart]'>"; ?>
                                    <tr>
                                        <td class="shoping__cart__item">
                                            <img src="assets/img/produk/<?= $rc['foto'] ?>" width="10%" alt="">
                                            <h5><?= substr($rc['nama'], 0, 30) ?>...</h5>
                                        </td>
                                        <td width="20%">
                                            <?= diskon($rc['diskon'], $rc['harga']) ?>
                                        </td>
                                        <td class="shoping__cart__quantity">
                                            <div class="quantity">
                                                <div class="pro-qty">
                                                    <?= "<input type='text' name='jml[$nomor]' value='$rc[jumlahbeli]'>"; ?>
                                                </div>
                                            </div>
                                        </td>
                                        <td width="20%">
                                            <?= formatRupiah(kali($rc['jumlahbeli'], disk($rc['diskon'], $rc['harga']))) ?>
                                        </td>
                                        <td class="shoping__cart__item__close">
                                            <a href='?p=keranjangdel&idc=<?= $rc['idcart'] ?>&idag=<?= $rag['idanggota'] ?>'><span class="icon_close"></span></a>
                                        </td>
                                    </tr>
                                <?php }
                            } else { ?>
                                <script>
                                    // Contoh penggunaan SweetAlert
                                    Swal.fire({
                                        title: 'Maaf!',
                                        text: 'Keranjang Anda Masih Kosong',
                                        icon: 'error',
                                        confirmButtonText: 'OK'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            // Pengalihan halaman saat tombol "OK" diklik
                                            window.location.href = '?p=produkterbaru';
                                        }
                                    });
                                </script>
                            <?php

                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__btns">
                    <a href="?p=home" class="primary-btn btn btn-primary cart-btn"> CONTINUE SHOPPING</a>
                    <button type="submit" class="primary-btn btn btn-primary  cart-btn cart-btn-right">
                        Upadate Cart</button>
                </div>
            </div>
            </form>
            <div class="col-lg-6">
<?php
    if ($total !== null) {
        $nil = formatRupiah($total);
    } else {
        $nil ="Rp 0";
    }
?>
            </div>
            <div class="col-lg-6">
                <div class="shoping__checkout">
                    <h5>Cart Total</h5>
                    <ul>
                        <li>Total <span><?=$nil  ?></span></li>
                    </ul>
                    <a href="?p=selesaibelanja" class="primary-btn">PROCEED TO CHECKOUT</a>
                </div>
            </div>
        </div>
    </div>
</section>