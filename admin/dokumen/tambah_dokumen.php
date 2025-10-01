<?php
session_start();
if (!isset($_SESSION['admin_id'])) { header("Location: ../index.php"); exit(); }
include '../templates/header_admin.php';
?>
<div class="container-fluid">
    <h1 class="mt-4">Tambah Dokumen Baru</h1>
    <div class="card">
        <div class="card-body">
            <form action="proses_dokumen.php" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="nama_dokumen" class="form-label">Nama Dokumen</label>
                    <input type="text" name="nama_dokumen" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi Singkat</label>
                    <textarea name="deskripsi" class="form-control"></textarea>
                </div>
                <div class="mb-3">
                    <label for="file" class="form-label">Pilih File (PDF/DOCX/JPG)</label>
                    <input type="file" name="file" class="form-control" required>
                </div>
                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
<?php include '../templates/footer_admin.php'; ?>