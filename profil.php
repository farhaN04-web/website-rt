<?php
include 'templates/header.php';
?>

<div class="row">
    <div class="col-12 text-center">
        <h1 class="display-6 border-bottom pb-2 mb-4">Struktur Pengurus RT 02 Periode 2024-2027</h1>
        <p class="lead">Berikut adalah jajaran pengurus yang berdedikasi untuk melayani warga RT 02.</p>
    </div>
</div>

<div class="row justify-content-center mt-4">
    <?php
    $query_pengurus = "SELECT * FROM pengurus ORDER BY id ASC";
    $result_pengurus = mysqli_query($koneksi, $query_pengurus);

    if (mysqli_num_rows($result_pengurus) > 0) {
        while ($p = mysqli_fetch_assoc($result_pengurus)) {
    ?>
    <div class="col-md-4 col-lg-3 mb-4">
        <div class="card text-center h-100 shadow-sm">
            <div class="card-body">
                <img src="<?= $base_url; ?>assets/img/<?= htmlspecialchars($p['foto'] ?? 'default.png'); ?>" class="rounded-circle mb-3" alt="Foto <?= htmlspecialchars($p['nama_lengkap']); ?>" width="120" height="120" style="object-fit: cover;">
                <h5 class="card-title"><?= htmlspecialchars($p['nama_lengkap']); ?></h5>
                <p class="card-text text-primary fw-bold"><?= htmlspecialchars($p['jabatan']); ?></p>
            </div>
        </div>
    </div>
    <?php
        }
    } else {
        echo '<p class="text-center">Data pengurus belum tersedia.</p>';
    }
    ?>
</div>

<?php
include 'templates/footer.php';
?>