<!DOCTYPE html>
<html lang="zxx">
<?php
session_start();
include "include/koneksi.php";
include "include/function.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
$sqlag = mysqli_query($kon, "SELECT * from anggota where idanggota='$_SESSION[idanggota]' ");
$rag = mysqli_fetch_array($sqlag);
$idanggota = $_SESSION['idanggota'];
?>

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ogani | Template</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="assets/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="assets/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="assets/css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="assets/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="assets/css/style.css" type="text/css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>


    <?php include "menu.php" ?>
    <?php
    if (!empty($_GET["p"])) {

        include_once($_GET["p"] . ".php");
    } else {

        include "home.php";
        include "produkterbaru.php";
    }
    ?>

    <!-- Footer Section Begin -->
    <?php include "footer.php" ?>
    <!-- Footer Section End -->

    <!-- Js Plugins -->




    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery-ui.min.js"></script>
    <script src="assets/js/jquery.slicknav.js"></script>
    <script src="assets/js/mixitup.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/main.js"></script>

    <!-- Tautan ke script Toastr -->


    <!-- Panggil kode Toastr setelah memuat script Toastr -->

</body>

</html>