<?php
session_start();
include '../config/koneksi.php';

// Memastikan hanya admin yang login yang bisa mengakses file ini
if (!isset($_SESSION['admin_id'])) {
    // Menghentikan eksekusi dan memberi pesan jika diakses tanpa login
    die("Akses ditolak. Silakan login terlebih dahulu.");
}

// ==========================================================
// LOGIKA UNTUK MENYIMPAN BERITA BARU (CREATE)
// ==========================================================
if (isset($_POST['simpan'])) {
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];
    $penulis = $_POST['penulis'];
    
    // Proses upload gambar
    $gambar = $_FILES['gambar']['name'];
    $lokasi_gambar = $_FILES['gambar']['tmp_name'];
    // Membuat nama file yang unik untuk mencegah nama file yang sama
    $nama_unik_gambar = uniqid() . '_' . $gambar;
    
    // Pindahkan gambar yang diupload ke folder tujuan
    move_uploaded_file($lokasi_gambar, '../assets/img/' . $nama_unik_gambar);

    // Simpan ke database menggunakan prepared statement untuk keamanan
    $stmt = mysqli_prepare($koneksi, "INSERT INTO berita (judul, isi, gambar, penulis) VALUES (?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "ssss", $judul, $isi, $nama_unik_gambar, $penulis);
    
    if (mysqli_stmt_execute($stmt)) {
        // Jika berhasil, redirect ke halaman kelola berita dengan status sukses
        header("Location: berita/kelola_berita.php?status=sukses");
    } else {
        // Jika gagal, redirect dengan status gagal
        header("Location: berita/kelola_berita.php?status=gagal");
    }
    mysqli_stmt_close($stmt);
}


// ==========================================================
// LOGIKA UNTUK MEMPERBARUI BERITA (UPDATE)
// ==========================================================
elseif (isset($_POST['update'])) {
    $id = $_POST['id'];
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];
    $gambar_lama = $_POST['gambar_lama'];

    // Cek apakah admin mengupload gambar baru atau tidak
    // 'error' === 4 berarti tidak ada file yang diupload
    if ($_FILES['gambar']['error'] === 4) {
        $nama_gambar = $gambar_lama; // Gunakan nama gambar yang lama
    } else {
        // Jika ada gambar baru, hapus gambar lama dari server untuk menghemat ruang
        if (file_exists("../assets/img/" . $gambar_lama)) {
            unlink("../assets/img/" . $gambar_lama);
        }
        
        // Proses upload gambar baru
        $gambar = $_FILES['gambar']['name'];
        $lokasi_gambar = $_FILES['gambar']['tmp_name'];
        $nama_gambar = uniqid() . '_' . $gambar;
        move_uploaded_file($lokasi_gambar, '../assets/img/' . $nama_gambar);
    }
    
    // Update data ke database menggunakan prepared statement
    $stmt = mysqli_prepare($koneksi, "UPDATE berita SET judul = ?, isi = ?, gambar = ? WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "sssi", $judul, $isi, $nama_gambar, $id);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: berita/kelola_berita.php?status=update_sukses");
    } else {
        header("Location: berita/kelola_berita.php?status=update_gagal");
    }
    mysqli_stmt_close($stmt);
}

// Jika file diakses tanpa melalui tombol 'simpan' atau 'update', redirect ke dashboard
else {
    header("Location: dashboard.php");
    exit();
}
?>