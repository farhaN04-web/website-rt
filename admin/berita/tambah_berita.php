<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../index.php");
    exit();
}
include '../templates/header_admin.php';
?>

<div class="container-fluid">
    <h1 class="mt-4">Tambah Berita Baru</h1>

    <div class="card mb-4">
        <div class="card-body">
            <form action="proses_berita.php" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="judul" class="form-label">Judul Berita</label>
                    <input type="text" class="form-control" id="judul" name="judul" required>
                </div>
                <div class="mb-3">
                    <label for="isi" class="form-label">Isi Berita</label>
                    <textarea class="form-control" id="isi" name="isi" rows="10" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="gambar" class="form-label">Gambar Utama</label>
                    <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*">
                </div>
                <input type="hidden" name="penulis" value="<?= htmlspecialchars($_SESSION['admin_username']); ?>">
                <button type="submit" name="simpan" class="btn btn-primary">Simpan Berita</button>
                <a href="kelola_berita.php" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>

<?php
include '../templates/footer_admin.php'; 
?>