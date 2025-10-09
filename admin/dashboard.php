<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: index.php");
    exit();
}
include 'templates/header_admin.php';
$total_berita = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(id) AS total FROM berita"))['total'];
$total_foto = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(id) AS total FROM galeri"))['total'];
$total_pengurus = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(id) AS total FROM pengurus"))['total'];
?>

<div class="container-fluid">
    <h1 class="mt-4 mb-4">Dashboard</h1>
    <div class="row">
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Berita</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_berita; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-newspaper fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
                <a href="berita/kelola_berita.php" class="card-footer text-decoration-none">
                    <span class="float-start">Lihat Detail</span>
                    <span class="float-end"><i class="fas fa-arrow-circle-right"></i></span>
                </a>
            </div>
        </div>
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Foto Galeri</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_foto; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-images fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
                <a href="galeri/kelola_galeri.php" class="card-footer text-decoration-none">
                    <span class="float-start">Lihat Detail</span>
                    <span class="float-end"><i class="fas fa-arrow-circle-right"></i></span>
                </a>
            </div>
        </div>
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Pengurus</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_pengurus; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
                <a href="pengurus/kelola_pengurus.php" class="card-footer text-decoration-none">
                    <span class="float-start">Lihat Detail</span>
                    <span class="float-end"><i class="fas fa-arrow-circle-right"></i></span>
                </a>
            </div>
        </div>
    </div>

    <div class="alert alert-info mt-4">
        Selamat datang, <strong><?= htmlspecialchars($_SESSION['admin_username']); ?></strong>! Anda dapat mengelola seluruh konten website dari halaman ini.
    </div>
</div>

<?php
include 'templates/footer_admin.php';
?>