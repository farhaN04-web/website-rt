<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../index.php"); 
    exit();
}
include '../../config/koneksi.php'; 
include '../templates/header_admin.php';
?>

<div class="container-fluid">
    <h1 class="mt-4">Kelola Galeri Kegiatan</h1>

    <?php
    if(isset($_GET['status'])):
        $status = $_GET['status'];
        $alert_class = ($status == 'sukses' || $status == 'update_sukses' || $status == 'hapus_sukses') ? 'alert-success' : 'alert-danger';
        $message = '';
        if($status == 'sukses') $message = 'Foto baru berhasil ditambahkan!';
        if($status == 'update_sukses') $message = 'Data foto berhasil diperbarui!';
        if($status == 'hapus_sukses') $message = 'Foto berhasil dihapus!';
        if($status == 'gagal') $message = 'Terjadi kesalahan!';
        echo "<div class='alert $alert_class'>$message</div>";
    endif;
    ?>

    <a href="tambah_foto.php" class="btn btn-success mb-3">Tambah Foto Baru</a>

    <div class="card mb-4">
        <div class="card-header">Daftar Foto Kegiatan</div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Foto</th>
                        <th>Judul Kegiatan</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM galeri ORDER BY tanggal_kegiatan DESC";
                    $result = mysqli_query($koneksi, $query);
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><img src="<?= $base_url; ?>assets/img/<?= htmlspecialchars($row['url_gambar']); ?>" width="100"></td>
                        <td><?= htmlspecialchars($row['judul_kegiatan']); ?></td>
                        <td><?= date('d M Y', strtotime($row['tanggal_kegiatan'])); ?></td>
                        <td>
                            <a href="edit_foto.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="hapus_foto.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus foto ini?')">Hapus</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
include '../templates/footer_admin.php'; 
?>