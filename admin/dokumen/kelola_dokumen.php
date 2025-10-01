<?php
session_start();
if (!isset($_SESSION['admin_id'])) { header("Location: ../index.php"); exit(); }
include '../../config/koneksi.php';
include '../templates/header_admin.php';
?>
<div class="container-fluid">
    <h1 class="mt-4">Kelola Dokumen & Formulir</h1>
    <a href="tambah_dokumen.php" class="btn btn-success mb-3">Tambah Dokumen Baru</a>
    <div class="card mb-4">
        <div class="card-header">Daftar Dokumen</div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama Dokumen</th>
                        <th>Deskripsi</th>
                        <th>Nama File</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = mysqli_query($koneksi, "SELECT * FROM dokumen ORDER BY id DESC");
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td><?= htmlspecialchars($row['nama_dokumen']); ?></td>
                        <td><?= htmlspecialchars($row['deskripsi']); ?></td>
                        <td><?= htmlspecialchars($row['nama_file']); ?></td>
                        <td>
                            <a href="hapus_dokumen.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin?')">Hapus</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include '../templates/footer_admin.php'; ?>