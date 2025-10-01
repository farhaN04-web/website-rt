<?php
session_start();
include '../config/koneksi.php';

if (!isset($_SESSION['admin_id'])) {
    die("Akses ditolak.");
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Langkah 1: Ambil nama file gambar dari database
    $stmt_select = mysqli_prepare($koneksi, "SELECT url_gambar FROM galeri WHERE id = ?");
    mysqli_stmt_bind_param($stmt_select, "i", $id);
    mysqli_stmt_execute($stmt_select);
    $result = mysqli_stmt_get_result($stmt_select);
    if ($data = mysqli_fetch_assoc($result)) {
        $gambar_dihapus = $data['url_gambar'];
        
        // Langkah 2: Hapus file gambar dari folder assets/img
        if (file_exists("../assets/img/" . $gambar_dihapus)) {
            unlink("../assets/img/" . $gambar_dihapus);
        }
    }
    mysqli_stmt_close($stmt_select);

    // Langkah 3: Hapus record dari database
    $stmt_delete = mysqli_prepare($koneksi, "DELETE FROM galeri WHERE id = ?");
    mysqli_stmt_bind_param($stmt_delete, "i", $id);
    
    if (mysqli_stmt_execute($stmt_delete)) {
        header("Location: galeri/kelola_galeri.php?status=hapus_sukses");
    } else {
        header("Location: galeri/kelola_galeri.php?status=gagal");
    }
    mysqli_stmt_close($stmt_delete);

} else {
    header("Location: galeri/kelola_galeri.php");
}
?>