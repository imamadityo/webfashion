<?php
require_once "../include/koneksi.php";
if (empty($_SESSION['username']) && empty($_SESSION['password'])) {
    echo "<meta http-equiv='refresh' content='0; url=index.php?alert=1'>";
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if ($_GET['kategori']=="add") {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $namakat = $_POST["namakat"];
        $ketkat = $_POST["ketkat"];


        $nmfoto  = basename($_FILES["foto"]["name"]);
        $lokfoto = $_FILES["foto"]["tmp_name"];
        $file_name = $namakat . "-" . $nmfoto;
        if (!empty($lokfoto)) {
            move_uploaded_file($lokfoto, "../assets/img/kategori/$file_name");
        }

        $query = mysqli_query($kon, "INSERT INTO kategori (namakat, ketkat, fotokat) VALUES ('$namakat','$ketkat', '$file_name')");
    }
} else if ($_GET['kategori'] == "edit") {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $idkat = $_POST["idkat"];
        $namakat = $_POST["namakat"];
        $ketkat = $_POST["ketkat"];
        $kategori = mysqli_query($kon, "SELECT * from kategori where idkat='$idkat'");
        $kat = mysqli_fetch_array($kategori);
        $nmfoto  = basename($_FILES["foto"]["name"]);
        $lokfoto = $_FILES["foto"]["tmp_name"];
        $file_name = $namakat . "-" . $nmfoto;
        if (!empty($lokfoto)) {
            move_uploaded_file($lokfoto, "../assets/img/kategori/$file_name");
            unlink("../assets/img/kategori/$kat[fotokat]");
            $foto = ", fotokat='$file_name'";
        } else {
            $foto = "";
        }
        $query = mysqli_query($kon, "UPDATE kategori SET namakat='$namakat', ketkat='$ketkat' $foto WHERE  idkat='$idkat' ");
    }

} else if ($_GET['p'] == "aksi" and $_GET['form'] == "delete_kat") {

    $kategori = mysqli_query($kon, "SELECT * from kategori where idkat='$_GET[id]'");
    $kat = mysqli_fetch_array($kategori);
    unlink("../assets/img/kategori/$kat[fotokat]");
    $query = mysqli_query($kon, "DELETE FROM kategori WHERE idkat='$_GET[id]'")
        or die('Ada Kesalahan pada Query Data User:' . mysqli_error($kon));
    if ($query) {
        echo "<META HTTP-EQUIV='Refresh' Content='0; URL=?p=kategori&alert=3'>";
    }

}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if ($_GET['produk'] == "add") {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $idkat = $_POST["idkat"];
        $nama = $_POST["nama"];
        $harga = $_POST["harga"];
        $diskon = $_POST["diskon"];
        $berat = $_POST["berat"];
        $detail = $_POST["detail"];
    
        $nmfoto  = basename($_FILES["foto"]["name"]);
        $lokfoto = $_FILES["foto"]["tmp_name"];
        $file_name = $namakat . "-" . $nmfoto;
        if (!empty($lokfoto)) {
            move_uploaded_file($lokfoto, "../assets/img/produk/$file_name");
        }

        $query = mysqli_query($kon, "INSERT INTO produk (idkat, nama, harga, diskon, berat, detail, foto, tgl_produk) VALUES 
                                                        ('$idkat', '$nama', '$harga' ,'$diskon' ,'$berat' ,'$detail' ,'$file_name', NOW())");
    }
} else if ($_GET['produk'] == "edit") {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $idproduk = $_POST["idproduk"];
        $idkat = $_POST["idkat"];
        $nama = $_POST["nama"];
        $harga = $_POST["harga"];
        $diskon = $_POST["diskon"];
        $berat = $_POST["berat"];
        $detail = $_POST["detail"];

        $produk = mysqli_query($kon, "SELECT * from produk WHERE  idproduk='$idproduk'");
        $pro = mysqli_fetch_array($produk);

        if (!empty($_FILES["foto"]["name"])) {
            $nmfoto  = basename($_FILES["foto"]["name"]);
            $lokfoto = $_FILES["foto"]["tmp_name"];
            $file_name = $nama . "-" . $nmfoto;
            move_uploaded_file($lokfoto, "../assets/img/produk/$file_name");
            unlink("../assets/img/produk/$pro[foto]"); // Hapus foto lama
            $foto = ", foto='$file_name'";
        } else {
            // Tidak ada file foto baru yang diunggah
            $foto = "";
        }

        $query = mysqli_query($kon, "UPDATE produk SET idkat='$idkat', nama='$nama', harga='$harga', diskon='$diskon', berat='$berat', detail='$detail' $foto WHERE  idproduk='$idproduk' ");
        if ($query) {
            echo "<META HTTP-EQUIV='Refresh' Content='0; URL=?p=produk&alert=2'>";
        }
    }
} else if ($_GET['produk'] == "stok") {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $idproduk = $_POST["idproduk"];
        $stok = $_POST["stok"];

        $produk = mysqli_query($kon, "SELECT * from produk where idproduk='$idproduk'");
        $pro = mysqli_fetch_array($produk);
        $total = $pro['stok'] + $stok;
        $query = mysqli_query($kon, "UPDATE produk SET stok='$total' WHERE  idproduk='$idproduk' ");
    }
} else if ($_GET['p'] == "aksi" and $_GET['form'] == "delete_produk") {

    $produk = mysqli_query($kon, "SELECT * from produk where idproduk='$_GET[id]'");
    $pro = mysqli_fetch_array($produk);
    unlink("../assets/img/produk/$pro[foto]");
    $query = mysqli_query($kon, "DELETE FROM produk WHERE idproduk='$_GET[id]'")
    or die('Ada Kesalahan pada Query Data User:' . mysqli_error($kon));
    if ($query) {
        echo "<META HTTP-EQUIV='Refresh' Content='0; URL=?p=produk&alert=3'>";
    }
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////Validasi Order///////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if ($_GET['p'] == "aksi" and $_GET['order'] == "orderdetail") {
    if (isset($_POST["simpan"])) {
        $id = $_GET['id'];
        $resi = $_POST['nomor'];
        $query = mysqli_query($kon, "INSERT INTO resi (idorder, resi, tglresi)
                VALUES ('$id','$resi',NOW())");

        $sqlo = mysqli_query($kon, "UPDATE orders set statusorder='Dikirim' where idorder='$_GET[id]'");
        if ($sqlo) {
            echo "<META HTTP-EQUIV='Refresh' Content='0; URL=?p=order&st=Dikirim&alert=2'>";
        }
    }
}

if ($_GET['data_set'] == "update") {
    mysqli_query($kon, "TRUNCATE TABLE dataset");
    $a = "INNER JOIN masuk ON anggota.idanggota=masuk.idanggota";
    $data = $kon->query("SELECT * FROM anggota $a");
    foreach ($data as $key) {
        $tot = 0;
        $sqlo = mysqli_query($kon, "SELECT * from orders WHERE idanggota='$key[idanggota]'");
        while ($sl = mysqli_fetch_assoc($sqlo)) {
            $tot += $sl['total'];
        }
        $nyak = mysqli_num_rows($sqlo);

        mysqli_query($kon, "INSERT INTO dataset (nama, recency, frequency, monetary) VALUES ('$key[nama]',' $key[banyak]', '$nyak', '$tot')");
    }
    echo "<META HTTP-EQUIV='Refresh' Content='0; URL=?p=dataset&alert=2'>";
}

if ($_GET['p'] == "aksi" && $_GET['form'] == "info") {
    mysqli_query($kon, "UPDATE info set info='$_POST[info]' where id='1'");
    echo "<META HTTP-EQUIV='Refresh' Content='0; URL=?p=info&alert=2'>";
}