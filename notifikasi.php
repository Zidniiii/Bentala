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
// Ambil notifikasi user
$notifikasi = [];
if ($user_id) {
  $sql = "SELECT * FROM notifikasi WHERE user_id = $user_id ORDER BY waktu_dibuat DESC";
  $result = mysqli_query($conn, $sql);
  while ($row = mysqli_fetch_assoc($result)) {
    $notifikasi[] = $row;
  }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Notifikasi</title>
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
    .notif-page {
      background: inherit !important;
      color: inherit !important;
      min-height: 100vh;
      padding: 70px 20px 60px;
    }
    .notif-title {
      color: inherit !important;
      font-size: 28px;
      font-family: Rasa, serif;
      font-weight: 600;
      text-align: center;
      margin-bottom: 40px;
    }
    .notif-list { max-width: 600px; margin: 0 auto; }
    .notif-item {
      background: #22393C;
      color: inherit;
      border-radius: 10px;
      padding: 18px 22px;
      margin-bottom: 22px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.08);
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .notif-pesan { font-size: 17px; font-family: Rasa, serif; }
    .notif-waktu { font-size: 13px; color: #b0b0b0; margin-left: 18px; white-space: nowrap; }
    @media (max-width: 600px) {
      .notif-title { font-size: 22px; }
      .notif-item { padding: 12px 10px; font-size: 15px; }
    }
    .notif-empty {
      color: inherit !important;
      text-align: center;
      font-size: 18px;
      margin-top: 40px;
    }
  </style>
</head>
<body>
  <?php include 'navbar.php'; ?>
  <div class="notif-page">
    <div class="notif-title">Notifikasi</div>
    <div class="notif-list">
      <?php if (count($notifikasi) > 0): ?>
        <?php foreach ($notifikasi as $n): ?>
          <div class="notif-item">
            <span class="notif-pesan"><?= htmlspecialchars($n['pesan']) ?></span>
            <span class="notif-waktu"><?= date('d M Y H:i', strtotime($n['waktu_dibuat'])) ?></span>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="notif-empty">Belum ada notifikasi.</div>
      <?php endif; ?>
    </div>
  </div>
  <?php include 'sidebar.php'; ?>
</body>
</html>
