<?php
session_start();
include 'koneksi.php';

$book_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($book_id <= 0) {
    echo "ID buku tidak valid.";
    exit;
}

// Ambil data buku dari database
$sql = "SELECT * FROM buku WHERE id = $book_id";
$result = mysqli_query($conn, $sql);

if (!$result || mysqli_num_rows($result) == 0) {
    echo "Buku tidak ditemukan.";
    exit;
}

$buku = mysqli_fetch_assoc($result);

// Contoh genre dari field genre yang dipisah koma, misal: "Realisme Magis,Fiksi Sejarah,Drama"
$genre_list = array_map('trim', explode(',', $buku['genre']));
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <title>Detail Buku - <?= htmlspecialchars($buku['judul']) ?></title>
  <link rel="stylesheet" href="navbar-sidebar.css">
  <style>
    /* --- CSS untuk konten halaman detail buku --- */
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }
    body {
      background: black;
      font-family: 'Rasa', serif;
      color: #F5F5F5;
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
      overflow-x: hidden;
    }
    .DetailBukuPage {
      position: relative;
      width: 100%;
      min-height: 100vh;
      overflow-x: hidden;
    }
    .ProfilePage {
      width: 100%;
      height: 100%;
      position: relative;
      background: black;
    }
    .CoverBuku {
      position: absolute;
      top: 100px;
      left: 115px;
      width: 233px;
      height: 350px;
      object-fit: cover;
    }
    .JudulBuku {
      position: absolute;
      top: 100px;
      left: 392px;
      font-size: 32px;
      font-weight: 600;
    }
    .Penulis {
      position: absolute;
      top: 140px;
      left: 392px;
      font-size: 18px;
      font-weight: 400;
    }
    .GenreBox {
      height: 35px;
      min-width: 140px;
      padding: 0 15px;
      background: #AFBB98;
      border-radius: 20px;
      text-align: center;
      line-height: 35px;
      color: black;
      font-size: 15px;
      font-weight: 300;
      display: inline-block;
      margin: 5px;
    }
    .DetailBuku {
      position: absolute;
      top: 224px;
      left: 392px;
      font-size: 15px;
      line-height: 25px;
      width: 80%;
      max-width: 800px;
    }
    .Btn {
      position: absolute;
      width: 200px;
      height: 40px;
      font-family: 'Rasa', serif;
      font-size: 18px;
      font-weight: 500;
      color: #F5F5F5;
      background-color: #6B8B81;
      border: none;
      border-radius: 30px;
      padding: 8px 20px;
      cursor: pointer;
      text-decoration: none;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      transition: background-color 0.3s ease;
      box-sizing: border-box;
    }
    .Btn:hover {
      background-color: #507681;
    }
    
    /* Touch device optimizations */
    @media (hover: none) and (pointer: coarse) {
      .Menu, .Search, .Notifications, .ProfileUser {
        min-height: 44px;
        min-width: 44px;
      }
      
      .Btn {
        min-height: 44px;
        min-width: 44px;
      }
    }
    button.Btn {
      all: unset;
      display: flex;
      align-items: center;
      justify-content: center;
      width: 200px;
      height: 40px;
      font-family: 'Rasa', serif;
      font-size: 18px;
      font-weight: 500;
      color: #F5F5F5;
      background-color: #6B8B81;
      border-radius: 30px;
      padding: 8px 20px;
      cursor: pointer;
      text-align: center;
      transition: background-color 0.3s ease;
      box-sizing: border-box;
    }
    .Sinopsis {
      position: absolute;
      top: 470px;
      left: 115px;
      width: calc(100% - 230px);
      max-width: 100%;
      font-size: 15px;
      line-height: 25px;
    }
    .Sinopsis strong {
      font-weight: 700;
    }
    @media (max-width: 768px) {
      .CoverBuku, .JudulBuku, .Penulis, .GenreBox, .DetailBuku, .Btn, .Sinopsis {
        position: static;
        display: block;
        margin: 20px auto;
        left: unset !important;
      }
      .GenreBox, .Btn {
        width: 80%;
        max-width: 200px;
      }
      .Sinopsis {
        padding: 10px;
      }
    }
    
    /* Responsive design for all devices */
    @media (max-width: 1024px) {
      .CoverBuku {
        position: static;
        width: 250px;
        height: 375px;
        margin: 20px auto;
        display: block;
      }
      
      .JudulBuku {
        position: static;
        font-size: 28px;
        text-align: center;
        margin: 20px auto;
        padding: 0 20px;
      }
      
      .Penulis {
        position: static;
        font-size: 16px;
        text-align: center;
        margin: 10px auto;
        padding: 0 20px;
      }
      
      .DetailBuku {
        position: static;
        width: 90%;
        max-width: 600px;
        margin: 20px auto;
        padding: 0 20px;
        text-align: center;
      }
      
      .Sinopsis {
        position: static;
        width: 90%;
        max-width: 600px;
        margin: 20px auto;
        padding: 0 20px;
        text-align: left;
      }
      
      /* Genre container responsive */
      div[style*="position: absolute; top: 171px; left: 392px"] {
        position: static !important;
        width: 90% !important;
        max-width: 600px !important;
        margin: 20px auto !important;
        justify-content: center !important;
        left: unset !important;
        top: unset !important;
      }
      
      /* Button responsive */
      .Btn {
        position: static !important;
        width: 200px !important;
        height: 40px !important;
        margin: 10px auto !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        left: unset !important;
        top: unset !important;
      }
      
      form[method="POST"] {
        position: static !important;
        width: 200px !important;
        margin: 10px auto !important;
        left: unset !important;
        top: unset !important;
      }
      
      button.Btn {
        width: 200px !important;
        height: 40px !important;
        margin: 0 auto !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
      }
    }

    @media (max-width: 768px) {
      .CoverBuku {
        width: 200px !important;
        height: 300px !important;
        margin: 15px auto !important;
      }

      .JudulBuku {
        font-size: 22px !important;
        padding: 0 15px !important;
      }

      .Penulis {
        font-size: 14px !important;
        padding: 0 15px !important;
      }

      .DetailBuku {
        font-size: 13px !important;
        line-height: 20px !important;
        padding: 0 15px !important;
        text-align: center !important;
      }

      .Sinopsis {
        font-size: 13px !important;
        line-height: 20px !important;
        padding: 0 15px !important;
      }

      .GenreBox {
        display: inline-block;
        margin: 3px;
        position: static !important;
        min-width: 100px !important;
        padding: 0 8px;
        font-size: 12px !important;
        height: 30px !important;
        line-height: 30px !important;
      }

      .Btn {
        width: 200px !important;
        height: 40px !important;
        font-size: 16px !important;
        padding: 6px 16px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
      }

      button.Btn {
        width: 200px !important;
        height: 40px !important;
        font-size: 16px !important;
        padding: 6px 16px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
      }


    }

    /* Extra small devices (phones, 480px and down) */
    @media (max-width: 480px) {
      .CoverBuku {
        width: 180px !important;
        height: 270px !important;
      }

      .JudulBuku {
        font-size: 20px !important;
        padding: 0 10px !important;
      }

      .Penulis {
        font-size: 13px !important;
        padding: 0 10px !important;
      }

      .DetailBuku {
        font-size: 12px !important;
        line-height: 18px !important;
        padding: 0 10px !important;
        text-align: center !important;
      }

      .Sinopsis {
        font-size: 12px !important;
        line-height: 18px !important;
        padding: 0 10px !important;
      }

      .GenreBox {
        min-width: 80px !important;
        padding: 0 6px;
        font-size: 11px !important;
        height: 28px !important;
        line-height: 28px !important;
        margin: 2px;
      }

      .Btn {
        width: 200px !important;
        height: 40px !important;
        font-size: 14px !important;
        padding: 5px 12px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
      }

      button.Btn {
        width: 200px !important;
        height: 40px !important;
        font-size: 14px !important;
        padding: 5px 12px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
      }


    }

    /* Landscape orientation for mobile */
    @media (max-width: 768px) and (orientation: landscape) {
      .CoverBuku {
        width: 150px !important;
        height: 225px !important;
        float: left;
        margin: 20px 20px 20px 20px !important;
      }

      .JudulBuku,
      .Penulis,
      .DetailBuku,
      .Sinopsis {
        margin-left: 190px !important;
        text-align: left !important;
      }

      .Btn,
      form[method="POST"] {
        margin-left: 190px !important;
        display: inline-block !important;
        margin-right: 10px !important;
        width: 200px !important;
        height: 40px !important;
      }
    }

  </style>
