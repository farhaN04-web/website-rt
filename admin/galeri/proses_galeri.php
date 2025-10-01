<?php
session_start();
// PERBAIKAN: Path harus naik DUA level untuk mencapai folder config
include '../../config/koneksi.php';

if (!isset($_SESSION['admin_id'])) {
    die("Akses ditolak.");
}

// --- LOGIKA UNTUK MENYIMPAN FOTO BARU ---
if (isset($_POST['simpan'])) {
    $judul = $_POST['judul_kegiatan'];
    $tanggal = $_POST['tanggal_kegiatan'];
    
    $gambar = $_FILES['gambar']['name'];
    $lokasi_gambar = $_FILES['gambar']['tmp_name'];
    $nama_unik_gambar = uniqid() . '_' . $gambar;
    
    // PERBAIKAN: Path untuk memindahkan file harus naik DUA level
    move_uploaded_file($lokasi_gambar, '../../assets/img/' . $nama_unik_gambar);

    $stmt = mysqli_prepare($koneksi, "INSERT INTO galeri (judul_kegiatan, url_gambar, tanggal_kegiatan) VALUES (?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sss", $judul, $nama_unik_gambar, $tanggal);
    
    if (mysqli_stmt_execute($stmt)) {
        // PERBAIKAN: Redirect ke file di folder yang sama
        header("Location: kelola_galeri.php?status=sukses");
    } else {
        header("Location: kelola_galeri.php?status=gagal");
    }
    mysqli_stmt_close($stmt);
}

// --- LOGIKA UNTUK MEMPERBARUI FOTO ---
elseif (isset($_POST['update'])) {
    $id = $_POST['id'];
    $judul = $_POST['judul_kegiatan'];
    $tanggal = $_POST['tanggal_kegiatan'];
    $gambar_lama = $_POST['gambar_lama'];

    if ($_FILES['gambar']['error'] === 4) {
        $nama_gambar = $gambar_lama;
    } else {
        // PERBAIKAN: Path untuk memeriksa dan menghapus file harus naik DUA level
        if (file_exists("../../assets/img/" . $gambar_lama)) {
            unlink("../../assets/img/" . $gambar_lama);
        }
        $gambar = $_FILES['gambar']['name'];
        $lokasi_gambar = $_FILES['gambar']['tmp_name'];
        $nama_gambar = uniqid() . '_' . $gambar;
        // PERBAIKAN: Path untuk memindahkan file baru juga harus naik DUA level
        move_uploaded_file($lokasi_gambar, '../../assets/img/' . $nama_gambar);
    }
    
    $stmt = mysqli_prepare($koneksi, "UPDATE galeri SET judul_kegiatan = ?, url_gambar = ?, tanggal_kegiatan = ? WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "sssi", $judul, $nama_gambar, $tanggal, $id);

    if (mysqli_stmt_execute($stmt)) {
        // PERBAIKAN: Redirect ke file di folder yang sama
        header("Location: kelola_galeri.php?status=update_sukses");
    } else {
        header("Location: kelola_galeri.php?status=update_gagal");
    }
    mysqli_stmt_close($stmt);
}

else {
    // PERBAIKAN: Path untuk redirect ke dashboard harus naik SATU level
    header("Location: ../dashboard.php");
    exit();
}
?>