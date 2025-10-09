<?php
session_start();
if (!isset($_SESSION['admin_id'])) { header("Location: ../index.php"); exit(); }
include '../../config/koneksi.php';
include '../templates/header_admin.php';
?>

<div class="container-fluid">
    <h1 class="mt-4">Kelola Kas RT</h1>
    
    <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#tambahKasModal">
        <i class="fas fa-plus"></i> Tambah Transaksi Baru
    </button>
    
    <?php
    if(isset($_GET['status'])):
    endif;
    ?>
    <div class="card mb-4">
        <div class="card-header">Daftar Transaksi</div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Tanggal</th>
                        <th>Keterangan</th>
                        <th>Jenis</th>
                        <th>Jumlah</th>
                        <th>Aksi</th> </tr>
                </thead>
                <tbody>
                    <?php
                    $result_kas = mysqli_query($koneksi, "SELECT * FROM kas_rt ORDER BY tanggal DESC");
                    while($kas = mysqli_fetch_assoc($result_kas)) {
                    ?>
                    <tr>
                        <td><?= date('d M Y', strtotime($kas['tanggal'])); ?></td>
                        <td><?= htmlspecialchars($kas['keterangan']); ?></td>
                        <td>
                            <span class="badge bg-<?= ($kas['jenis'] == 'Pemasukan') ? 'success' : 'danger'; ?>">
                                <?= $kas['jenis']; ?>
                            </span>
                        </td>
                        <td>Rp <?= number_format($kas['jumlah'], 0, ',', '.'); ?></td>
                        <td>
                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" 
                                    data-bs-target="#editKasModal" 
                                    data-id="<?= $kas['id']; ?>"
                                    data-tanggal="<?= $kas['tanggal']; ?>"
                                    data-jenis="<?= $kas['jenis']; ?>"
                                    data-jumlah="<?= $kas['jumlah']; ?>"
                                    data-keterangan="<?= htmlspecialchars($kas['keterangan']); ?>">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <a href="hapus_kas.php?id=<?= $kas['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus transaksi ini?')">
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

<div class="modal fade" id="tambahKasModal" tabindex="-1">
    </div>

<div class="modal fade" id="editKasModal" tabindex="-1" aria-labelledby="editKasModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editKasModalLabel">Form Edit Transaksi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="proses_kas.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="id" id="edit-id">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" name="tanggal" id="edit-tanggal" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="jenis">Jenis Transaksi</label>
                            <select name="jenis" id="edit-jenis" class="form-select" required>
                                <option value="Pemasukan">Pemasukan</option>
                                <option value="Pengeluaran">Pengeluaran</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="jumlah">Jumlah (Rp)</label>
                            <input type="number" name="jumlah" id="edit-jumlah" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="keterangan">Keterangan</label>
                            <input type="text" name="keterangan" id="edit-keterangan" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" name="update" class="btn btn-primary">Update Transaksi</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var editKasModal = document.getElementById('editKasModal');
    editKasModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-id');
        var tanggal = button.getAttribute('data-tanggal');
        var jenis = button.getAttribute('data-jenis');
        var jumlah = button.getAttribute('data-jumlah');
        var keterangan = button.getAttribute('data-keterangan');
        var modalBody = editKasModal.querySelector('.modal-body');
        modalBody.querySelector('#edit-id').value = id;
        modalBody.querySelector('#edit-tanggal').value = tanggal;
        modalBody.querySelector('#edit-jenis').value = jenis;
        modalBody.querySelector('#edit-jumlah').value = jumlah;
        modalBody.querySelector('#edit-keterangan').value = keterangan;
    });
});
</script>

<?php include '../templates/footer_admin.php'; ?>