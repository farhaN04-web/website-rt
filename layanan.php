<?php
include 'templates/header.php';
?>

<div class="container py-5">
    <div class="row">
        <div class="col-12 text-center mb-5">
            <h1 class="display-6 border-bottom pb-2">Layanan Warga</h1>
            <p class="lead">Informasi prosedur administrasi dan formulir penting untuk warga.</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h3>Prosedur Pembuatan Surat Pengantar RT</h3>
            <ol class="list-group list-group-numbered mb-5">
                <li class="list-group-item">Unduh dan isi formulir yang sesuai dari daftar di bawah ini.</li>
                <li class="list-group-item">Siapkan dokumen pendukung seperti fotokopi KTP dan Kartu Keluarga (KK).</li>
                <li class="list-group-item">Hubungi Sekretaris RT untuk menyerahkan formulir dan dokumen pendukung.</li>
                <li class="list-group-item">Surat pengantar akan diproses dan dapat diambil sesuai jadwal yang ditentukan.</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h3>Unduh Formulir</h3>
            <div class="list-group">
                <?php
                $query_dokumen = "SELECT * FROM dokumen ORDER BY nama_dokumen ASC";
                $result_dokumen = mysqli_query($koneksi, $query_dokumen);

                if (mysqli_num_rows($result_dokumen) > 0) {
                    while ($doc = mysqli_fetch_assoc($result_dokumen)) {
                ?>
                    <a href="dokumen/<?= htmlspecialchars($doc['nama_file']); ?>" class="list-group-item list-group-item-action" download>
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1"><?= htmlspecialchars($doc['nama_dokumen']); ?></h5>
                            <small><i class="fas fa-download"></i> Unduh</small>
                        </div>
                        <p class="mb-1"><?= htmlspecialchars($doc['deskripsi']); ?></p>
                    </a>
                <?php
                    }
                } else {
                    echo '<p class="text-center">Belum ada formulir yang tersedia.</p>';
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php
include 'templates/footer.php';
?>