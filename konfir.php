<?php
    $sqlo = mysqli_query($kon, "UPDATE orders set statusorder='Diterima' where idorder='$_GET[id]'"); 
?>
<script>
    // Contoh penggunaan SweetAlert
    Swal.fire({
        title: 'Selamat!',
        text: 'Barangnya Udah Anda Terima.',
        icon: 'success',
        confirmButtonText: 'OK'
    }).then((result) => {
        if (result.isConfirmed) {
            // Pengalihan halaman saat tombol "OK" diklik
            window.location.href = '?p=riwayat';
        }
    });
</script>