</head>
<body>
  <div class="DetailBukuPage">
    <div class="DetailBukuPage">
      <?php include 'navbar.php'; ?>

      <!-- Cover & Info -->
      <img src="Pict/<?= htmlspecialchars($buku['cover']) ?>" alt="Cover Buku" class="CoverBuku" />
      <div class="JudulBuku"><?= htmlspecialchars($buku['judul']) ?></div>
      <div class="Penulis">Oleh: <?= htmlspecialchars($buku['penulis']) ?></div>

      <!-- Genre -->
      <div style="position: absolute; top: 171px; left: 392px; display: flex; flex-wrap: wrap; gap: 10px; width: calc(100% - 230px); max-width: 100%;">
  <?php foreach ($genre_list as $genre): ?>
    <div class="GenreBox"><?= htmlspecialchars($genre) ?></div>
  <?php endforeach; ?>
</div>


      <!-- Detail Buku -->
      <div class="DetailBuku">
          <strong>Detail:</strong><br>
          Terbit : <?= htmlspecialchars(!empty($buku['terbit']) ? $buku['terbit'] : '-') ?><br>
          Penerbit : <?= htmlspecialchars(!empty($buku['penerbit']) ? $buku['penerbit'] : '-') ?><br>
          Jumlah Halaman : <?= htmlspecialchars(!empty($buku['halaman']) ? $buku['halaman'] . ' halaman' : '-') ?><br>
          ISBN : <?= htmlspecialchars($buku['isbn']) ?>
      </div>

      <!-- Tombol -->
      <a href="<?= htmlspecialchars($buku['file_pdf']) ?>" target="_blank" class="Btn" style="top: 365px; left:392px; position: absolute; display: flex; align-items: center; justify-content: center;">Baca</a>

      <form action="tambahkeperpustakaan.php" method="POST" style="position: absolute; top: 412px; left:392px;">
        <input type="hidden" name="book_id" value="<?= $book_id ?>">
        <button type="submit" class="Btn">+ Perpustakaanku</button>
      </form>

      <!-- Sinopsis -->
      <div class="Sinopsis">
        <strong>Sinopsis:</strong><br>
        <?= nl2br(htmlspecialchars($buku['sinopsis'])) ?>
      </div>
    </div>

    <?php include 'sidebar.php'; ?>

  </div>

  <script src="sidebar.js"></script>

</body>
</html>
