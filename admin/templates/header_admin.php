<?php
$current_uri = $_SERVER['REQUEST_URI']; 
require_once __DIR__ . '/../../config/koneksi.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Website RT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body { display: flex; min-height: 100vh; flex-direction: column; background-color: #f4f7f6; }
        .main-content { flex: 1; }
        .navbar { box-shadow: 0 2px 4px rgba(0,0,0,.1); }
        .navbar-nav .nav-link.active { font-weight: bold; color: #ffffff; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= $base_url; ?>admin/dashboard.php">
            <i class="fas fa-user-shield"></i> Admin Panel RT
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="adminNavbar">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link <?php if(strpos($current_uri, 'dashboard.php') !== false) echo 'active'; ?>" href="<?= $base_url; ?>admin/dashboard.php">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if(strpos($current_uri, '/berita/') !== false) echo 'active'; ?>" href="<?= $base_url; ?>admin/berita/kelola_berita.php">
                        <i class="fas fa-newspaper"></i> Berita
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if(strpos($current_uri, '/galeri/') !== false) echo 'active'; ?>" href="<?= $base_url; ?>admin/galeri/kelola_galeri.php">
                        <i class="fas fa-images"></i> Galeri
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if(strpos($current_uri, '/pengurus/') !== false) echo 'active'; ?>" href="<?= $base_url; ?>admin/pengurus/kelola_pengurus.php">
                        <i class="fas fa-users"></i> Pengurus
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if(strpos($current_uri, '/dokumen/') !== false) echo 'active'; ?>" href="<?= $base_url; ?>admin/dokumen/kelola_dokumen.php">
                        <i class="fas fa-file-alt"></i> Dokumen
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if(strpos($current_uri, '/kas/') !== false) echo 'active'; ?>" href="<?= $base_url; ?>admin/kas/kelola_kas.php">
                        <i class="fas fa-wallet"></i> Kas
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if(strpos($current_uri, 'pengaturan.php') !== false) echo 'active'; ?>" href="<?= $base_url; ?>admin/pengaturan.php">
                        <i class="fas fa-cogs"></i> Pengaturan
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="btn btn-outline-danger" href="<?= $base_url; ?>admin/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="main-content container-fluid p-4">