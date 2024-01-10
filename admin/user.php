<h3>Halaman Customer</h3>
<hr class="style2">
<?= pesan($_GET['alert']) ?>
<div class="card shadow-lg">
    
    <div class="card-body">
        <div class="table-responsive">
            <table id="myTable" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Lengkap</th>
                        <th>Alamat</th>
                        <th>Email</th>
                        <th>Nomor Hp</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $data = $kon->query("SELECT * FROM anggota");
                    foreach ($data as $key) {

                        $nama = "delete_anggota" . $key['idanggota'];
                        $alamat = "delete_anggota";
                    ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $key['nama'] ?></td>
                            <td><?= $key['alamat'] ?></td>
                            <td><?= $key['email'] ?></td>
                            <td><?= $key['nohp'] ?></td>
                            <td>
                                <center>

                                    <button type="button" class="btn btn-danger btn-sm" onclick="<?= $nama ?>()">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </center>
                            </td>
                        </tr>
                        <?= deleteFunction($nama, $key['nama'], $key['idanggota'], $alamat) ?>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>