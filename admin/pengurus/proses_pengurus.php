<?php
session_start();
include '../../config/koneksi.php';

if (!isset($_SESSION['admin_id'])) {
    die("Akses ditolak.");
}

if (isset($_POST['simpan'])) {
    $nama = $_POST['nama_lengkap'];
    $jabatan = $_POST['jabatan'];
    $periode = $_POST['periode'];
    $nama_foto = ''; 

    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === 0) {
        $foto = $_FILES['foto']['name'];
        $lokasi_foto = $_FILES['foto']['tmp_name'];
        $nama_foto = uniqid() . '_' . $foto;
        move_uploaded_file($lokasi_foto, '../../assets/img/' . $nama_foto);
    }

    $stmt = mysqli_prepare($koneksi, "INSERT INTO pengurus (nama_lengkap, jabatan, periode, foto) VALUES (?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "ssss", $nama, $jabatan, $periode, $nama_foto);
    
    if (mysqli_stmt_execute($stmt)) {
        header("Location: kelola_pengurus.php?status=sukses");
    } else {
        header("Location: kelola_pengurus.php?status=gagal");
    }
    mysqli_stmt_close($stmt);
}

elseif (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama_lengkap'];
    $jabatan = $_POST['jabatan'];
    $periode = $_POST['periode'];
    $foto_lama = $_POST['foto_lama'];
    $nama_foto = $foto_lama;

    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === 0) {
        if (!empty($foto_lama) && file_exists('../../assets/img/' . $foto_lama)) {
            unlink('../../assets/img/' . $foto_lama);
        }
        $foto = $_FILES['foto']['name'];
        $lokasi_foto = $_FILES['foto']['tmp_name'];
        $nama_foto = uniqid() . '_' . $foto;
        move_uploaded_file($lokasi_foto, '../../assets/img/' . $nama_foto);
    }
    $stmt = mysqli_prepare($koneksi, "UPDATE pengurus SET nama_lengkap = ?, jabatan = ?, periode = ?, foto = ? WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "ssssi", $nama, $jabatan, $periode, $nama_foto, $id);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: kelola_pengurus.php?status=update_sukses");
    } else {
        header("Location: kelola_pengurus.php?status=gagal");
    }
    mysqli_stmt_close($stmt);
}

else {
    header("Location: ../dashboard.php");
    exit();
}
?>