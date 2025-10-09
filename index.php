<?php
include 'templates/header.php';
?>

<div class="p-5 mb-4 bg-light rounded-3 text-center">
  <div class="container-fluid py-5">
    <h1 class="display-5 fw-bold">Selamat Datang di Website RT 02</h1>
    <p class="fs-4">Pusat Informasi dan Komunikasi Warga RT 02, RW 02 Kelurahan Rejasari.</p>
    <a href="profil.php" class="btn btn-primary btn-lg" type="button">Lihat Profil RT</a>
  </div>
</div>


<div class="row justify-content-center">
    <h2 class="mb-3 border-bottom pb-2 text-center"><b>Berita & Pengumuman Terbaru</b></h2>
    <?php
    $query_berita = "SELECT * FROM berita ORDER BY tanggal_publikasi DESC LIMIT 3";
    $result_berita = mysqli_query($koneksi, $query_berita);

    if (mysqli_num_rows($result_berita) > 0) {
        while ($row = mysqli_fetch_assoc($result_berita)) {
    ?>
    <div class="col-md-4 mb-4">
        <div class="card h-100">
            <img src="<?= $base_url; ?>assets/img/<?= $row['gambar']; ?>" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title"><?= htmlspecialchars($row['judul']); ?></h5>
                <p class="card-text"><?= substr(strip_tags($row['isi']), 0, 100); ?>...</p>
                <a href="detail_berita.php?id=<?= $row['id']; ?>" class="btn btn-primary">Baca Selengkapnya</a>
            </div>
            <div class="card-footer">
                <small class="text-muted">Dipublikasikan pada <?= date('d M Y', strtotime($row['tanggal_publikasi'])); ?></small>
            </div>
        </div>
    </div>
    <?php
        }
    } else {
        echo '<p class="text-center">Belum ada berita yang dipublikasikan.</p>';
    }
    ?>
</div>

<?php
include 'templates/footer.php';
?>