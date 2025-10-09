<?php
include 'templates/header.php';
?>

<div class="row">
    <div class="col-12 text-center">
        <h1 class="display-6 border-bottom pb-2 mb-4">Galeri Kegiatan Warga</h1>
        <p class="lead">Momen-momen kebersamaan warga RT 02 dalam berbagai acara dan kegiatan.</p>
    </div>
</div>

<div class="row">
    <?php
    $query_galeri = "SELECT * FROM galeri ORDER BY tanggal_kegiatan DESC";
    $result_galeri = mysqli_query($koneksi, $query_galeri);

    if (mysqli_num_rows($result_galeri) > 0) {
        while ($g = mysqli_fetch_assoc($result_galeri)) {
    ?>
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card shadow-sm">
            <img src="<?= $base_url; ?>assets/img/<?= htmlspecialchars($g['url_gambar']); ?>" class="card-img-top" style="height: 225px; object-fit: cover;" alt="<?= htmlspecialchars($g['judul_kegiatan']); ?>">
            <div class="card-body">
                <h5 class="card-title"><?= htmlspecialchars($g['judul_kegiatan']); ?></h5>
                <p class="card-text">
                    <small class="text-muted">
                        <?= date('d F Y', strtotime($g['tanggal_kegiatan'])); ?>
                    </small>
                </p>
            </div>
        </div>
    </div>
    <?php
        }
    } else {
        echo '<p class="text-center col-12">Belum ada foto kegiatan yang diunggah.</p>';
    }
    ?>
</div>

<?php
include 'templates/footer.php';
?>