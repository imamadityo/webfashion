<h3>Halaman Produk</h3>
<hr class="style2">
<?= pesan($_GET['alert']) ?>
<div class="card shadow-lg">
    <div class="card-header">
        <button type="buttom" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#produk_add">
            Tambah Data
        </button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="myTable" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Foto</th>
                        <th scope="col">Nama Produk</th>
                        <th scope="col">Stok Produk</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Diskon</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $a = "INNER JOIN kategori ON produk.idkat=kategori.idkat";
                    $query = $kon->query("SELECT * FROM produk $a ORDER BY tgl_produk DESC");
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
                            <td align="center"><br><?= $data->diskon ?>%</td>
                            <td><br>
                                <center>
                                    <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#produk_info<?= $data->idproduk ?>">Info</button>
                                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#produk_edit<?= $data->idproduk ?>">Edit</button>
                                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#produk_stok<?= $data->idproduk ?>">Stok</button>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="<?= $nama ?>()">Hapus</button>
                                </center>
                            </td>
                        </tr>
                        <?= deleteFunction($nama, $data->nama, $data->idproduk, $alamat) ?>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="produk_add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-info ">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Produk</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="produkForm" method="POST" enctype="multipart/form-data">

                    <div class="row">
                        <div class="col-md-6">

                            <div class="mb-3">
                                <label for="idkat" class="form-label">Kategori</label>
                                <select class="form-select" id="idkat" name="idkat">
                                    <option value="">Pilih Kategori</option>
                                    <?= get_kat_option($row) ?>
                                </select>
                                <div class="invalid-feedback">
                                    Pilih Produk Tidak Boleh Kosong.
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Produk</label>
                                <input type="text" class="form-control" id="nama" name="nama">
                                <div class="invalid-feedback">
                                    Nama Produk Tidak Boleh Kosong.
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="harga" class="form-label">Harga Produk</label>
                                <input type="text" class="form-control" id="harga" name="harga">
                                <div class="invalid-feedback">
                                    Harga Produk Tidak Boleh Kosong.
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="diskon" class="form-label">Diskon Produk</label>
                                <input type="text" class="form-control" id="diskon" name="diskon">
                                <div class="invalid-feedback">
                                    Diskon Produk Tidak Boleh Kosong.
                                </div>
                            </div>

                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="berat" class="form-label">Berat Produk</label>
                                <input type="text" class="form-control" id="berat" name="berat">
                                <div class="invalid-feedback">
                                    Berat Produk Tidak Boleh Kosong.
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="detail" class="form-label">Detail Produk</label>
                                <textarea class="form-control" id="detail" name="detail"></textarea>
                                <div class="invalid-feedback">
                                    Detail Produk Tidak Boleh Kosong.
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="foto" class="form-label">Foto Produk</label>
                                <input type="file" class="form-control" id="foto" name="foto">
                                <div class="invalid-feedback">
                                    Foto Produk Tidak Boleh Kosong.
                                </div>
                            </div>
                        </div>
                    </div>

                    <center>
                        <button type="submit" class="btn btn-primary">Simpan Data</button>
                    </center>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("#produkForm").on("submit", function(e) {
            e.preventDefault();
            var idkat = $("#idkat").val();
            var nama = $("#nama").val();
            var harga = $("#harga").val();
            var diskon = $("#diskon").val();
            var berat = $("#berat").val();
            var detail = $("#detail").val();
            var foto = $("#foto").val();

            $(".invalid-feedback").hide();
            $(".form-control").removeClass("is-invalid");
            var valid = true;

            if (idkat.trim() === "") {
                $("#idkat").addClass("is-invalid");
                $("#idkat + .invalid-feedback").show();
                valid = false;
            }

            if (nama.trim() === "") {
                $("#nama").addClass("is-invalid");
                $("#nama + .invalid-feedback").show();
                valid = false;
            }

            if (harga.trim() === "") {
                $("#harga").addClass("is-invalid");
                $("#harga + .invalid-feedback").show();
                valid = false;
            }

            if (diskon.trim() === "") {
                $("#diskon").addClass("is-invalid");
                $("#diskon + .invalid-feedback").show();
                valid = false;
            }

            if (berat.trim() === "") {
                $("#berat").addClass("is-invalid");
                $("#berat + .invalid-feedback").show();
                valid = false;
            }

            if (detail.trim() === "") {
                $("#detail").addClass("is-invalid");
                $("#detail + .invalid-feedback").show();
                valid = false;
            }

            if (foto.trim() === "") {
                $("#foto").addClass("is-invalid");
                $("#foto + .invalid-feedback").show();
                valid = false;
            }

            if (valid) {
                $.ajax({
                    url: "aksi.php?produk=add",
                    type: "POST",
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        window.location.href = window.location.href + "&alert=1";
                    },
                    error: function(xhr, status, error) {
                        // Handle error jika terjadi kesalahan saat mengirim data ke server
                        console.error(error);
                        alert("Terjadi kesalahan saat menyimpan data.");
                    }
                });
            }
            // ...

        });
    });
</script>

