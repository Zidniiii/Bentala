<?php
session_start();
include 'koneksi.php';

// Pastikan user sudah login
if (!isset($_SESSION['user_email'])) {
    header("Location: index.php");
    exit;
}

// Ambil ID user dari email
$email = mysqli_real_escape_string($conn, $_SESSION['user_email']);
$getUser = mysqli_query($conn, "SELECT id FROM users WHERE email = '$email'");
if (!$getUser || mysqli_num_rows($getUser) === 0) {
    die("User tidak ditemukan");
}
$user = mysqli_fetch_assoc($getUser);
$userId = $user['id'];

// Ambil ID buku dari form
$book_id = isset($_POST['book_id']) ? (int)$_POST['book_id'] : 0;

// Cek apakah buku sudah pernah ditambahkan user
$cek = mysqli_query($conn, "SELECT * FROM user_books WHERE user_id = $userId AND book_id = $book_id");
if (mysqli_num_rows($cek) === 0) {
    // Tambahkan ke tabel user_books
    $tambah = mysqli_query($conn, "INSERT INTO user_books (user_id, book_id) VALUES ($userId, $book_id)");
    if (!$tambah) {
        die("Gagal menambahkan ke perpustakaan: " . mysqli_error($conn));
    }
}

// Redirect kembali ke halaman perpustakaan atau detail buku
header("Location: perpustakaanku.php");
exit;
?>
