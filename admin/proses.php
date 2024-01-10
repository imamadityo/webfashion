<h3>Halaman Proses Kmean</h3>
<hr class="style2">
<div class="card shadow-lg">
    <div class="card-header">
        <h5>Input Data Nilai</h5>
    </div>
    <div class="card-body">
        <form action="" class="needs-validation" novalidate="" method="post">
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Banyak Cluter</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="cluster" required="">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Banyak Iterasi</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="iterasi" required="">
                </div>
            </div>
            <center>
                <button class="btn btn-primary" type="submit" name="proses">Proses Data</button>
            </center>
        </form>
    </div>
</div>

<?php if (isset($_POST['proses'])) { ?>
    <div class="card shadow-lg">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" style="width:100%">
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
                        $data_set = array();
                        $nama  = array();
                        $query = $kon->query("SELECT * FROM dataset ORDER BY id ASC");
                        while ($row = mysqli_fetch_object($query)) {
                            $data_set[] = array($row->recency, $row->frequency, $row->monetary);
                            $nama[] = $row->nama;
                        ?>
                            <tr>
                                <td align="center"><?= $no++ ?></td>
                                <td><?= $row->nama ?></td>
                                <td align="center"><?= $row->recency ?></td>
                                <td align="center"><?= $row->frequency ?></td>
                                <td align="center"><?= $row->monetary ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
    <?php
    // Fungsi untuk menghitung jarak Euclidean antara dua titik
    function hitungJarak($data1, $data2)
    {
        return sqrt(
            pow(($data1[0] - $data2[0]), 2) +
                pow(($data1[1] - $data2[1]), 2) +
                pow(($data1[2] - $data2[2]), 2)
        );
    }


    // Kumpulan data
    $data_set = array();
    $nama = array();
    $query = $kon->query("SELECT * FROM dataset ORDER BY id ASC");
    while ($row = mysqli_fetch_object($query)) {
        $data_set[] = array($row->recency, $row->frequency, $row->monetary);
        $nama[] = $row->nama;
    }

    // Jumlah cluster yang diinginkan
    $jumlah_cluster = $_POST['cluster'];

    // Inisialisasi centroid awal secara acak
    $centroid = array();
    $centroid_awal = array(); // Untuk menyimpan centroid awal
    for ($i = 0; $i < $jumlah_cluster; $i++) {
        $random_index = mt_rand(0, count($data_set) - 1);
        $centroid[] = $data_set[$random_index];
        $centroid_awal[] = $data_set[$random_index];
    }

    // Iterasi maksimum
    $iterasi_maksimum = $_POST['iterasi'];
    // Output tabel untuk centroid awal
    ?>
    <h2>Centroid Awal:</h2>
    <div class='card shadow-lg'>
        <div class='card-body'>
            <div class='table-responsive'>
                <table class='table table-striped'>
                    <tr>
                        <th>Cluster</th>
                        <th>Recency</th>
                        <th>Frequency</th>
                        <th>Monetary</th>
                    </tr>
                    <?php
                    foreach ($centroid_awal as $index => $cent) {
                        $clus = $index + 1;
                    ?>
                        <tr>
                            <td>Cluster <?= $clus ?></td>
                            <td><?= $cent[0] ?></td>
                            <td><?= $cent[1] ?></td>
                            <td><?= $cent[2] ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
    <?php
    // Mulai iterasi
    for ($iterasi = 0; $iterasi < $iterasi_maksimum; $iterasi++) {
        // Langkah 1: Mengelompokkan data ke dalam cluster
        $cluster = array();
        $jar  = array();
        $jarak_per = array();
        foreach ($data_set as $data) {
            $jarak_terpendek = PHP_FLOAT_MAX;
            $cluster_terdekat = 0;
            $jarak_per_data = array();
            foreach ($centroid as $index => $cent) {
                $jarak = hitungJarak($data, $cent);
                $jarak_per_data[$index] = $jarak;
                if ($jarak < $jarak_terpendek) {
                    $jarak_terpendek = $jarak;
                    $cluster_terdekat = $index;
                }
            }
            $jarak_per[] = $jarak_per_data;
            $jar[] = $jarak_terpendek;
            $cluster[] = $cluster_terdekat;
        }

        // Langkah 2: Menghitung ulang centroid
        $centroid_baru = array();
        for ($i = 0; $i < $jumlah_cluster; $i++) {
            $total_recency = 0;
            $total_frequency = 0;
            $total_monetary = 0;
            $jumlah_data = 0;

            for ($j = 0; $j < count($cluster); $j++) {
                if ($cluster[$j] == $i) {
                    $total_recency += $data_set[$j][0];
                    $total_frequency += $data_set[$j][1];
                    $total_monetary += $data_set[$j][2];
                    $jumlah_data++;
                }
            }

            if ($jumlah_data > 0) {
                $centroid_baru[] = array(
                    $total_recency / $jumlah_data,
                    $total_frequency / $jumlah_data,
                    $total_monetary / $jumlah_data
                );
            } else {
                // Jika tidak ada data dalam cluster ini, gunakan centroid awal
                $centroid_baru[] = $centroid[$i];
            }
        }
        // Cek konvergensi dengan membandingkan centroid saat ini dengan centroid sebelumnya
        $konvergen = true;
        for ($i = 0; $i < $jumlah_cluster; $i++) {
            if (hitungJarak($centroid[$i], $centroid_baru[$i]) > 0.001) {
                $konvergen = false;
                break;
            }
        }
        // Jika sudah konvergen, berhenti dari iterasi
        if ($konvergen) {
            break;
        }
        // Simpan hasil centroid saat ini untuk iterasi berikutnya
        $centroid = $centroid_baru;
        // Output tabel untuk hasil cluster pada iterasi ini
    ?>

        <h2>Hasil Cluster (Iterasi <?= $iterasi + 1 ?>) :</h2>
        <div class='card shadow-lg'>
            <div class='card-body'>
                <div class='table-responsive'>
                    <table class='table table-striped'>
                        <tr>
                            <th>Nama</th>
                            <th>Recency</th>
                            <th>Frequency</th>
                            <th>Monetary</th>
                            <?php foreach ($centroid as $centroid_index => $cent) { ?>
                                <th>C<?= $centroid_index + 1 ?> </th>
                            <?php } ?>
                            <th>Jarak Terdekat</th>
                            <th>Cluster</th>
                        </tr>
                        <?php foreach ($cluster as $index => $cluster_id) { ?>
                            <tr>
                                <td><?= $nama[$index] ?></td>
                                <td><?= $data_set[$index][0] ?></td>
                                <td><?= $data_set[$index][1] ?></td>
                                <td><?= $data_set[$index][2] ?></td>
                                <?php foreach ($centroid as $centroid_index => $cent) { ?>
                                    <td><?= number_format($jarak_per[$index][$centroid_index], 4) ?></td>
                                <?php } ?>
                                <td><?= number_format($jar[$index], 4) ?></td>
                                <td>Cluster <?= $cluster_id + 1 ?></td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>

        <!-- Output tabel untuk centroid pada iterasi ini-->
        <h2>Centroid (Iterasi <?= $iterasi + 1 ?>):</h2>
        <div class='card shadow-lg'>
            <div class='card-body'>
                <div class='table-responsive'>
                    <table class='table table-striped'>
                        <tr>
                            <th>Cluster</th>
                            <th>Recency</th>
                            <th>Frequency</th>
                            <th>Monetary</th>
                        </tr>
                        <?php foreach ($centroid as $index => $cent) { ?>
                            <tr>
                                <td>Cluster <?= $index + 1 ?></td>
                                <td><?= $cent[0] ?></td>
                                <td><?= $cent[1] ?></td>
                                <td><?= $cent[2] ?></td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>
    <?php } ?>
    <center>
        <h2>Proses Terhenti Karna Nilai Cluster Yang Terakhir Diproses Sama Dengan Nilai Cluster Sebelumnya</h2>
    </center>
<?php } ?>