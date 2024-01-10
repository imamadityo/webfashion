<?php if ($_GET["p"] == "produkterbaru") {
    include "home.php";
} ?>

<?php
$batas = 8;
$produk = isset($_GET['produk']) ? (int)$_GET['produk'] : 1;
$produk_awal = ($produk > 1) ? ($produk * $batas) - $batas : 0;
$previous = $produk - 1;
$next = $produk + 1;
$data = mysqli_query($kon, "SELECT * FROM produk");
$jumlah_data = mysqli_num_rows($data);
$total_produk = ceil($jumlah_data / $batas);

$q = ""; // Inisialisasi query kosong
$l = ""; // Inisialisasi limit kosong

if (!empty($_GET["idk"])) {
    $q = " where idkat='$_GET[idk]'";
    $l = "";
} else if (isset($_POST["cari"])) {
    $q = "";
    $l = "";
    $m = "where nama like '%$_POST[cari]%'";
} else {
    $q = "";
    $l = " limit $posisi, $batas";
}
$sqlk = mysqli_query($kon, "SELECT * from kategori $q");
if (!empty($_GET["idk"])) {
    $rk = mysqli_fetch_array($sqlk);
    $kat = "<br>Kategori : <b>$rk[namakat]</b>";
} else {
    $kat = "<br>Produk Terbaru";
}
$sqlp = $kon->query("SELECT * FROM produk $q $m order by  tgl_produk desc limit $produk_awal, $batas");
$nomor = $produk_awal + 1;
?>
<section class="">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2><?= $kat; ?></h2>
                </div>
            </div>
        </div>
        <div class="row">
            <?php
            while ($rp = mysqli_fetch_array($sqlp)) {
                $sqlk = mysqli_query($kon, "SELECT * from kategori where idkat='$rp[idkat]'");
                $rk = mysqli_fetch_array($sqlk);
                $nm = substr($rp["nama"], 0, 15);
            ?>
                <div class="col-lg-3 col-md-4 col-sm-6 ">
                    <div class="featured__item ">
                        <div class="featured__item__pic set-bg ">
                            <img src="assets/img/produk/<?= $rp['foto'] ?>" alt="">
                            <ul class="featured__item__pic__hover">
                                <li><a href="?p=detailproduk&ID=<?= $rp['idproduk'] ?>"><i class="fa fa-info"></i></a></li>
                                <li><a href='?p=keranjang&idp=<?= $rp['idproduk']; ?>&idag=<?= $idanggota ?>'><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="featured__item__text">
                            <h6><a href="#"><?= $nm; ?>...</a></h6>
                            <h5><?= formatRupiah(disk($rp['diskon'], $rp['harga'])) ?></h5>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>



<?php
tampilkanPagination($produk, $total_produk, $previous, $next);
?>
<br>
<!-- Featured Section End -->