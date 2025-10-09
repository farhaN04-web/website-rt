<?php
$password_baru = 'admin';
$hash_password = password_hash($password_baru, PASSWORD_DEFAULT);
echo "Username Baru: (Pilih sendiri, contoh: 'budi')<br>";
echo "Password Asli: " . htmlspecialchars($password_baru) . "<br><br>";
echo "<strong>Copy Hash Password di Bawah Ini untuk Dimasukkan ke Database:</strong><br>";
echo "<textarea rows='3' cols='80' readonly>" . $hash_password . "</textarea>";
?>