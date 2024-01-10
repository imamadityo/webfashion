<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

function pesan($alert)
{
    if (empty($_GET['alert'])) {
        echo "";
    } elseif ($_GET['alert'] == 1) { ?>
        <script>
            Swal.fire({
                title: 'Good Job!',
                text: 'Anda Berhasil Manambah Data',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        </script>
    <?php } elseif ($_GET['alert'] == 2) { ?>
        <script>
            Swal.fire({
                title: 'Good Job!',
                text: 'Anda Berhasil Mengedit Data',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        </script>
    <?php } elseif ($_GET['alert'] == 3) { ?>
        <script>
            Swal.fire({
                title: 'Good Job!',
                text: 'Anda Berhasil Menghapus Data',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        </script>
    <?php } elseif ($_GET['alert'] == 4) { ?>
        <script>
            Swal.fire({
                title: 'Oops!',
                text: 'Username & Password TidaK Boleh Kosong',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        </script>
    <?php } elseif ($_GET['alert'] == 5) { ?>
        <script>
            Swal.fire({
                title: 'Oops!',
                text: 'Username & Password Salah',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        </script>
    <?php } elseif ($_GET['alert'] == 6) { ?>
        <script>
            Swal.fire({
                title: 'Good Job!',
                text: 'Anda Berhasil Logout',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        </script>
    <?php } elseif ($_GET['alert'] == 7) { ?>
        <script>
            Swal.fire({
                title: 'Maaf!',
                text: 'Produk Tidak Cukup',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        </script>
    <?php } elseif ($_GET['alert'] == 8) { ?>
        <script>
            Swal.fire({
                title: 'Good Job!',
                text: 'Stok Berhasil Ditambah',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        </script>
    <?php }
}


function formatRupiah($angka)
{
    $rupiah = "Rp " . number_format($angka, 0, ',', '.');
    return $rupiah;
}


function deleteFunction($delete, $name, $id, $alamat)
{ ?>
    <script>
        function <?= $delete ?>() {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger mr-3'
                },
                buttonsStyling: false
            });

            swalWithBootstrapButtons.fire({
                title: 'Apakah Kamu Yakin?',
                text: "Untuk Menghapus Data <?= $name ?>",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '?p=aksi&form=<?= $alamat ?>&id=<?= $id ?>';
                } else if (result.dismiss === Swal.DismissReason.cancel) {}
            });
        }
    </script>
<?php }


function get_kat_option($selected)
{
    include "koneksi.php";
    $rows = $kon->query("SELECT * FROM kategori ORDER BY idkat DESC");
    $opt = '';
    foreach ($rows as $row) {
        if ($row['idkat'] == $selected) {
            $opt .= "<option value='" . $row['idkat'] . "' selected>" . $row['namakat'] . "</option>";
        } else {
            $opt .= "<option value='" . $row['idkat'] . "'>" . $row['namakat'] . "</option>";
        }
    }
    return $opt;
}

function diskon($diskon, $harga)
{
    if ($diskon > 1) {
        $c = ($diskon * $harga) / 100;
        $d = $harga - $c;
        $e = formatRupiah($d);
        $out = "<font color='#00CC00'>" . $e . "</font> <font color='red'> -$diskon% </font> <font style='text-decoration:line-through'><small>" . formatRupiah($harga) . "</small></font>";
    } else {
        $out = formatRupiah($harga);
    }
    return $out;
}

function disk($diskon, $harga)
{
    if ($diskon > 1) {
        $c = ($diskon * $harga) / 100;
        $d = $harga - $c;
        $out =  $d;
    } else {
        $out = $harga;
    }
    return $out;
}

function stok($stok)
{
    if ($stok > 5) {
        $a = "<div class='text-success'>" . $stok . " Unit</div>";
    } elseif ($stok <= 5 && $stok > 0) {
        $a = "<div class='text-warning'>" . $stok . " Unit</div>";
    } elseif ($stok == 0) {
        $a = "<div class='text-danger'>Stok Habis</div>";
    } else {
        $a = "<div class='text-danger'>Stok tidak valid</div>";
    }

    return $a;
}

function kali($banyak, $harga){
    $total = $banyak * $harga;
    return $total;
}

function tambah($banyak, $harga)
{
    $total = $banyak + $harga;
    return $total;
}

function tampilkanPagination($produk, $total_produk, $previous, $next)
{
?>
    <nav>
        <ul class="pagination justify-content-center">
            <li class="page-item">
                <a class="page-link" <?php if ($produk > 1) {
                                            echo "href='?p=produkterbaru&produk=$previous'";
                                        } ?>>Previous</a>
            </li>
            <?php
            for ($x = 1; $x <= $total_produk; $x++) {
                if ($_GET['produk'] == $x) {
                    $active = "active";
                } else {
                    $active = "";
                }
                // Tambahkan kondisi untuk nomor halaman pertama
                if (!isset($_GET['produk']) && $x == 1) {
                    $active = "active";
                }
            ?>
                <li class="page-item <?= $active ?>"><a class="page-link" href="?p=produkterbaru&produk=<?php echo $x ?>"><?php echo $x; ?></a></li>
            <?php } ?>
            <li class="page-item">
                <a class="page-link" <?php if ($produk < $total_produk) {
                                            echo "href='?p=produkterbaru&produk=$next'";
                                        } ?>>Next</a>
            </li>
        </ul>
    </nav>
<?php
}

function Pagination($nama_halaman, $page, $halaman, $total_halaman, $previous, $next)
{
?>
    <nav>
        <ul class="pagination justify-content-center">
            <li class="page-item">
                <a class="page-link" <?php if ($halaman > 1) { ?> href='?p=<?=$nama_halaman?>&<?=$page?>=<?=$previous?>' <?php } ?>>Previous</a>
            </li>
            <?php
            for ($x = 1; $x <= $total_halaman; $x++) {
                if ($_GET[".$page."] == $x) {
                    $active = "active";
                } else {
                    $active = "";
                }
                // Tambahkan kondisi untuk nomor halaman pertama
                if (!isset($_GET['<?=$page?>']) && $x == 1) {
                    $active = "active";
                }
            ?>
                <li class="page-item <?= $active ?>"><a class="page-link" href="?p=<?=$nama_halaman?>&<?=$page?>=<?php echo $x ?>"><?php echo $x; ?></a></li>
            <?php } ?>
            <li class="page-item">
                <a class="page-link" <?php if ($halaman < $total_halaman) { ?> href='?p=<?=$nama_halaman?>&<?=$page?>=<?=$next?>' <?php } ?>>Next</a>
            </li>
        </ul>
    </nav>
<?php
}

function rows($nama){
    include "koneksi.php";
    $data = $kon->query("SELECT * FROM $nama ");
    $row = mysqli_num_rows($data);

    return $row;
}