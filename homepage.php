<?php 
session_start();
// Cek session, kalau belum login redirect ke index.php
if (!isset($_SESSION['user_email'])) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
  <title>Beranda</title>
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
      -webkit-text-size-adjust: 100%;
      -ms-text-size-adjust: 100%;
    }

    body, html {
      margin: 0 !important;
      padding: 0 !important;
      border: 0 !important;
    }

    body.dark {
      background: #111 !important;
      color: #f5f5f5 !important;
    }
    body.light {
      background: #fff !important;
      color: #222 !important;
    }

    .Homepage {
      width: 100%;
      min-height: 100vh;
      position: relative;
      background: inherit !important;
      color: inherit !important;
    }
    /* Hero Section */
    .Group5 {
      position: relative;
      width: 100%;
      max-width: 92%;
      height: 160px;
      background: linear-gradient(90deg, #22393C 0%, #6B8B81 100%);
      margin: 35px auto 0 auto;
      z-index: 0;
      padding: 20px;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }
    
    .Rectangle12 {
      position: absolute;
      width: 100%;
      height: 100%;
      left: 0px;
      top: 0px;
      background: linear-gradient(90deg, #22393C 0%, #6B8B81 100%);
    }
    
    .HaloUser {
      position: relative;
      color: inherit;
      font-size: 36px;
      font-family: Rasa;
      font-weight: 600;
      z-index: 1;
      margin-bottom: 10px;
    }
    
    .TenangkanDiriNikmatiHariDanTemukanCeritaYangMenginspirasi {
      position: relative;
      color: inherit;
      font-size: 20px;
      font-family: Rasa;
      font-weight: 400;
      z-index: 1;
      line-height: 1.4;
    }

    /* Rekomendasi Section */
    .Rekomendasi {
      position: relative;
      max-width: 92%;
      margin: 50px auto 20px;
      font-size: 25px;
      font-weight: 500;
      font-family: 'Rasa', serif;
      color: inherit;
      padding-left: 0;
      user-select: none;
    }

    /* Book Grid */
    .book-container {
      padding: 0;
      max-width: 92%;
      margin: 0 auto;
    }
    
    .book-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(135px, 1fr));
      gap: 20px;
      margin-bottom: 100px;
    }

    .book-grid img {
      width: 100%;
      height: auto;
      border-radius: 4px;
      object-fit: cover;
      cursor: pointer;
      transition: transform 0.3s ease;
      aspect-ratio: 2/3;
    }
    
    .book-grid img:hover {
      transform: scale(1.05);
    }
    
    .book-grid a {
      display: block;
      text-decoration: none;
    }

    /* Responsive Design */
    @media (max-width: 1200px) {
      .Rekomendasi {
        padding-left: 0;
      }
      
      .book-container {
        padding: 0;
      }
      
      .book-grid {
        grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
      }
    }

    @media (max-width: 768px) {
      
      .Group5 {
        height: 140px;
        margin: 20px auto 0 auto;
        padding: 15px;
      }
      
      .HaloUser {
        font-size: 28px;
        margin-bottom: 8px;
      }
      
      .TenangkanDiriNikmatiHariDanTemukanCeritaYangMenginspirasi {
        font-size: 16px;
      }
      
      .Rekomendasi {
        font-size: 20px;
        padding-left: 0;
        margin: 30px auto 15px;
      }
      
      .book-container {
        padding: 0;
      }
      
      .book-grid {
        grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
        gap: 15px;
        margin-bottom: 60px;
      }
    }

    @media (max-width: 480px) {
      
      .Group5 {
        height: 120px;
        margin: 15px auto 0 auto;
        padding: 12px;
      }
      
      .HaloUser {
        font-size: 24px;
        margin-bottom: 6px;
      }
      
      .TenangkanDiriNikmatiHariDanTemukanCeritaYangMenginspirasi {
        font-size: 14px;
      }
      
      .Rekomendasi {
        font-size: 18px;
        padding-left: 0;
        margin: 25px auto 10px;
      }
      
      .book-container {
        padding: 0;
      }
      
      .book-grid {
        grid-template-columns: repeat(auto-fit, minmax(80px, 1fr));
        gap: 12px;
        margin-bottom: 50px;
      }
      

    }

    @media (max-width: 360px) {
      .book-grid {
        grid-template-columns: repeat(auto-fit, minmax(70px, 1fr));
        gap: 10px;
      }
    }
    
    /* Touch device optimizations */
    @media (hover: none) and (pointer: coarse) {
      .book-grid img:hover {
        transform: none;
      }
    }

    .homepage-title {
      color: #F5F5F5;
    }

    .Group5, .Rectangle12 {
      /* Tetap pakai background gradien, tapi warna teks ikut inherit */
      color: inherit;
    }
    .HaloUser, .TenangkanDiriNikmatiHariDanTemukanCeritaYangMenginspirasi, .Rekomendasi {
      color: #F5F5F5 !important;
    }

    body.light .Rekomendasi {
      color: #222 !important;
    }
    body.dark .Rekomendasi {
      color: #F5F5F5 !important;
    }
  </style>
</head>
<body>
  <?php include 'navbar.php'; ?>
    <!-- Hero Section -->
    <div class="Group5">
      <div class="Rectangle12"></div>
      <div class="HaloUser">
        Halo, <?php echo htmlspecialchars($_SESSION['user_fullname']); ?>!
      </div>
      <div class="TenangkanDiriNikmatiHariDanTemukanCeritaYangMenginspirasi">
        Tenangkan diri, nikmati hari,<br/>dan temukan cerita yang menginspirasi.
      </div>
    </div>

    <!-- Rekomendasi Section -->
    <div class="Rekomendasi">Rekomendasi</div>
    <div class="book-container">
      <div class="book-grid" aria-label="Daftar buku rekomendasi">
        <?php include 'koneksi.php';
        $query = "SELECT id, judul, cover FROM buku";
        $result = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_assoc($result)) :
          $id = $row['id'];
          $judul = htmlspecialchars($row['judul']);
          $cover = htmlspecialchars($row['cover']);
        ?>
          <a href="detailbuku.php?id=<?= $id ?>">
            <img src="Pict/<?= $cover ?>" alt="<?= $judul ?>" />
          </a>
        <?php endwhile; ?>
      </div>
    </div>
    <!-- Include Sidebar -->
    <?php include 'sidebar.php'; ?>
  </div>
</body>
</html>
