<?php
$host = "localhost";
$user = "root";
$pass = ""; // kosong kalau default XAMPP
$db   = "bentala";

$conn = mysqli_connect($host, $user, $pass, $db);

// Cek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
