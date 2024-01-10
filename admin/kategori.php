<h3>Halaman Kategori</h3>
<hr class="style2">
<?= pesan($_GET['alert']) ?>
<div class="card shadow-lg">
    <div class="card-header">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kategori_add">
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
                        <th scope="col">Nama Kategori</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $query = $kon->query("SELECT * FROM kategori ORDER BY idkat ASC");
                    while ($data = mysqli_fetch_object($query)) {
                        $nama = "delete_kat" . $data->idkat;
                        $alamat = "delete_kat";
                    ?>
                        <tr>
                            <td align="center"><br><?= $no++ ?></td>
                            <td width="10%" align="center"><img src="../assets/img/kategori/<?= $data->fotokat ?>" width="100%" alt="" srcset=""></td>
                            <td><br><?= $data->namakat ?></td>
                            <td><br><?= $data->ketkat ?></td>
                            <td align="center"><br>
                                <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#kategori_edit<?= $data->idkat ?>">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button type="button" class="btn btn-danger btn-sm" onclick="<?= $nama ?>()">
                                    Hapus
                                </button>
                            </td>
                        </tr>
                        <?= deleteFunction($nama, $data->namakat, $data->idkat, $alamat) ?>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="kategori_add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info ">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Kategori</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="kategoriForm" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="namakat" class="form-label">Nama Kategori</label>
                        <input type="text" class="form-control" id="namakat" name="namakat">
                        <div class="invalid-feedback">
                            Nama Kategori Tidak Boleh Kosong.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="ketkat" class="form-label">Keterangan Kategori</label>
                        <input type="text" class="form-control" id="ketkat" name="ketkat">
                        <div class="invalid-feedback">
                            Keterangan Kategori Tidak Boleh Kosong.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="foto" class="form-label">Foto Kategori</label>
                        <input type="file" class="form-control" id="foto" name="foto">
                        <div class="invalid-feedback">
                            Foto Kategori Tidak Boleh Kosong.
                        </div>
                    </div>

                    <center>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </center>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("#kategoriForm").on("submit", function(e) {
            e.preventDefault();
            var namakat = $("#namakat").val();
            var ketkat = $("#ketkat").val();
            var foto = $("#foto").val();
            $(".invalid-feedback").hide();
            $(".form-control").removeClass("is-invalid");
            var valid = true;
            if (namakat.trim() === "") {
                $("#namakat").addClass("is-invalid");
                $("#namakat + .invalid-feedback").show();
                valid = false;
            }
            if (ketkat.trim() === "") {
                $("#ketkat").addClass("is-invalid");
                $("#ketkat + .invalid-feedback").show();
                valid = false;
            }
            if (foto.trim() === "") {
                $("#foto").addClass("is-invalid");
                $("#foto + .invalid-feedback").show();
                valid = false;
            }
            if (valid) {
                $.ajax({
                    url: "aksi.php?kategori=add",
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
<?php foreach ($query as $data) { ?>
    <div class="modal fade" id="kategori_edit<?= $data['idkat'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data Kategori</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="kategoriEditForm<?= $data['idkat'] ?>" method="POST" enctype="multipart/form-data">
                        <!-- Tambahkan input idkat -->
                        <input type="hidden" id="idkat" name="idkat" value="<?= $data['idkat'] ?>">

                        <div class="mb-3">
                            <label for="namakat" class="form-label">Nama Kategori</label>
                            <input type="text" class="form-control" id="namakat" name="namakat" value="<?= $data['namakat'] ?>">
                            <div class="invalid-feedback">
                                Nama Kategori Tidak Boleh Kosong.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="ketkat" class="form-label">Keterangan Kategori</label>
                            <input type="text" class="form-control" id="ketkat" name="ketkat" value="<?= $data['ketkat'] ?>">
                            <div class="invalid-feedback">
                                Keterangan Kategori Tidak Boleh Kosong.
                            </div>
                        </div>

                        <div class="mb-3">
                            <center>
                                <img src="../assets/img/kategori/<?= $data["fotokat"] ?>" width="20%" alt="" srcset="">
                            </center>
                            <label for="foto" class="form-label">Foto Kategori</label>
                            <input type="file" class="form-control" name="foto">
                        </div>

                        <center>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </center>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $("#kategoriEditForm<?= $data['idkat'] ?>").on("submit", function(e) {
                e.preventDefault();

                // Mengambil nilai input dari formulir
                var idkat = $(this).find("#idkat").val();
                var namakat = $(this).find("#namakat").val();
                var ketkat = $(this).find("#ketkat").val();
                var foto = $(this).find('input[type="file"]')[0].files[0];

                // Menghapus pesan error yang ada
                $(this).find(".invalid-feedback").hide();
                $(this).find(".form-control").removeClass("is-invalid");

                // Melakukan validasi
                var valid = true;

                if (namakat.trim() === "") {
                    $(this).find("#namakat").addClass("is-invalid");
                    $(this).find("#namakat + .invalid-feedback").show();
                    valid = false;
                }

                if (ketkat.trim() === "") {
                    $(this).find("#ketkat").addClass("is-invalid");
                    $(this).find("#ketkat + .invalid-feedback").show();
                    valid = false;
                }

                // Jika semua input valid, kirim data ke server
                if (valid) {
                    var formData = new FormData();
                    formData.append("idkat", idkat);
                    formData.append("namakat", namakat);
                    formData.append("ketkat", ketkat);
                    if (foto) {
                        formData.append("foto", foto, foto.name);
                    }

                    $.ajax({
                        url: "aksi.php?kategori=edit",
                        type: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            $("#kategori_edit" + idkat).modal("hide");
                            window.location.href = window.location.href + "&alert=2";
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
<?php } ?>