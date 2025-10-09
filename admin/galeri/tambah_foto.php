<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../index.php");
    exit();
}
include '../templates/header_admin.php';
?>

<div class="container-fluid">
    <h1 class="mt-4">Tambah Foto Kegiatan Baru</h1>
    <div class="card mb-4">
        <div class="card-body">
            <form action="proses_galeri.php" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="judul_kegiatan" class="form-label">Judul Kegiatan</label>
                    <input type="text" class="form-control" id="judul_kegiatan" name="judul_kegiatan" required>
                </div>
                <div class="mb-3">
                    <label for="tanggal_kegiatan" class="form-label">Tanggal Kegiatan</label>
                    <input type="date" class="form-control" id="tanggal_kegiatan" name="tanggal_kegiatan" required>
                </div>
                <div class="mb-3">
                    <label for="gambar" class="form-label">Pilih Foto</label>
                    <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*" required>
                </div>
                <button type="submit" name="simpan" class="btn btn-primary">Simpan Foto</button>
                <a href="kelola_galeri.php" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>

<?php 
include '../templates/footer_admin.php'; 
?>