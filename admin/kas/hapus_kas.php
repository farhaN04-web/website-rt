<?php
session_start();
include '../../config/koneksi.php';
if (!isset($_SESSION['admin_id'])) { die("Akses ditolak."); }

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $stmt = mysqli_prepare($koneksi, "DELETE FROM kas_rt WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    
    if(mysqli_stmt_execute($stmt)){
        header("Location: kelola_kas.php?status=hapus_sukses");
    } else {
        header("Location: kelola_kas.php?status=gagal");
    }
}
?>