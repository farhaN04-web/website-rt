<?php
include 'templates/header.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo '<div class="alert alert-danger">Berita tidak ditemukan.</div>';
    include 'templates/footer.php';
    exit();
}

$id_berita = $_GET['id'];
$query = "SELECT * FROM berita WHERE id = ?";
$stmt = mysqli_prepare($koneksi, $query);
mysqli_stmt_bind_param($stmt, "i", $id_berita);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$berita = mysqli_fetch_assoc($result);

if ($berita) {
?>

<div class="row justify-content-center">
    <div class="col-lg-9">
        <article>
            <header class="mb-4">
                <h1 class="fw-bolder mb-1"><?= htmlspecialchars($berita['judul']); ?></h1>
                <div class="text-muted fst-italic mb-2">
                    Dipublikasikan pada <?= date('d F Y', strtotime($berita['tanggal_publikasi'])); ?> 
                </div>
            </header>
            
            <figure class="mb-4">
                <img class="img-fluid rounded" src="<?= $base_url; ?>assets/img/<?= htmlspecialchars($berita['gambar']); ?>" alt="Gambar Berita">
            </figure>
            
            <section class="mb-5">
                <?= $berita['isi']; ?>
            </section>
        </article>
        <a href="berita.php" class="btn btn-outline-primary">← Kembali ke Daftar Berita</a>
    </div>
</div>


<?php
} else {
    echo '<div class="alert alert-danger text-center">Maaf, berita yang Anda cari tidak dapat ditemukan.</div>';
}
mysqli_stmt_close($stmt);
include 'templates/footer.php';
?>