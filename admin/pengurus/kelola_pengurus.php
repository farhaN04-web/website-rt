<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../index.php");
    exit();
}
include '../templates/header_admin.php'; 
?>

<div class="container-fluid">
    <h1 class="mt-4">Kelola Data Pengurus</h1>

    <?php
    if(isset($_GET['status'])) {
    }
    ?>
    <a href="tambah_pengurus.php" class="btn btn-success mb-3"><i class="fas fa-plus"></i> Tambah Pengurus Baru</a>
    <div class="card mb-4">
        <div class="card-header">Daftar Pengurus RT</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Foto</th>
                            <th>Nama Lengkap</th>
                            <th>Jabatan</th>
                            <th>Periode</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM pengurus ORDER BY id ASC";
                        $result = mysqli_query($koneksi, $query);
                        $no = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td>
                                <img src="<?= $base_url; ?>assets/img/<?= htmlspecialchars($row['foto'] ?: 'default.png'); ?>" 
                                     alt="Foto <?= htmlspecialchars($row['nama_lengkap']); ?>" width="70" class="img-thumbnail">
                            </td>
                            <td><?= htmlspecialchars($row['nama_lengkap']); ?></td>
                            <td><?= htmlspecialchars($row['jabatan']); ?></td>
                            <td><?= htmlspecialchars($row['periode']); ?></td>
                            <td>
                                <a href="edit_pengurus.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="hapus_pengurus.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm" 
                                   onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                    <i class="fas fa-trash"></i> Hapus
                                </a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include '../templates/footer_admin.php'; ?>