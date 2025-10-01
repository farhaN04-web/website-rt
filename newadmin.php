<?php
// --- Ganti password di bawah ini dengan password yang Anda inginkan ---
$password_baru = 'admin'; 

// Proses enkripsi password
$hash_password = password_hash($password_baru, PASSWORD_DEFAULT);

// Tampilkan hasilnya di layar
echo "Username Baru: (Pilih sendiri, contoh: 'budi')<br>";
echo "Password Asli: " . htmlspecialchars($password_baru) . "<br><br>";
echo "<strong>Copy Hash Password di Bawah Ini untuk Dimasukkan ke Database:</strong><br>";
echo "<textarea rows='3' cols='80' readonly>" . $hash_password . "</textarea>";
?>