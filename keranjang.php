<?php
if (empty($_SESSION["userag"]) and empty($_SESSION["passag"])) { ?>
    <script>
        // Contoh penggunaan SweetAlert
        Swal.fire({
            title: 'Sorry!',
            text: 'Sebelum membeli produk kami, Anda harus login terlebih dahulu.',
            icon: 'error',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                // Pengalihan halaman saat tombol "OK" diklik
                window.location.href = '?p=login';
            }
        });
    </script>
<?php
} else {
    $sqlc = mysqli_query($kon, "SELECT idproduk FROM cart WHERE idproduk='$_GET[idp]' AND idanggota='$_GET[idag]'");
    $rowc = mysqli_num_rows($sqlc);

    $sqlp = mysqli_query($kon, "SELECT * FROM produk WHERE idproduk='$_GET[idp]'");
    $rp = mysqli_fetch_array($sqlp);

    if ($rp["stok"] == 0) {
        echo "<script>alert('<b>STOK HABIS <br>untuk produk $rp[nama]</b>')</script>";
    } else {
        if ($rowc == 0) {
            mysqli_query($kon, "INSERT INTO cart (idproduk, idanggota, jumlahbeli, tglcart) VALUES ('$_GET[idp]', '$_GET[idag]', 1, NOW())");
        } else {
            $sqlcr = mysqli_query($kon, "SELECT * FROM cart WHERE idproduk='$_GET[idp]'");
            $rcr = mysqli_fetch_array($sqlcr);
            if ($rcr["jumlahbeli"] >= $rp["stok"]) {
                echo "<script>alert('<b>STOK TIDAK MENCUKUPI <br>untuk produk $rp[nama]</b>')</script>";
            } else {
                mysqli_query($kon, "UPDATE cart SET jumlahbeli=jumlahbeli+1 WHERE idproduk='$_GET[idp]' AND idanggota='$_GET[idag]'");
            }
        }
    }
    echo "<META HTTP-EQUIV='Refresh' Content='0; URL=?p=keranjangbelanja&idag=$rag[idanggota]'>";
}
