<h3>Halaman Kategori</h3>
<hr class="style2">
<?= pesan($_GET['alert']) ?>
<div class="card shadow-lg">
    <div class="card-header">
        <a href="?p=aksi&data_set=update" class="btn btn-primary"> Update </a> =
        <a href="?p=proses" class="btn btn-warning"> Proses </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="myTable" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Recency</th>
                        <th scope="col">Frequency</th>
                        <th scope="col">Monetary</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $query = $kon->query("SELECT * FROM dataset ORDER BY id ASC");
                    while ($data = mysqli_fetch_object($query)) {
                    ?>
                        <tr>
                            <td align="center"><?= $no++ ?></td>
                            <td><?= $data->nama ?></td>
                            <td align="center"><?= $data->recency ?></td>
                            <td align="center"><?= $data->frequency ?></td>
                            <td align="center"><?= $data->monetary ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>