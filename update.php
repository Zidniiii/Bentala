<?php
require 'koneksi.php'; // pastikan file ini berisi koneksi ke MySQL
session_start();
// Cek apakah user sudah login
if (!isset($_SESSION['user_email'])) {
  header('Location: login.php');
  exit;
}
// Ambil data dari form
$id = intval($_POST['id'] ?? 0);
$judul = $_POST['judul'] ?? '';
$penulis = $_POST['penulis'] ?? '';
$genre = $_POST['genre'] ?? '';
$penerbit = $_POST['penerbit'] ?? '';
// Update data di database
if ($id && $judul && $penulis) {
  mysqli_query($conn, "UPDATE buku SET judul='$judul', penulis='$penulis', genre='$genre', penerbit='$penerbit' WHERE id=$id");
}
header('Location: detailbuku.php?id='.$id);
exit;
