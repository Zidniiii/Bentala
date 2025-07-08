<?php
session_start();
include 'koneksi.php';

// Autentikasi user
if (!isset($_SESSION['user_email'])) {
  header("Location: index.php");
  exit;
}

$email = $_SESSION['user_email'];
$email = mysqli_real_escape_string($conn, $_SESSION['user_email']);
$getUser = mysqli_query($conn, "SELECT id FROM users WHERE email = '$email'");
if (!$getUser) {
  die("Gagal mengambil data user: " . mysqli_error($conn));
}
$user = mysqli_fetch_assoc($getUser);
$userId = $user['id'];

// Ambil semua buku milik user
$query = "SELECT b.id, b.judul, b.penulis, b.cover 
          FROM user_books ub 
          JOIN buku b ON ub.book_id = b.id 
          WHERE ub.user_id = $userId";
$result = mysqli_query($conn, $query);
if (!$result) {
  die("Gagal mengambil data buku: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Perpustakaanku</title>
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }
    html, body {
      width: 100%;
      height: 100%;
      background: black;
      font-family: 'Rasa', serif;
      overflow-x: hidden;
    }
    body.dark {
      background: #111 !important;
      color: #f5f5f5 !important;
    }
    body.light {
      background: #fff !important;
      color: #222 !important;
    }
    body.light .buku-judul,
    body.light .buku-penulis {
      color: #222 !important;
    }
    body.dark .buku-judul,
    body.dark .buku-penulis {
      color: #f5f5f5 !important;
    }
    body.light .Perpustakaanku > div:first-child {
      color: #222 !important;
    }
    body.dark .Perpustakaanku > div:first-child {
      color: #f5f5f5 !important;
    }
    .Perpustakaanku {
      min-height: 100vh;
      background: inherit !important;
      color: inherit !important;
      padding: 120px 20px 60px;
    }
    .buku-grid {
      display: flex;
      flex-wrap: wrap;
      gap: 48px 40px;
      justify-content: center;
      margin-top: 60px;
    }
    .buku-card {
      background: transparent;
      width: 180px;
      display: flex;
      flex-direction: column;
      align-items: center;
      border-radius: 12px;
      box-shadow: none;
      margin-bottom: 10px;
    }
    .buku-card img {
      width: 140px;
      height: 200px;
      object-fit: cover;
      border-radius: 6px;
      margin-bottom: 16px;
      background: #D9D9D9;
    }
    .buku-judul {
      color: white;
      font-size: 18px;
      font-family: Rasa, serif;
      font-weight: 600;
      text-align: center;
      margin-bottom: 4px;
      word-break: break-word;
    }
    .buku-penulis {
      color: #d2d2d2;
      font-size: 15px;
      font-family: Rasa, serif;
      font-weight: 500;
      text-align: center;
      margin-bottom: 12px;
      word-break: break-word;
    }
    .hapus-btn {
      margin-top: 4px;
      padding: 6px 18px;
      background: #6B8B81;
      color: white;
      border: none;
      border-radius: 10px;
      cursor: pointer;
      font-size: 15px;
      font-family: Rasa, serif;
      transition: background 0.2s;
    }
    .hapus-btn:hover {
      background: #507681;
    }
    @media (max-width: 600px) {
      .buku-card {
        width: 100%;
        max-width: 220px;
      }
      .buku-grid {
        gap: 32px 10px;
      }
    }
  </style>
</head>
<body>
  <?php include 'navbar.php'; ?>
  <div class="Perpustakaanku">
    <div style="color: #F5F5F5; font-size: 30px; font-family: Rasa; font-weight: 500; text-align: center; margin-bottom: 10px;">PERPUSTAKAANKU</div>
    <div class="buku-grid">
      <?php while ($buku = mysqli_fetch_assoc($result)) : ?>
        <div class="buku-card">
          <a href="detailbuku.php?id=<?= $buku['id'] ?>">
            <img src="pict/<?= htmlspecialchars($buku['cover']) ?>" alt="<?= htmlspecialchars($buku['judul']) ?>">
          </a>
          <div class="buku-judul">
            <a href="detailbuku.php?id=<?= $buku['id'] ?>" style="color:inherit; text-decoration:none;">
              <?= htmlspecialchars($buku['judul']) ?>
            </a>
          </div>
          <div class="buku-penulis">
            <?= htmlspecialchars($buku['penulis']) ?>
          </div>
          <form action="hapusbuku.php" method="post" onsubmit="return confirm('Yakin ingin menghapus buku ini dari perpustakaanmu?')">
            <input type="hidden" name="buku_id" value="<?= $buku['id'] ?>">
            <button type="submit" class="hapus-btn">Hapus</button>
          </form>
        </div>
      <?php endwhile; ?>
    </div>
  </div>
  <?php include 'sidebar.php'; ?>
</body>
</html>
