<?php
session_start();
include 'koneksi.php';
if (!isset($_SESSION['user_email'])) {
  header('Location: login.php');
  exit;
}
$email = $_SESSION['user_email'];
// Ambil user id
$user_query = mysqli_query($conn, "SELECT id FROM users WHERE email = '" . mysqli_real_escape_string($conn, $email) . "' LIMIT 1");
$user = mysqli_fetch_assoc($user_query);
$user_id = $user ? $user['id'] : 0;
// Ambil riwayat baca user
$riwayat = [];
if ($user_id) {
  $sql = "SELECT rb.*, b.judul, b.penulis, b.cover FROM riwayat_baca rb JOIN buku b ON rb.buku_id = b.id WHERE rb.user_id = $user_id ORDER BY rb.tanggal_terakhir_baca DESC";
  $result = mysqli_query($conn, $sql);
  while ($row = mysqli_fetch_assoc($result)) {
    $riwayat[] = $row;
  }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Riwayat Baca</title>
  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; }
    html, body { width: 100%; height: 100%; background: black; font-family: 'Rasa', serif; overflow-x: hidden; }
    body.dark {
      background: #111 !important;
      color: #f5f5f5 !important;
    }
    body.light {
      background: #fff !important;
      color: #222 !important;
    }
    .riwayat-page {
      background: inherit !important;
      color: inherit !important;
      min-height: 100vh;
      padding: 70px 20px 60px;
    }
    .riwayat-title {
      color: inherit !important;
      font-size: 28px;
      font-family: Rasa, serif;
      font-weight: 600;
      text-align: center;
      margin-bottom: 40px;
    }
    .riwayat-list { max-width: 900px; margin: 0 auto; }
    .riwayat-row { display: flex; align-items: center; margin-bottom: 40px; }
    .riwayat-cover { width: 130px; height: 170px; background: #d9d9d9; border-radius: 6px; overflow: hidden; margin-right: 32px; flex-shrink: 0; }
    .riwayat-cover img { width: 100%; height: 100%; object-fit: cover; }
    .riwayat-info { color: inherit !important; }
    .riwayat-judul { font-size: 24px; font-weight: 600; margin-bottom: 6px; }
    .riwayat-penulis { font-size: 17px; color: #d2d2d2; margin-bottom: 8px; }
    .riwayat-halaman, .riwayat-tanggal { font-size: 15px; color: #b0b0b0; margin-bottom: 2px; }
    @media (max-width: 700px) {
      .riwayat-row { flex-direction: column; align-items: flex-start; margin-bottom: 32px; }
      .riwayat-cover { margin-right: 0; margin-bottom: 12px; width: 100px; height: 130px; }
      .riwayat-judul { font-size: 18px; }
      .riwayat-penulis { font-size: 14px; }
      .riwayat-halaman, .riwayat-tanggal { font-size: 13px; }
    }
    .riwayat-empty {
      color: inherit !important;
      text-align: center;
      font-size: 18px;
      margin-top: 40px;
    }
  </style>
</head>
<body>
  <?php include 'navbar.php'; ?>
  <div class="riwayat-page">
    <div class="riwayat-title">RIWAYAT BACA</div>
    <div class="riwayat-list">
    <?php if (count($riwayat) > 0): ?>
        <?php foreach ($riwayat as $row): ?>
          <div class="riwayat-row">
            <div class="riwayat-cover"><img src="Pict/<?= htmlspecialchars($row['cover']) ?>" alt="<?= htmlspecialchars($row['judul']) ?>"></div>
            <div class="riwayat-info">
              <div class="riwayat-judul"><?= htmlspecialchars($row['judul']) ?></div>
              <div class="riwayat-penulis"><?= htmlspecialchars($row['penulis']) ?></div>
              <div class="riwayat-halaman">halaman : <?= isset($row['halaman_terakhir']) && $row['halaman_terakhir'] !== '' ? htmlspecialchars($row['halaman_terakhir']) : '-' ?></div>
              <div class="riwayat-tanggal">tanggal: <?= date('d M Y', strtotime($row['tanggal_terakhir_baca'])) ?></div>
            </div>
          </div>
        <?php endforeach; ?>
    <?php else: ?>
      <div class="riwayat-empty">Belum ada riwayat baca.</div>
    <?php endif; ?>
    </div>
  </div>
  <?php include 'sidebar.php'; ?>
</body>
</html>
