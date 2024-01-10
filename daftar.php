
<div class="container">
    <div class="card mt-3 mb-5 shadow-lg">
        <div class="card-header">
            <h3>Daftar Member</h3>
        </div>

        <div class="card-body">
            <form class="form-group mb-3" method="post" action="" enctype="multipart/form-data">


                <div class="form-group mb-3">
                    <label class="mb-3" align="left">Input Email Anda</label>
                    <input type="email" class="form-control" name="email">
                </div>

                <div class="form-group mb-3">
                    <label class="mb-3" for="exampleInputPassword1">Input Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password Login">
                </div>

                <div class="form-group mb-3">
                    <label class="mb-3" for="exampleInputPassword1">Input Nama Lengkap</label>
                    <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Lengkap">
                </div>

                <div class="form-group mb-3">
                    <label class="mb-3" for="exampleInputPassword1">Input Jenis Kelamin</label>
                    <center>
                        <h4>
                            <input name="jk" type="radio" value="L" />Laki-Laki
                            <input name="jk" type="radio" value="P" style="margin-left: 100px" />Perempuan
                        </h4>
                    </center>

                    <div class="form-group mb-3">
                        <label class="mb-3" for="exampleInputPassword1">Input Tanggal Lahir</label>
                        <input type="date" class="form-control" name="tgllahir" id="tgllahir">
                    </div>

                    <div class="form-group mb-3">
                        <label class="mb-3">Input Alamat</label>
                        <textarea name="alamat" class="form-control" placeholder="Isi Alamat Anda ..."></textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label class="mb-3" for="exampleInputPassword1">Input No Hp</label>
                        <input type="text" class="form-control" name="nohp" id="nohp" placeholder="No. Handphone">
                    </div>

                    <div class="form-group mb-3">

                    </div>
                </div>
                <center>
                    <div class="form-group mb-3 center">
                        <input name="register" type="submit" id="register" class="btn btn-primary btn-user" value="DAFTAR SEBAGAI ANGGOTA">
                    </div>

                </center>
            </form>

            <?php
            if (isset($_POST["register"])) {
                    
                        $sqlag = mysqli_query($kon, "SELECT * from anggota where email='$_POST[email]' ");
                        $row = mysqli_num_rows($sqlag);
                        if ($row > 0) {
                    ?>
                            <script>
                                // Contoh penggunaan SweetAlert
                                Swal.fire({
                                    title: 'Opp!',
                                    text: 'Email Sudah Ada.',
                                    icon: 'error',
                                    confirmButtonText: 'OK'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        // Pengalihan halaman saat tombol "OK" diklik
                                        window.location.href = '?p=daftar';
                                    }
                                });
                            </script>
                            <?php
                        } else {
                        if (!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['nama']) && !empty($_POST['tgllahir'])) {
                            $sqlag = mysqli_query($kon, "INSERT INTO anggota (email, password, nama, jk, tgllahir, alamat, nohp, tgldaftar) values ('$_POST[email]', '$_POST[password]', '$_POST[nama]', '$_POST[jk]', '$_POST[tgllahir]', '$_POST[alamat]', '$_POST[nohp]',NOW())");
                        
                            if ($sqlag) {
                            ?>
                                <script>
                                    // Contoh penggunaan SweetAlert
                                    Swal.fire({
                                        title: 'Hello!',
                                        text: 'Anda Berhasil Membuat Akun.',
                                        icon: 'success',
                                        confirmButtonText: 'OK'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            // Pengalihan halaman saat tombol "OK" diklik
                                            window.location.href = '?p=login';
                                        }
                                    });
                                </script>
                            <?php } }else { ?>
                                <script>
                                    // Contoh penggunaan SweetAlert dengan pengalihan halaman
                                    Swal.fire({
                                        title: 'Maaf',
                                        text: 'Anda Gagal Membuat Akun, Data Tidak Boleh Kosong.',
                                        icon: 'error',
                                        confirmButtonText: 'OK'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            // Pengalihan halaman saat tombol "OK" diklik
                                            window.location.href = '?p=daftar';
                                        }
                                    });
                                </script>
                    <?php }
                        }
                    } ?>
        </div>
    </div>
</div>
