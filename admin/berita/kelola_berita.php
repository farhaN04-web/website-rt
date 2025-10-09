<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: index.php");
    exit();
}
include '../../config/koneksi.php';
include '../templates/header_admin.php';
?>

<div class="container-fluid">
    <h1 class="mt-4">Kelola Berita</h1>
    <a href="tambah_berita.php" class="btn btn-success mb-3">Tambah Berita Baru</a>

    <div class="card mb-4">
        <div class="card-header">Daftar Berita</div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Tanggal Publikasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT id, judul, tanggal_publikasi FROM berita ORDER BY tanggal_publikasi DESC";
                    $result = mysqli_query($koneksi, $query);
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= htmlspecialchars($row['judul']); ?></td>
                        <td><?= date('d M Y', strtotime($row['tanggal_publikasi'])); ?></td>
                        <td>
                            <a href="edit_berita.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="hapus_berita.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus berita ini?')">Hapus</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include '../templates/footer_admin.php'; ?>