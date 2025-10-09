<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../index.php");
    exit();
}
include '../../config/koneksi.php';
include '../templates/header_admin.php';

if (!isset($_GET['id'])) {
    header("Location: kelola_galeri.php");
    exit();
}
$id = $_GET['id'];
$stmt = mysqli_prepare($koneksi, "SELECT * FROM galeri WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    echo "<div class='alert alert-danger'>Data tidak ditemukan.</div>";
    include '../templates/footer_admin.php';
    exit();
}
?>

<div class="container-fluid">
    <h1 class="mt-4">Edit Foto Kegiatan</h1>
    <div class="card mb-4">
        <div class="card-body">
            <form action="proses_galeri.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $data['id']; ?>">
                <input type="hidden" name="gambar_lama" value="<?= htmlspecialchars($data['url_gambar']); ?>">
                <div class="mb-3">
                    <label for="judul_kegiatan" class="form-label">Judul Kegiatan</label>
                    <input type="text" class="form-control" id="judul_kegiatan" name="judul_kegiatan" value="<?= htmlspecialchars($data['judul_kegiatan']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="tanggal_kegiatan" class="form-label">Tanggal Kegiatan</label>
                    <input type="date" class="form-control" id="tanggal_kegiatan" name="tanggal_kegiatan" value="<?= htmlspecialchars($data['tanggal_kegiatan']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="gambar" class="form-label">Pilih Foto Baru</label><br>
                    <img src="<?= $base_url; ?>assets/img/<?= htmlspecialchars($data['url_gambar']); ?>" width="200" class="img-thumbnail mb-2">
                    <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*">
                    <small class="text-muted">Kosongkan jika tidak ingin mengubah foto.</small>
                </div>
                
                <button type="submit" name="update" class="btn btn-primary">Update Foto</button>
                <a href="kelola_galeri.php" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>

<?php
include '../templates/footer_admin.php'; 
?>