<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();
session_destroy(); ?>

<script>
    // Contoh penggunaan SweetAlert
    Swal.fire({
        title: 'Hello!',
        text: 'Anda Berhasil Logout.',
        icon: 'success',
        confirmButtonText: 'OK'
    }).then((result) => {
        if (result.isConfirmed) {
            // Pengalihan halaman saat tombol "OK" diklik
            window.location.href = '?p=home';
        }
    });
</script>