<?php
session_start();
// PERBAIKAN: Path harus naik DUA level untuk mencapai folder config
include '../../config/koneksi.php';

if (!isset($_SESSION['admin_id'])) {
    die("Akses ditolak. Silakan login terlebih dahulu.");
}

// --- LOGIKA SIMPAN BERITA BARU ---
if (isset($_POST['simpan'])) {
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];
    $penulis = $_POST['penulis'];
    $gambar = $_FILES['gambar']['name'];
    $lokasi_gambar = $_FILES['gambar']['tmp_name'];
    $nama_unik_gambar = uniqid() . '_' . $gambar;

    // PERBAIKAN: Path untuk memindahkan file harus naik DUA level
    move_uploaded_file($lokasi_gambar, '../../assets/img/' . $nama_unik_gambar);

    $stmt = mysqli_prepare($koneksi, "INSERT INTO berita (judul, isi, gambar, penulis) VALUES (?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "ssss", $judul, $isi, $nama_unik_gambar, $penulis);
    
    if (mysqli_stmt_execute($stmt)) {
        // Path ini sudah benar karena mengarah ke file di folder yang sama
        header("Location: kelola_berita.php?status=sukses");
    } else {
        header("Location: kelola_berita.php?status=gagal");
    }
    mysqli_stmt_close($stmt);
}

// --- LOGIKA UPDATE BERITA ---
elseif (isset($_POST['update'])) {
    $id = $_POST['id'];
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];
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
    $stmt = mysqli_prepare($koneksi, "UPDATE berita SET judul = ?, isi = ?, gambar = ? WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "sssi", $judul, $isi, $nama_gambar, $id);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: kelola_berita.php?status=update_sukses");
    } else {
        header("Location: kelola_berita.php?status=update_gagal");
    }
    mysqli_stmt_close($stmt);
}

// --- LOGIKA JIKA DIAKSES LANGSUNG ---
else {
    // PERBAIKAN: Path untuk redirect ke dashboard harus naik SATU level
    header("Location: ../dashboard.php");
    exit();
}
?>