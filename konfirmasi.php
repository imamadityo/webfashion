<div class="container mt-3">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <h1 class="h3 mb-0 text-gray-800">Konfirmasi Pembayarn</h1>
            <hr style="border: 3px solid gray; border-radius: 5px;">
        </div>
    </div>

    <div class="row m-2">
        <div class="col-md-2"></div>
        <div class="card mb-4 col-md-8 border-left-info shadow-lg">
            <div class="card-body">
                <form class="form-horizontal style-form" method="get" action="" enctype="multipart/form-data">
                    <input type="hidden" class="form-control" name="p" value="<?= "$_GET[p]"; ?>" />
                    <input type="hidden" class="form-control" name="idag" value="<?= "$_GET[idag]"; ?>" />
                    <input type="text" class="form-control" name="noorder" placeholder="Masukkan No Order (Tanpa #)" value="<?php echo "$_GET[noorder]"; ?>" />
                    <br>
                    <center>
                        <input type="submit" class="btn btn-sm btn-primary" value="Cari No. Order" />
                    </center>
                </form>
                <?php
                $sqlo = mysqli_query($kon, "SELECT * from orders where noorder='$_GET[noorder]'");
                $ro = mysqli_fetch_array($sqlo);
                $sqlag = mysqli_query($kon, "SELECT * from anggota where idanggota='$ro[idanggota]'");
                $rag = mysqli_fetch_array($sqlag);
                $total = $ro["total"];
                ?>
                <form class="form-group" method="post" action="" enctype="multipart/form-data">
                    <input name="idorder" class="form-control" type="hidden" value="<?php echo "$ro[idorder]"; ?>"> <br>
                    <input name="tglorder" class="form-control" type="text" value="<?php echo "Tanggal Order : $ro[tglorder] WIB"; ?>"> <br>
                    <input name="nama" class="form-control" type="text" value="<?php echo "Atas nama : $rag[nama]"; ?>"> <br>
                    <input name="total" type="text" class="form-control" value="<?php echo "Sebesar : Rp $total"; ?>">
                    <h2 align="center" style="color: black">Dari Rekening</h2>
                    <input name="namabankpengirim" class="form-control" type="text" id="namabankpengirim" placeholder="Nama Bank Pengirim"><br>
                    <input name="namapengirim" type="text" class="form-control" id="namapengirim" placeholder="Nama Pengirim"><br>
                    <input name="jumlahtransfer" class="form-control" type="text" id="jumlahtransfer" value="<?php echo "$total"; ?>"><br>
                    <input name="tgltransfer" type="date" class="form-control" id="tgltransfer" placeholder="Tanggal Transfer ex : 0000-00-00">
                    <h2 align="center" style="color: black">Ke Rekening</h2>
                    <input name="namabankpenerima" class="form-control" type="text" value="Website" disabled>
                    <h2 align="center" style="color: black">Bukti Transfer</h2>
                    <input name="bukti" type="file" class="form-control" class="form-control" placeholder="Nama Bank Penerima"><br>
                    <center><input type="submit" name="konfirmasi" class="btn btn-sm btn-primary" value="KONFIRMASI PEMBAYARAN">
                        <center><br>
                </form>
                <?php
                if ($_POST["konfirmasi"]) {
                    $data = mysqli_query($kon, "SELECT * from pembayaran where idorder='$_POST[idorder]'");
                    $cek = mysqli_fetch_array($data);
                    if ($cek['idorder'] == $_POST['idorder']) { ?>
                        <script>
                            // Contoh penggunaan SweetAlert
                            Swal.fire({
                                title: 'Maaf!',
                                text: 'Anda Telah Melakukan Pembayaran',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // Pengalihan halaman saat tombol "OK" diklik
                                    window.location.href = '?p=riwayat&idag=<?= $rag['idanggota'] ?>';
                                }
                            });
                        </script>
                        <?php } else {
                        $data = mysqli_query($kon, "SELECT * from pembayaran where idorder='$_POST[idorder]'");
                        $cek = mysqli_fetch_array($data);
                        if ($cek['idorder'] == $_POST['idorder']) {
                            echo "<script>alert('Noorder Telah Dibayar');</script>";
                            echo "<META HTTP-EQUIV='Refresh' Content='0; URL=?p=home'>"; ?>
                            <script>
                                // Contoh penggunaan SweetAlert
                                Swal.fire({
                                    title: 'Maaf!',
                                    text: 'Pembayaran Telah Dilakukan',
                                    icon: 'error',
                                    confirmButtonText: 'OK'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        // Pengalihan halaman saat tombol "OK" diklik
                                        window.location.href = '?p=riwayat&idag=<?= $rag['idanggota'] ?>';
                                    }
                                });
                            </script>
                            <?php
                        } else {
                            $nmbukti  = $_FILES['bukti']['name'];
                            $lokbukti = $_FILES['bukti']['tmp_name'];
                            if (!empty($lokbukti)) {
                                move_uploaded_file($lokbukti, "assets/img/buktibayar/$nmbukti");
                            }

                            $sqlb = mysqli_query($kon, "INSERT INTO pembayaran (idorder, namabankpengirim, namapengirim, jumlahtransfer, tgltransfer, namabankpenerima, bukti) values ('$_POST[idorder]', '$_POST[namabankpengirim]', '$_POST[namapengirim]', '$_POST[jumlahtransfer]', '$_POST[tgltransfer]', 'Website', '$nmbukti')");

                            mysqli_query($kon, "UPDATE orders set statusorder='Lunas' where idorder='$_POST[idorder]'");

                            if ($sqlb) { ?>

                                <script>
                                    // Contoh penggunaan SweetAlert
                                    Swal.fire({
                                        title: 'Selamat!',
                                        text: 'Pembayaran Berhasil Dilakukan',
                                        icon: 'success',
                                        confirmButtonText: 'OK'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            // Pengalihan halaman saat tombol "OK" diklik
                                            window.location.href = '?p=riwayat&idag=<?= $rag['idanggota'] ?>';
                                        }
                                    });
                                </script>
                            <?php } else { ?>
                                echo "Konfirmasi Gagal";
                                <script>
                                    // Contoh penggunaan SweetAlert
                                    Swal.fire({
                                        title: 'Maaf!',
                                        text: 'Pembayaran Batal Dilakukan',
                                        icon: 'error',
                                        confirmButtonText: 'OK'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            // Pengalihan halaman saat tombol "OK" diklik
                                            window.location.href = '?p=konfirmasi&idag=<?= $rag['idanggota'] ?>';
                                        }
                                    });
                                </script>
                <?php }
                        }
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>