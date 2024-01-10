<?php
$id = $_POST["id"];
$jml_data = count($id);
$jumlah = $_POST["jml"];
for ($i = 1; $i <= $jml_data; $i++) {
    $sqlc = mysqli_query($kon, "SELECT * from cart where idcart='$id[$i]'");
    $rc = mysqli_fetch_array($sqlc);
    $sqlp = mysqli_query($kon, "SELECT * from produk where idproduk='$rc[idproduk]'");
    $rp = mysqli_fetch_array($sqlp);
    $stok = $rp["stok"];
    if ($jumlah[$i] > $stok) { ?>
        <script>
            // Contoh penggunaan SweetAlert
            Swal.fire({
                title: 'Maaf!',
                text: 'Stok Tidak Cukup',
                icon: 'error',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Pengalihan halaman saat tombol "OK" diklik
                    window.location.href = '?p=keranjangbelanja&idag=<?= $_POST['idag'] ?>';
                }
            });
        </script>

    <?php } else { ?>
        <script>
            // Contoh penggunaan SweetAlert
            Swal.fire({
                title: 'Selamat!',
                text: 'Keranjang Berhasil Ditambah',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Pengalihan halaman saat tombol "OK" diklik
                    window.location.href = '?p=keranjangbelanja&idag=<?= $_POST['idag'] ?>';
                }
            });
        </script>

<?php mysqli_query($kon, "UPDATE cart set jumlahbeli='$jumlah[$i]' where idcart='$id[$i]'");
    }
}
?>