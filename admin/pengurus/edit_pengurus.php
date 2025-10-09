<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../index.php");
    exit();
}
include '../templates/header_admin.php';
if (!isset($_GET['id'])) {
    header("Location: kelola_pengurus.php");
    exit();
}
$id = $_GET['id'];

$stmt = mysqli_prepare($koneksi, "SELECT * FROM pengurus WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_assoc($result);
if (!$data) {
    echo "<div class='alert alert-danger'>Data pengurus tidak ditemukan.</div>";
    include '../templates/footer_admin.php';
    exit();
}
?>

<div class="container-fluid">
    <h1 class="mt-4">Edit Data Pengurus</h1>
    <div class="card mb-4">
        <div class="card-body">
            <form action="proses_pengurus.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $data['id']; ?>">
                <input type="hidden" name="foto_lama" value="<?= htmlspecialchars($data['foto']); ?>">

                <div class="mb-3">
                    <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?= htmlspecialchars($data['nama_lengkap']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="jabatan" class="form-label">Jabatan</label>
                    <input type="text" class="form-control" id="jabatan" name="jabatan" value="<?= htmlspecialchars($data['jabatan']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="periode" class="form-label">Periode</label>
                    <input type="text" class="form-control" id="periode" name="periode" value="<?= htmlspecialchars($data['periode']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="foto" class="form-label">Ganti Foto</label><br>
                    <img src="<?= $base_url; ?>assets/img/<?= htmlspecialchars($data['foto'] ?: 'default.png'); ?>" width="100" class="img-thumbnail mb-2">
                    <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
                    <small class="text-muted">Kosongkan jika tidak ingin mengubah foto.</small>
                </div>
                <button type="submit" name="update" class="btn btn-primary">Update Data</button>
                <a href="kelola_pengurus.php" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>

<?php include '../templates/footer_admin.php'; ?>