<?php
session_start();
include 'koneksi.php';
// Ambil semua buku
$all_books = [];
$book_query = mysqli_query($conn, "SELECT * FROM buku WHERE genre IS NOT NULL AND genre != ''");
while ($row = mysqli_fetch_assoc($book_query)) {
    $all_books[] = $row;
}
// Kumpulkan semua genre unik
$genre_map = [];
foreach ($all_books as $buku) {
    $genres = array_map('trim', explode(',', $buku['genre']));
    foreach ($genres as $genre) {
        if ($genre === '') continue;
        if (!isset($genre_map[$genre])) $genre_map[$genre] = [];
        $genre_map[$genre][] = $buku;
    }
}
ksort($genre_map);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Kategori</title>
  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; }
    html, body { width: 100%; height: 100%; background: black; font-family: 'Rasa', serif; overflow-x: hidden; }
    .kategori-page { min-height: 100vh; background: black; padding: 70px 20px 60px; }
    .kategori-title { color: #F5F5F5; font-size: 28px; font-family: Rasa, serif; font-weight: 600; text-align: center; margin-bottom: 40px; }
    .genre-section { margin-bottom: 48px; }
    .genre-title { color: #F5F5F5; font-size: 22px; font-family: Rasa, serif; font-weight: 500; margin-bottom: 18px; margin-left: 3vw; }
    .buku-grid { display: flex; flex-wrap: wrap; gap: 32px 24px; justify-content: flex-start; margin-left: 3vw; }
    .buku-card { background: #d9d9d9; width: 120px; height: 160px; border-radius: 6px; display: flex; align-items: center; justify-content: center; overflow: hidden; }
    .buku-card img { width: 100%; height: 100%; object-fit: cover; }
    @media (max-width: 700px) {
      .buku-grid { gap: 18px 8px; }
      .buku-card { width: 90px; height: 120px; }
      .genre-title { font-size: 18px; }
    }
    body.dark {
      background: #111 !important;
      color: #f5f5f5 !important;
    }
    body.light {
      background: #fff !important;
      color: #222 !important;
    }
    body, .kategori-page {
      background: inherit !important;
      color: inherit !important;
    }
    .kategori-title, .genre-title, .kategori-empty {
      color: inherit !important;
    }
  </style>
</head>
<body>
  <?php include 'navbar.php'; ?>
  <div class="kategori-page">
    <div class="kategori-title">Kategori</div>
    <?php foreach ($genre_map as $genre => $books): ?>
      <div class="genre-section">
        <div class="genre-title"><?= htmlspecialchars($genre) ?></div>
        <div class="buku-grid">
          <?php foreach ($books as $buku): ?>
            <div class="buku-card">
              <img src="pict/<?= htmlspecialchars($buku['cover']) ?>" alt="<?= htmlspecialchars($buku['judul']) ?>">
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
  <?php include 'sidebar.php'; ?>
</body>
</html>
