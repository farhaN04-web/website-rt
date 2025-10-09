<?php
include 'templates/header.php';
?>

<div class="row">
    <div class="col-12 text-center">
        <h1 class="display-6 border-bottom pb-2 mb-4">Berita & Informasi Warga</h1>
    </div>
</div>

<div class="row">
    <?php
    $query_berita = "SELECT * FROM berita ORDER BY tanggal_publikasi DESC";
    $result_berita = mysqli_query($koneksi, $query_berita);

    if (mysqli_num_rows($result_berita) > 0) {
        while ($berita = mysqli_fetch_assoc($result_berita)) {
    ?>
    <div class="col-md-12 mb-4">
        <div class="card flex-md-row shadow-sm h-md-250">
            <img src="<?= $base_url; ?>assets/img/<?= htmlspecialchars($berita['gambar']); ?>" class="card-img-left flex-auto d-none d-md-block" style="width: 200px; object-fit: cover;" alt="Gambar Berita">
            <div class="card-body d-flex flex-column align-items-start">
                <h3 class="mb-0">
                    <a class="text-dark" href="detail_berita.php?id=<?= $berita['id']; ?>"><?= htmlspecialchars($berita['judul']); ?></a>
                </h3>
                <div class="mb-1 text-muted"><?= date('d F Y', strtotime($berita['tanggal_publikasi'])); ?></div>
                <p class="card-text mb-auto"><?= substr(strip_tags($berita['isi']), 0, 150); ?>...</p>
                <a href="detail_berita.php?id=<?= $berita['id']; ?>">Lanjutkan membaca</a>
            </div>
        </div>
    </div>
    <?php
        }
    } else {
        echo '<p class="text-center col-12">Belum ada berita yang dipublikasikan.</p>';
    }
    ?>
</div>

<?php
include 'templates/footer.php';
?>