<?php
require_once "../include/koneksi.php";
$username = mysqli_real_escape_string($kon, stripslashes(strip_tags(htmlspecialchars(trim($_POST['username'])))));
$password = mysqli_real_escape_string($kon, stripslashes(strip_tags(htmlspecialchars(trim($_POST['password'])))));
if (!ctype_alnum($username) or !ctype_alnum($password)) {
    header("Location: index.php?alert=4");
} else {
    $query = mysqli_query($kon, "SELECT * FROM admin WHERE username='$username' AND  password='$password' AND status='Aktif'");
    $row = mysqli_num_rows($query);
    if ($row > 0) {
        $data = mysqli_fetch_array($query);
        session_start();
        $_SESSION['idadmin']    = $data['idadmin'];
        $_SESSION['username']   = $data['username'];
        $_SESSION['password']   = $data['password'];
        $_SESSION['namalengkap'] = $data['namalengkap'];
        header("Location: main.php?p=home");
    } else {
        header("Location: index.php?alert=5");
    }
}
