<?php
session_start();
include '../../config/koneksi.php';
if (!isset($_SESSION['admin_id'])) { die("Akses ditolak."); }

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt_select = mysqli_prepare($koneksi, "SELECT nama_file FROM dokumen WHERE id = ?");
    mysqli_stmt_bind_param($stmt_select, "i", $id);
    mysqli_stmt_execute($stmt_select);
    $result = mysqli_stmt_get_result($stmt_select);
    if ($data = mysqli_fetch_assoc($result)) {
        $file_dihapus = $data['nama_file'];
        if (file_exists("../../dokumen/" . $file_dihapus)) {
            unlink("../../dokumen/" . $file_dihapus);
        }
    }
    $stmt_delete = mysqli_prepare($koneksi, "DELETE FROM dokumen WHERE id = ?");
    mysqli_stmt_bind_param($stmt_delete, "i", $id);
    mysqli_stmt_execute($stmt_delete);
    header("Location: kelola_dokumen.php?status=hapus_sukses");
}
?>