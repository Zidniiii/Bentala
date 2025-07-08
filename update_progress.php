<?php
session_start();
require 'koneksi.php';

if (!isset($_SESSION['user_id'])) {
  http_response_code(401);
  exit;
}

$user_id = $_SESSION['user_id'];
$book_title = $_POST['title'] ?? '';
$page = intval($_POST['page'] ?? 1);

// Cek apakah sudah ada
$stmt = $conn->prepare("SELECT * FROM riwayat_baca WHERE user_id = ? AND book_title = ?");
$stmt->bind_param("is", $user_id, $book_title);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  $stmt = $conn->prepare("UPDATE riwayat_baca SET last_page = ? WHERE user_id = ? AND book_title = ?");
  $stmt->bind_param("iis", $page, $user_id, $book_title);
} else {
  $stmt = $conn->prepare("INSERT INTO riwayat_baca (user_id, book_title, last_page) VALUES (?, ?, ?)");
  $stmt->bind_param("isi", $user_id, $book_title, $page);
}
$stmt->execute();
