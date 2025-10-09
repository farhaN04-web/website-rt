<?php
include 'templates/header.php';
?>

<div class="container py-5">
    <div class="row">
        <div class="col-12 text-center mb-5">
            <h1 class="display-6 border-bottom pb-2">Informasi Keuangan RT</h1>
            <p class="lead">Laporan kas dan status iuran warga secara transparan.</p>
        </div>
    </div>

    <div class="row mb-5">
        <div class="col-md-12">
            <h3>Rekapitulasi Kas RT</h3>
            <?php
            $pemasukan_result = mysqli_query($koneksi, "SELECT SUM(jumlah) AS total FROM kas_rt WHERE jenis = 'Pemasukan'");
            $total_pemasukan = mysqli_fetch_assoc($pemasukan_result)['total'] ?? 0;

            $pengeluaran_result = mysqli_query($koneksi, "SELECT SUM(jumlah) AS total FROM kas_rt WHERE jenis = 'Pengeluaran'");
            $total_pengeluaran = mysqli_fetch_assoc($pengeluaran_result)['total'] ?? 0;

            $saldo_akhir = $total_pemasukan - $total_pengeluaran;
            ?>
            <div class="row">
                <div class="col-lg-4 mb-3">
                    <div class="card bg-success text-white">
                        <div class="card-body">
                            <h5 class="card-title">Total Pemasukan</h5>
                            <p class="card-text fs-4">Rp <?= number_format($total_pemasukan, 0, ',', '.'); ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-3">
                    <div class="card bg-danger text-white">
                        <div class="card-body">
                            <h5 class="card-title">Total Pengeluaran</h5>
                            <p class="card-text fs-4">Rp <?= number_format($total_pengeluaran, 0, ',', '.'); ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-3">
                    <div class="card bg-primary text-white">
                        <div class="card-body">
                            <h5 class="card-title">Saldo Akhir</h5>
                            <p class="card-text fs-4">Rp <?= number_format($saldo_akhir, 0, ',', '.'); ?></p>
                        </div>
                    </div>
                </div>
            </div>
            
            <h4 class="mt-4">Rincian Transaksi</h4>
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Tanggal</th>
                        <th>Keterangan</th>
                        <th>Jenis</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query_kas = "SELECT * FROM kas_rt ORDER BY tanggal DESC";
                    $result_kas = mysqli_query($koneksi, $query_kas);
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
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
include 'templates/footer.php';
?>