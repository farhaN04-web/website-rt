<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../index.php");
    exit();
}
include '../../config/koneksi.php';
include '../templates/header_admin.php';
$id = $_GET['id'];
$stmt = mysqli_prepare($koneksi, "SELECT * FROM berita WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_assoc($result);
?>

<div class="container-fluid">
    <h1 class="mt-4">Edit Berita</h1>

    <div class="card mb-4">
        <div class="card-body">
            <form action="proses_berita.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $data['id']; ?>">
                <input type="hidden" name="gambar_lama" value="<?= $data['gambar']; ?>">

                <div class="mb-3">
                    <label for="judul" class="form-label">Judul Berita</label>
                    <input type="text" class="form-control" id="judul" name="judul" value="<?= htmlspecialchars($data['judul']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="isi" class="form-label">Isi Berita</label>
                    <textarea class="form-control" id="isi" name="isi" rows="10" required><?= htmlspecialchars($data['isi']); ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="gambar" class="form-label">Gambar Utama</label><br>
                    <img src="<?= $base_url; ?>assets/img/<?= htmlspecialchars($data['gambar']); ?>" width="150" class="mb-2">
                    <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*">
                    <small class="text-muted">Kosongkan jika tidak ingin mengubah gambar.</small>
                </div>
                
                <button type="submit" name="update" class="btn btn-primary">Update Berita</button>
                <a href="kelola_berita.php" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>

<?php
include '../templates/footer_admin.php'; 
?>