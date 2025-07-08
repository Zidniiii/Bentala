<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['user_email'])) {
    header("Location: index.php");
    exit;
}

$query = $_GET['q'] ?? '';
$hasil = [];

if ($query !== '') {
    $escaped = mysqli_real_escape_string($conn, $query);
    $sql = "
        SELECT *
        FROM buku
        WHERE judul LIKE '%$escaped%'
        OR penulis LIKE '%$escaped%'
        OR genre LIKE '%$escaped%'
        OR penerbit LIKE '%$escaped%'
    ";
    $hasil = mysqli_query($conn, $sql);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Pencarian</title>
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
    body, .search-page {
      background: inherit !important;
      color: inherit !important;
    }
    .search-title, .search-empty {
      color: inherit !important;
    }
    .search-page {
      min-height: 100vh;
      background: black;
      padding: 70px 20px 60px;
    }
    .search-form-container {
      display: flex;
      justify-content: center;
      margin-top: 0;
      margin-bottom: 10px;
    }
    .search-form {
      display: flex;
      width: 100%;
      max-width: 500px;
      background: #e0e0e0;
      border-radius: 30px;
      overflow: hidden;
      box-shadow: 0 2px 8px rgba(0,0,0,0.04);
    }
    .search-input {
      flex: 1;
      border: none;
      outline: none;
      padding: 12px 20px;
      font-size: 17px;
      font-family: Rasa, serif;
      background: transparent;
      color: #F5F5F5;
    }
    .search-input::placeholder {
      color: #888;
      font-style: italic;
    }
    .search-btn {
      background: none;
      border: none;
      padding: 0 18px;
      cursor: pointer;
      display: flex;
      align-items: center;
      color: #F5F5F5;
      font-size: 20px;
      transition: background 0.2s;
      border-left: 1px solid #ccc;
      height: 100%;
    }
    .search-btn:hover {
      background: #d2d2d2;
    }
    .search-title {
      color: white;
      font-size: 22px;
      font-family: Rasa, serif;
      font-weight: 500;
      text-align: center;
      margin-bottom: 10px;
    }
    .search-title .search-instruction {
      font-size: 15px;
    }
    .search-title .search-query {
      font-size: 15px;
    }
    .buku-grid {
      display: flex;
      flex-wrap: wrap;
      gap: 48px 40px;
      justify-content: center;
      margin-top: 40px;
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
    @media (max-width: 600px) {
      .buku-card {
        width: 100%;
        max-width: 220px;
      }
      .buku-grid {
        gap: 32px 10px;
      }
      .search-form {
        max-width: 98vw;
      }
    }
    .no-result {
      color: #d2d2d2;
      text-align: center;
      margin-top: 60px;
      font-size: 18px;
      font-family: Rasa, serif;
    }
  </style>
</head>
<body>
  <?php include 'navbar.php'; ?>
  <div class="search-page">
    <div class="search-form-container">
      <form class="search-form" method="get" action="search.php">
        <input class="search-input" type="text" name="q" value="<?= htmlspecialchars($query) ?>" placeholder="Cari berdasarkan judul, penulis, genre, atau penerbit..." autofocus />
        <button class="search-btn" type="submit" aria-label="Cari">
          <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="10" cy="10" r="8" stroke="#22393C" stroke-width="2"/>
            <line x1="16.0607" y1="16.3536" x2="20" y2="20.2929" stroke="#22393C" stroke-width="2" stroke-linecap="round"/>
          </svg>
        </button>
      </form>
    </div>
    <div class="search-title">
      <?php if ($query !== ''): ?>
        <span class="search-query">Hasil pencarian dari: <b><?= htmlspecialchars($query) ?></b></span>
      <?php else: ?>
        <span class="search-instruction">Silakan masukkan kata kunci pencarian.</span>
      <?php endif; ?>
    </div>
    <?php if ($query !== ''): ?>
      <?php if ($hasil && mysqli_num_rows($hasil) > 0): ?>
        <div class="buku-grid">
          <?php while ($buku = mysqli_fetch_assoc($hasil)) : ?>
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
            </div>
          <?php endwhile; ?>
        </div>
      <?php else: ?>
        <div class="no-result">Tidak ada hasil ditemukan untuk kata kunci <b><?= htmlspecialchars($query) ?></b>.</div>
      <?php endif; ?>
    <?php endif; ?>
  </div>
  <?php include 'sidebar.php'; ?>
</body>
</html>
