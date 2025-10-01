<?php
session_start();
// PERBAIKAN: Path harus naik DUA level untuk mencapai folder config
include '../../config/koneksi.php';

if (!isset($_SESSION['admin_id'])) {
    die("Akses ditolak.");
}

// --- LOGIKA SIMPAN DATA BARU ---
if (isset($_POST['simpan'])) {
    $nama = $_POST['nama_lengkap'];
    $jabatan = $_POST['jabatan'];
    $periode = $_POST['periode'];
    $nama_foto = ''; 

    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === 0) {
        $foto = $_FILES['foto']['name'];
        $lokasi_foto = $_FILES['foto']['tmp_name'];
        $nama_foto = uniqid() . '_' . $foto;
        // PERBAIKAN: Path untuk memindahkan file harus naik DUA level
        move_uploaded_file($lokasi_foto, '../../assets/img/' . $nama_foto);
    }

    $stmt = mysqli_prepare($koneksi, "INSERT INTO pengurus (nama_lengkap, jabatan, periode, foto) VALUES (?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "ssss", $nama, $jabatan, $periode, $nama_foto);
    
    if (mysqli_stmt_execute($stmt)) {
        // PERBAIKAN: Redirect ke file di folder yang sama
        header("Location: kelola_pengurus.php?status=sukses");
    } else {
        header("Location: kelola_pengurus.php?status=gagal");
    }
    mysqli_stmt_close($stmt);
}

// --- LOGIKA UPDATE DATA ---
elseif (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama_lengkap'];
    $jabatan = $_POST['jabatan'];
    $periode = $_POST['periode'];
    $foto_lama = $_POST['foto_lama'];
    $nama_foto = $foto_lama;

    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === 0) {
        // PERBAIKAN: Path untuk memeriksa dan menghapus file harus naik DUA level
        if (!empty($foto_lama) && file_exists('../../assets/img/' . $foto_lama)) {
            unlink('../../assets/img/' . $foto_lama);
        }
        $foto = $_FILES['foto']['name'];
        $lokasi_foto = $_FILES['foto']['tmp_name'];
        $nama_foto = uniqid() . '_' . $foto;
        // PERBAIKAN: Path untuk memindahkan file baru juga harus naik DUA level
        move_uploaded_file($lokasi_foto, '../../assets/img/' . $nama_foto);
    }

    $stmt = mysqli_prepare($koneksi, "UPDATE pengurus SET nama_lengkap = ?, jabatan = ?, periode = ?, foto = ? WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "ssssi", $nama, $jabatan, $periode, $nama_foto, $id);

    if (mysqli_stmt_execute($stmt)) {
        // PERBAIKAN: Redirect ke file di folder yang sama
        header("Location: kelola_pengurus.php?status=update_sukses");
    } else {
        header("Location: kelola_pengurus.php?status=gagal");
    }
    mysqli_stmt_close($stmt);
}

else {
    // PERBAIKAN: Path untuk redirect ke dashboard harus naik SATU level
    header("Location: ../dashboard.php");
    exit();
}
?>