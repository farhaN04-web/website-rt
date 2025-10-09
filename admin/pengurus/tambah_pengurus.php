<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../index.php");
    exit();
}

include '../templates/header_admin.php';
?>

<div class="container-fluid">
    <h1 class="mt-4">Tambah Data Pengurus Baru</h1>
    <div class="card mb-4">
        <div class="card-body">
            <form action="proses_pengurus.php" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required>
                </div>
                <div class="mb-3">
                    <label for="jabatan" class="form-label">Jabatan</label>
                    <input type="text" class="form-control" id="jabatan" name="jabatan" placeholder="Contoh: Ketua RT, Bendahara" required>
                </div>
                <div class="mb-3">
                    <label for="periode" class="form-label">Periode</label>
                    <input type="text" class="form-control" id="periode" name="periode" placeholder="Contoh: 2024-2027" required>
                </div>
                <div class="mb-3">
                    <label for="foto" class="form-label">Foto Pengurus</label>
                    <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
                    <small class="text-muted">Opsional. Foto bisa ditambahkan nanti.</small>
                </div>
                <button type="submit" name="simpan" class="btn btn-primary">Simpan Data</button>
                <a href="kelola_pengurus.php" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>

<?php
include '../templates/footer_admin.php'; 
?>