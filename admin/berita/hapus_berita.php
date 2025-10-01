<?php
session_start();
// PERBAIKAN: Path harus naik DUA level untuk mencapai folder config
include '../../config/koneksi.php';

if (!isset($_SESSION['admin_id'])) {
    die("Akses ditolak.");
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // 1. Ambil nama file gambar dari database
    $stmt_select = mysqli_prepare($koneksi, "SELECT gambar FROM berita WHERE id = ?");
    mysqli_stmt_bind_param($stmt_select, "i", $id);
    mysqli_stmt_execute($stmt_select);
    $result = mysqli_stmt_get_result($stmt_select);
    if ($data = mysqli_fetch_assoc($result)) {
        $gambar_untuk_dihapus = $data['gambar'];
        
        // 2. Hapus file gambar dari folder
        // PERBAIKAN: Path untuk memeriksa dan menghapus file harus naik DUA level
        if (file_exists("../../assets/img/" . $gambar_untuk_dihapus)) {
            unlink("../../assets/img/" . $gambar_untuk_dihapus);
        }
    }
    mysqli_stmt_close($stmt_select);

    // 3. Hapus record dari database
    $stmt_delete = mysqli_prepare($koneksi, "DELETE FROM berita WHERE id = ?");
    mysqli_stmt_bind_param($stmt_delete, "i", $id);
    
    if (mysqli_stmt_execute($stmt_delete)) {
        // Path ini sudah benar karena file tujuan ada di folder yang sama
        header("Location: kelola_berita.php?status=hapus_sukses");
    } else {
        header("Location: kelola_berita.php?status=hapus_gagal");
    }
    mysqli_stmt_close($stmt_delete);

} else {
    header("Location: kelola_berita.php");
}
?>