<?php
foreach ($query as $key) {
    $nama = "delete_produk" . $key['idproduk'];
    $alamat = "delete_produk";
?>
    <div class="modal fade" id="produk_info<?= $key['idproduk'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-info ">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Data Produk</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-5">
                            <center><img src="../assets/img/produk/<?= $key['foto'] ?>" width="100%" alt="" srcset=""></center>
                        </div>
                        <div class="col-md-7">
                            <h2>Kategori : <?= $key['namakat'] ?></h2>
                            <hr class="style2">
                            <b>
                                <table>
                                    <tr>
                                        <td>Nama</td>
                                        <td> : </td>
                                        <td><?= $key['nama'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Harga</td>
                                        <td> : </td>
                                        <td><?= diskon($key['diskon'], $key['harga']) ?></td>
                                    </tr>
                                    <tr>
                                        <td>Stok</td>
                                        <td> : </td>
                                        <td><?= stok($key['stok']); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Berat</td>
                                        <td> : </td>
                                        <td><?= $key['berat']; ?>Kg</td>
                                    </tr>
                                    <tr>
                                        <td width="20%">Detail Produk</td>
                                        <td> : </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td><?= $key['detail'] ?></td>
                                    </tr>
                                </table>
                            </b>
                        </div>
                    </div>

                    <center>
                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#produk_edit<?= $key['idproduk'] ?>">Edit</button>
                        <button type="button" class="btn btn-danger btn-sm" onclick="<?= $nama ?>()">Hapus</button>
                    </center>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="produk_edit<?= $key['idproduk'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-info ">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data Produk</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="produkEditForm<?= $key['idproduk'] ?>" method="POST" action="?p=aksi&produk=edit" enctype="multipart/form-data">
                        <input type="hidden" id="idproduk" name="idproduk" value="<?= $key['idproduk'] ?>">
                        <div class="row">
                            <div class="col-md-6">

                                <div class="mb-3">
                                    <label for="idkat" class="form-label">Kategori</label>
                                    <select class="form-select" id="idkat" name="idkat">
                                        <option value="">Pilih Kategori</option>
                                        <?= get_kat_option($key['idkat']) ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        Pilih Produk Tidak Boleh Kosong.
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama Produk</label>
                                    <input type="text" class="form-control" id="nama" name="nama" value="<?= $key['nama'] ?>">
                                    <div class="invalid-feedback">
                                        Nama Produk Tidak Boleh Kosong.
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="harga" class="form-label">Harga Produk</label>
                                    <input type="text" class="form-control" id="harga" name="harga" value="<?= $key['harga'] ?>">
                                    <div class="invalid-feedback">
                                        Harga Produk Tidak Boleh Kosong.
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="diskon" class="form-label">Diskon Produk</label>
                                    <input type="text" class="form-control" id="diskon" name="diskon" value="<?= $key['diskon'] ?>">
                                    <div class="invalid-feedback">
                                        Diskon Produk Tidak Boleh Kosong.
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="berat" class="form-label">Berat Produk</label>
                                    <input type="text" class="form-control" id="berat" name="berat" value="<?= $key['berat'] ?>">
                                    <div class="invalid-feedback">
                                        Berat Produk Tidak Boleh Kosong.
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-6">


                                <div class="mb-3">
                                    <label for="detail" class="form-label">Detail Produk</label>
                                    <textarea class="form-control" id="detailt<?= $key['idproduk'] ?>" name="detail"><?= $key['detail'] ?></textarea>
                                    <div class="invalid-feedback">
                                        Detail Produk Tidak Boleh Kosong.
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="foto" class="form-label">Foto Produk</label>
                                    <center><img src="../assets/img/produk/<?= $key['foto'] ?>" width="20%" alt="" srcset=""></center>
                                    <input type="file" class="form-control" id="foto" name="foto">
                                    <div class="invalid-feedback">
                                        Foto Produk Tidak Boleh Kosong.
                                    </div>
                                </div>

                            </div>
                        </div>

                        <center>
                            <button type="submit" class="btn btn-primary">Simpan Data</button>
                        </center>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="produk_stok<?= $key['idproduk'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-info ">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Stok Data Produk</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="produkstokForm<?= $key['idproduk'] ?>" method="POST" enctype="multipart/form-data">
                        <input type="hidden" id="idproduk" name="idproduk" value="<?= $key['idproduk'] ?>">


                        <div class="mb-3">
                            <label for="stok" class="form-label">Stok Produk</label>
                            <input type="text" class="form-control" id="stok" name="stok">
                            <div class="invalid-feedback">
                                Stok Produk Tidak Boleh Kosong.
                            </div>
                        </div>

                        <center>
                            <button type="submit" class="btn btn-primary">Simpan Data</button>
                        </center>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            $("#produkstokForm<?= $key['idproduk'] ?>").on("submit", function(e) {
                e.preventDefault();
                // Mengambil nilai input dari formulir
                var idproduk = $(this).find("#idproduk").val();
                var stok = $(this).find("#stok").val();
                // Menghapus pesan error yang ada
                $(this).find(".invalid-feedback").hide();
                $(this).find(".form-control").removeClass("is-invalid");
                // Melakukan validasi
                var valid = true;
                if (!stok || stok.trim() === "") {
                    $(this).find("#stok").addClass("is-invalid");
                    $(this).find("#stok + .invalid-feedback").show();
                    valid = false;
                }

                // Jika semua input valid, kirim data ke server
                if (valid) {
                    var formData = new FormData();
                    formData.append("idproduk", idproduk);
                    formData.append("stok", stok);

                    $.ajax({
                        url: "aksi.php?produk=stok",
                        type: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            $("#produk_stok" + idproduk).modal("hide");
                            window.location.href = window.location.href + "&alert=8";
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                            alert("Terjadi kesalahan saat mengubah data.");
                        }
                    });
                }
            });
        });
    </script>

    <?= deleteFunction($nama, $key['nama'], $key['idproduk'], $alamat) ?>
<?php } ?>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        <?php foreach ($query as $key) : ?>
            ClassicEditor
                .create(document.querySelector('#detailt<?= $key['idproduk'] ?>'))
                .then(editor => {
                    console.log(editor);
                })
                .catch(error => {
                    console.error(error);
                });
        <?php endforeach; ?>
    });
</script>