<?php
session_start();
include '../../config/koneksi.php';
if (!isset($_SESSION['admin_id'])) { die("Akses ditolak."); }

if (isset($_POST['simpan'])) {
    $tanggal = $_POST['tanggal'];
    $jenis = $_POST['jenis'];
    $jumlah = $_POST['jumlah'];
    $keterangan = $_POST['keterangan'];
    $stmt = mysqli_prepare($koneksi, "INSERT INTO kas_rt (tanggal, keterangan, jenis, jumlah) VALUES (?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sssi", $tanggal, $keterangan, $jenis, $jumlah);
    if(mysqli_stmt_execute($stmt)) {
        header("Location: kelola_kas.php?status=sukses");
    } else {
        header("Location: kelola_kas.php?status=gagal");
    }
}

elseif (isset($_POST['update'])) {
    $id = $_POST['id'];
    $tanggal = $_POST['tanggal'];
    $jenis = $_POST['jenis'];
    $jumlah = $_POST['jumlah'];
    $keterangan = $_POST['keterangan'];
    $stmt = mysqli_prepare($koneksi, "UPDATE kas_rt SET tanggal = ?, keterangan = ?, jenis = ?, jumlah = ? WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "sssii", $tanggal, $keterangan, $jenis, $jumlah, $id);
    if(mysqli_stmt_execute($stmt)) {
        header("Location: kelola_kas.php?status=update_sukses");
    } else {
        header("Location: kelola_kas.php?status=gagal");
    }
}
?>