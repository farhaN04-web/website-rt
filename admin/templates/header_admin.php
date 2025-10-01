<?php
// Ambil nama file saat ini dari URL
$current_page = basename($_SERVER['PHP_SELF']);
require_once '../config/koneksi.php';
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
        /* Style untuk menu yang aktif */
        .navbar-nav .nav-link.active { font-weight: bold; color: #ffffff; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="dashboard.php">
            <i class="fas fa-user-shield"></i> Admin Panel RT
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="adminNavbar">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link <?php if($current_page == 'dashboard.php') echo 'active'; ?>" href="dashboard.php">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if($current_page == 'kelola_berita.php') echo 'active'; ?>" href="kelola_berita.php">
                        <i class="fas fa-newspaper"></i> Berita
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if($current_page == 'kelola_galeri.php') echo 'active'; ?>" href="kelola_galeri.php">
                        <i class="fas fa-images"></i> Galeri
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if($current_page == 'kelola_pengurus.php') echo 'active'; ?>" href="kelola_pengurus.php">
                        <i class="fas fa-users"></i> Pengurus
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="btn btn-outline-danger" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="main-content container-fluid p-4">