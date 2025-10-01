<?php require_once 'config/koneksi.php'; ?>

<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Website RT 02 RW 02</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="<?= $base_url; ?>assets/css/style.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
<div class="container">
    <a class="navbar-brand" href="<?= $base_url; ?>">
    <img src="<?= $base_url; ?>assets/img/logo-rt.png" alt="Logo RT" width="30" height="24" class="d-inline-block align-text-top">
    RT 02 Modern
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ms-auto">
        <li class="nav-item">
        <a class="nav-link active" href="<?= $base_url; ?>">Beranda</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="profil.php">Profil RT</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="berita.php">Berita</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="galeri.php">Galeri</a>
        </li>
    </ul>
    </div>
</div>
</nav>

<main class="container mt-4"></main>