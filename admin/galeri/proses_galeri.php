<?php
session_start();
include '../../config/koneksi.php';

if (!isset($_SESSION['admin_id'])) {
    die("Akses ditolak.");
}

if (isset($_POST['simpan'])) {
    $judul = $_POST['judul_kegiatan'];
    $tanggal = $_POST['tanggal_kegiatan'];
    
    $gambar = $_FILES['gambar']['name'];
    $lokasi_gambar = $_FILES['gambar']['tmp_name'];
    $nama_unik_gambar = uniqid() . '_' . $gambar;
    move_uploaded_file($lokasi_gambar, '../../assets/img/' . $nama_unik_gambar);
    $stmt = mysqli_prepare($koneksi, "INSERT INTO galeri (judul_kegiatan, url_gambar, tanggal_kegiatan) VALUES (?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sss", $judul, $nama_unik_gambar, $tanggal);
    
    if (mysqli_stmt_execute($stmt)) {
        header("Location: kelola_galeri.php?status=sukses");
    } else {
        header("Location: kelola_galeri.php?status=gagal");
    }
    mysqli_stmt_close($stmt);
}

elseif (isset($_POST['update'])) {
    $id = $_POST['id'];
    $judul = $_POST['judul_kegiatan'];
    $tanggal = $_POST['tanggal_kegiatan'];
    $gambar_lama = $_POST['gambar_lama'];

    if ($_FILES['gambar']['error'] === 4) {
        $nama_gambar = $gambar_lama;
    } else {
        if (file_exists("../../assets/img/" . $gambar_lama)) {
            unlink("../../assets/img/" . $gambar_lama);
        }
        $gambar = $_FILES['gambar']['name'];
        $lokasi_gambar = $_FILES['gambar']['tmp_name'];
        $nama_gambar = uniqid() . '_' . $gambar;
        move_uploaded_file($lokasi_gambar, '../../assets/img/' . $nama_gambar);
    }
    $stmt = mysqli_prepare($koneksi, "UPDATE galeri SET judul_kegiatan = ?, url_gambar = ?, tanggal_kegiatan = ? WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "sssi", $judul, $nama_gambar, $tanggal, $id);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: kelola_galeri.php?status=update_sukses");
    } else {
        header("Location: kelola_galeri.php?status=update_gagal");
    }
    mysqli_stmt_close($stmt);
}

else {
    header("Location: ../dashboard.php");
    exit();
}
?>