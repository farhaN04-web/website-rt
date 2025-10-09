<?php
session_start();
include '../../config/koneksi.php';
if (!isset($_SESSION['admin_id'])) { die("Akses ditolak."); }

if (isset($_POST['simpan'])) {
    $nama_dokumen = $_POST['nama_dokumen'];
    $deskripsi = $_POST['deskripsi'];

    $file = $_FILES['file']['name'];
    $lokasi_file = $_FILES['file']['tmp_name'];
    $nama_unik_file = uniqid() . '_' . $file;

    move_uploaded_file($lokasi_file, '../../dokumen/' . $nama_unik_file);

    $stmt = mysqli_prepare($koneksi, "INSERT INTO dokumen (nama_dokumen, deskripsi, nama_file) VALUES (?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sss", $nama_dokumen, $deskripsi, $nama_unik_file);

    if(mysqli_stmt_execute($stmt)) {
        header("Location: kelola_dokumen.php?status=sukses");
    } else {
        header("Location: kelola_dokumen.php?status=gagal");
    }
}
?>