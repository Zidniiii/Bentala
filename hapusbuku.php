<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['user_email'])) {
  header("Location: index.php");
  exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $userEmail = $_SESSION['user_email'];
  $bukuId = $_POST['buku_id'] ?? null;

  // Validasi
  if (!$bukuId) {
    die('ID buku tidak ditemukan');
  }

  // Ambil ID user
  $userQuery = mysqli_query($conn, "SELECT id FROM users WHERE email = '$userEmail'");
  $user = mysqli_fetch_assoc($userQuery);
  $userId = $user['id'];

  // Hapus dari relasi user_books
  $delete = mysqli_query($conn, "DELETE FROM user_books WHERE user_id = $userId AND book_id = $bukuId");

  if ($delete) {
    header("Location: perpustakaanku.php");
    exit;
  } else {
    die("Gagal menghapus buku: " . mysqli_error($conn));
  }
} else {
  // Bukan POST
  header("Location: perpustakaanku.php");
  exit;
}
?>
