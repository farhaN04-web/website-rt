<?php
session_start();
include '../config/koneksi.php';
if (!isset($_SESSION['admin_id'])) { die("Akses ditolak."); }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nomor_whatsapp = $_POST['nomor_whatsapp'];
    $stmt = mysqli_prepare($koneksi, "UPDATE pengaturan SET nilai_pengaturan = ? WHERE nama_pengaturan = 'nomor_whatsapp'");
    mysqli_stmt_bind_param($stmt, "s", $nomor_whatsapp);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location: pengaturan.php?status=sukses");
}
?>