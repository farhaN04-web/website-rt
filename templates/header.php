<?php 
require_once 'config/koneksi.php'; 

$current_page = basename($_SERVER['PHP_SELF']);
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Website RT 02 RW 02</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
<div class="container">
    <a class="navbar-brand" href="<?= $base_url; ?>">
    <img src="<?= $base_url; ?>assets/img/logo-rt.png" alt="Logo RT" width="30" height="24" class="d-inline-block align-text-top">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ms-auto align-items-center">
        <li class="nav-item">
            <a class="nav-link <?php if($current_page == 'index.php') echo 'active'; ?>" href="<?= $base_url; ?>">Beranda</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php if($current_page == 'profil.php') echo 'active'; ?>" href="profil.php">Profil RT</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php if($current_page == 'berita.php' || $current_page == 'detail_berita.php') echo 'active'; ?>" href="berita.php">Berita</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php if($current_page == 'galeri.php') echo 'active'; ?>" href="galeri.php">Galeri</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php if($current_page == 'layanan.php') echo 'active'; ?>" href="layanan.php">Layanan Warga</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php if($current_page == 'iuran.php') echo 'active'; ?>" href="iuran.php">Iuran Warga</a>
        </li>

        <?php
        $wa_result = mysqli_query($koneksi, "SELECT nilai_pengaturan FROM pengaturan WHERE nama_pengaturan = 'nomor_whatsapp'");
        if($wa_result && mysqli_num_rows($wa_result) > 0){
            $nomor_wa = mysqli_fetch_assoc($wa_result)['nilai_pengaturan'];
            $pesan_default = rawurlencode("Halo, saya ingin bertanya tentang informasi RT 02 RW 02, Rejasari.");
        ?>
            <li class="nav-item ms-lg-3">
                <a href="https://wa.me/<?= htmlspecialchars($nomor_wa); ?>?text=<?= $pesan_default; ?>" 
                class="btn btn-success btn-sm" 
                target="_blank">
                    <i class="fab fa-whatsapp"></i> Hubungi Kami
                </a>
            </li>
        <?php } ?>
        </ul>
    </div>
</div>
</nav>

<main class="container mt-4">