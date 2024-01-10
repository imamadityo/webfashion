<!-- Hero Section Begin -->
<section class="hero">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="hero__categories shadow-lg">
                    <div class="hero__categories__all">
                        <i class="fa fa-bars"></i>
                        <span>Kategori</span>
                    </div>
                    <ul class="bg-light">
                        <?php
                        $kategori = mysqli_query($kon, "SELECT * from kategori order by namakat asc");
                        while ($kat = mysqli_fetch_array($kategori)) {
                        ?>
                            <li><a class="<?= ($_GET['idk'] == $kat['idkat']) ? 'text-info fw-bold' : '' ?>" href='?p=home&idk=<?= $kat['idkat']; ?>'><b><?= $kat['namakat']; ?></b></a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="hero__search ">
                    <div class="hero__search__form">
                        <form method="post" action="?p=produkterbaru">
                            <input type="text" type="search" name="cari" placeholder="What do yo u need?">
                            <button type="submit" class="site-btn">SEARCH</button>
                        </form>
                    </div>
                    <a target="_blank" href=" https://wa.me/6281374489219?text=Halo%20Min,%20Saya%20ingin%20menanyakan%20sesuatu">
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>

                            <div class="hero__search__phone__text">
                                <h5>+65 11.188.888</h5>
                                <span>support 24/7 time</span>
                            </div>

                        </div>
                    </a>
                </div>
                <div class="hero__item set-bg shadow-lg" data-setbg="https://www.pajak.com/storage/2021/08/ecoomerce.jpg">
                    <div class="hero__text">
                        <span style="color: blue;">Fashion</span>
                        <h2 style="color: blue;">Style <br />Is A way To Say Who You Are</h2>
                        <p style="color: blue;"><b>Without Having To Speak</b></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Hero Section End -->

<?php if ($_GET['p'] == "home") {
    include "produkterbaru.php";
}
