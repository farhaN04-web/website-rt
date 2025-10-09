<?php
session_start();
if (!isset($_SESSION['admin_id'])) { header("Location: index.php"); exit(); }
include 'templates/header_admin.php';
$query = mysqli_query($koneksi, "SELECT * FROM pengaturan");
$pengaturan = [];
while($row = mysqli_fetch_assoc($query)){
    $pengaturan[$row['nama_pengaturan']] = $row['nilai_pengaturan'];
}
?>

<div class="container-fluid">
    <h1 class="mt-4">Pengaturan Website</h1>
    <?php if(isset($_GET['status']) && $_GET['status'] == 'sukses'): ?>
        <div class="alert alert-success">Pengaturan berhasil diperbarui!</div>
    <?php endif; ?>

    <div class="card">
        <div class="card-body">
            <form action="proses_pengaturan.php" method="POST">
                <div class="mb-3">
                    <label for="nomor_whatsapp" class="form-label">Nomor WhatsApp</label>
                    <input type="text" class="form-control" name="nomor_whatsapp" 
                           value="<?= htmlspecialchars($pengaturan['nomor_whatsapp'] ?? ''); ?>">
                    <small class="text-muted">Gunakan format 62 (contoh: 6281234567890)</small>
                </div>
                <button type="submit" class="btn btn-primary">Simpan Pengaturan</button>
            </form>
        </div>
    </div>
</div>

<?php include 'templates/footer_admin.php'; ?>