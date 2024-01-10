<?php
$a = "INNER JOIN produk ON cart.idproduk=produk.idproduk";
$sqlc = mysqli_query($kon, "SELECT * from cart $a where idanggota='$rag[idanggota]'");
$rowc = mysqli_num_rows($sqlc);
$tot = 0;
while ($rc = mysqli_fetch_array($sqlc)) {
    $tot += kali($rc['jumlahbeli'], disk($rc['diskon'], $rc['harga']));
}
?>
<div class="humberger__menu__overlay"></div>
<div class="humberger__menu__wrapper">
    <div class="humberger__menu__logo">
        <a href="?p=home">
            <h2><b>FORTUNESSHOP</b></h2>
        </a>
    </div>
    <div class="humberger__menu__cart">
        <?php if (!empty($_SESSION["userag"]) and !empty($_SESSION["passag"])) { ?>
            <ul>
                <li><a href="#"><i class="fa fa-shopping-bag"></i> <span>3</span></a></li>
            </ul>
        <?php } ?>
        <div class="header__cart__price">item: <span>$150.00</span></div>
    </div>
    <div class="humberger__menu__widget">
        <?php if (!empty($_SESSION["userag"]) and !empty($_SESSION["passag"])) { ?>
            <div class="header__top__right__language">
                <i class="fa fa-user" aria-hidden="true"></i>
                <div><?= $_SESSION['nama'] ?></div>
                <span class="arrow_carrot-down"></span>
                <ul>
                    <li><a href="?p=konfirmasi&idag=<?= $rag['idanggota']; ?>">Konfirmasi</a></li>
                    <li><a href="?p=riwayat&idag=<?= $rag['idanggota']; ?>">Riwayat</a></li>
                    <li><a href="?p=logout">Logout</a></li>
                </ul>
            </div>
        <?php } else { ?>
            <div class="header__top__right__language">
                <a href="?p=daftar" style="color: black;"><i class="fa fa-user-plus" aria-hidden="true"></i> Daftar</a>
            </div>
            <div class="header__top__right__auth">
                <a href="?p=login"><i class="fa fa-user"></i> Login</a>
            </div>
        <?php } ?>
    </div>
    <nav class="humberger__menu__nav mobile-menu">
        <ul>
            <li class="active"><a href="?p=home">Home</a></li>
            <li><a href="?p=produkterbaru">Produk</a< /li>

            <li><a href="?p=info">Info</a></li>
        </ul>
    </nav>
    <div id="mobile-menu-wrap"></div>

    <div class="humberger__menu__contact">
        <ul>
            <li>TOKO FORTUNESSHOP</li>
        </ul>
    </div>
</div>
<!-- Humberger End -->

<!-- Header Section Begin -->
<header class="header">
    <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__left">
                        <ul>
                            <li>TOKO FORTUNESSHOP</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <?php if (!empty($_SESSION["userag"]) and !empty($_SESSION["passag"])) { ?>
                        <div class="header__top__right">
                            <div class="header__top__right__language">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <div><?= $_SESSION['nama'] ?></div>
                                <span class="arrow_carrot-down"></span>
                                <ul>
                                    <li><a href="?p=konfirmasi&idag=<?= $rag['idanggota']; ?>">Konfirmasi</a></li>
                                    <li><a href="?p=riwayat&idag=<?= $rag['idanggota']; ?>">Riwayat</a></li>
                                    <li><a href="?p=logout">Logout</a></li>
                                </ul>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="header__top__right">
                            <div class="header__top__right__language">
                                <a href="?p=daftar" style="color: black;"><i class="fa fa-user-plus" aria-hidden="true"></i> Daftar</a>
                            </div>
                            <div class="header__top__right__auth">
                                <a href="?p=login"><i class="fa fa-user"></i> Login</a>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="header__logo">
                    <a href="?p=home">
                        <h2><b>FORTUNESSHOP</b></h2>
                    </a>
                </div>
            </div>
            <div class="col-lg-6">
                <nav class="header__menu">
                    <ul>
                        <li class="active"><a href="?p=home">Home</a></li>
                        <li><a href="?p=produkterbaru">Produk</a></li>
                        <li><a href="?p=info">Info</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-3">
                <div class="header__cart">
                    <?php if (!empty($_SESSION["userag"]) and !empty($_SESSION["passag"])) { ?>
                        <ul>
                            <li><a href="?p=keranjangbelanja&idag=<?= $rag['idanggota']; ?>"><i class="fa fa-shopping-bag"></i> <span><?= $rowc ?></span></a></li>
                        </ul>
                        <div class="header__cart__price">Total: <span><?= formatRupiah($tot) ?></span></div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="humberger__open">
            <i class="fa fa-bars"></i>
        </div>
    </div>
</header>
<!-- Header Section End -->