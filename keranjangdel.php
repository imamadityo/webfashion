<?php
mysqli_query($kon, "delete from cart where idcart='$_GET[idc]'");
?>
<script>
    // Contoh penggunaan SweetAlert
    Swal.fire({
        title: 'Selamat!',
        text: 'Produk Berhasil Dihapus',
        icon: 'success',
        confirmButtonText: 'OK'
    }).then((result) => {
        if (result.isConfirmed) {
            // Pengalihan halaman saat tombol "OK" diklik
            window.location.href = '?p=keranjangbelanja&idag=<?= $_POST['idag'] ?>';
        }
    });
</script>