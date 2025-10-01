<?php
// Pengaturan koneksi database
$db_host = 'localhost';
$db_user = 'root'; // User default XAMPP
$db_pass = '';     // Password default XAMPP (kosong)
$db_name = 'db_rt';

// Membuat koneksi
$koneksi = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// Cek koneksi
if (!$koneksi) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}

// Set base URL untuk mempermudah pemanggilan aset
$base_url = "http://localhost/website-rt/";
?>