<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-4"></div>

        <div class="col-md-4">
            <div class="card card-body shadow-lg">
                <form class="mt-4" action="" method="post">
                    <!-- Email input -->
                    <div class="form-outline mb-4">
                        <input type="email" id="form2Example1" name="email" class="form-control" />
                        <label class="form-label" for="form2Example1">Email address</label>
                    </div>
                    <div class="form-outline mb-4">
                        <input type="password" id="form2Example2" class="form-control" name="password" />
                        <label class="form-label" for="form2Example2">Password</label>
                    </div>

                    <button name="login" type="submit" class="btn btn-primary btn-block mb-4">Sign in</button>

                    <div class="text-center">
                        <p>Not a member? <a href="?p=daftar">Register</a></p>
                    </div>

                </form>
                <?php
                if (isset($_POST["login"])) {
                    $sqlag = mysqli_query($kon, "SELECT * from anggota where email='$_POST[email]' and password='$_POST[password]'");
                    $row = mysqli_num_rows($sqlag);
                    if ($row > 0) {
                        $rag = mysqli_fetch_array($sqlag);



                        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
                        session_start();
                        $_SESSION["userag"] = $rag["email"];
                        $_SESSION["passag"] = $rag["password"];
                        $_SESSION["idanggota"]   = $rag["idanggota"];
                        $_SESSION["nama"]   = $rag["nama"];

                ?>
                        <script>
                            // Contoh penggunaan SweetAlert
                            Swal.fire({
                                title: 'Hello!',
                                text: 'Anda Berhasil Login.',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // Pengalihan halaman saat tombol "OK" diklik
                                    window.location.href = '?p=home';
                                }
                            });
                        </script>
                    <?php } else { ?>

                        <script>
                            // Contoh penggunaan SweetAlert
                            Swal.fire({
                                title: 'Maaf!',
                                text: 'Anda Anda Gagal Login.',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // Pengalihan halaman saat tombol "OK" diklik
                                    window.location.href = '?p=login';
                                }
                            });
                        </script>
                    <?php } ?>


                <?php } ?>
            </div>
        </div>
    </div>
</div>