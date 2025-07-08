<?php
session_start();
include 'koneksi.php';

// Cek apakah user sudah login
if (!isset($_SESSION['user_email'])) {
  header("Location: index.php");
  exit;
}

// Ambil data user dari database berdasarkan email di session
$email = mysqli_real_escape_string($conn, $_SESSION['user_email']);
$query = "SELECT fullname, email, bio FROM users WHERE email = '$email'";
$result = mysqli_query($conn, $query);

if (!$result || mysqli_num_rows($result) === 0) {
  die("Data pengguna tidak ditemukan.");
}

$user = mysqli_fetch_assoc($result);
$fullname = $user['fullname'];
$user_email = $user['email'];
$bio = $user['bio'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Profile Pengguna</title>
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
    .ProfilePage {
      width: 100%;
      height: 100%;
      position: relative;
      background: inherit !important;
      color: inherit !important;
    }
    .ProfilePengguna {
      position: absolute;
      color: inherit !important;
      font-size: 24px;
      font-weight: 600;
      text-align: center;
      left: 316px;
      top: 132px;
      width: 880px;
      height: 39px;
    }
    .Rectangle38 {
      position: absolute;
      left: 150px;
      top: 241px;
    }
    .NamaFullnameEmailUserGmailComBioDesc {
      position: absolute;
      color: inherit !important;
      left: 525px;
      top: 241px;
    }
    .Rectangle39 {
      position: absolute;
      width: 230px;
      height: 50px;
      border: 1px #6B8B81 solid;
    }
    .EditProfilButton {
      position: absolute;
      top: 591px;
      left: 525px;
      width: 230px;
      height: 50px;
      background: transparent;
      border: 1px solid #6B8B81;
      color: #6B8B81;
      font-size: 20px;
      font-weight: 600;
      text-align: center;
      line-height: 50px;
      text-decoration: none;
      border-radius: 5px;
      transition: all 0.3s ease;
    }
    .EditProfilButton:hover {
      background-color: #6B8B81;
      color: white;
      cursor: pointer;
    }
    .EditProfil {
      position: absolute;
      width: 230px;
      height: 50px;
      color: #6B8B81;
      font-size: 20px;
      font-weight: 600;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    @media (max-width: 768px) {
      .NamaFullnameEmailUserGmailComBioDesc,
      .EditProfil,
      .Rectangle39 {
        left: 50% !important;
        transform: translateX(-50%);
      }
    }
  </style>
</head>
<body>
  <?php include 'navbar.php'; ?>

  <div class="ProfilePage">
    <!-- Judul Halaman -->
    <div class="ProfilePengguna">
      PROFILE PENGGUNA
    </div>

    <!-- Foto / Frame kotak -->
    <div class="Rectangle38">
      <svg width="300" height="400" viewBox="0 0 300 400" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M0 0H300V400H0V0Z" fill="#D9D9D9"/>
      </svg>
    </div>

    <!-- Detail pengguna -->
    <div class="NamaFullnameEmailUserGmailComBioDesc">
      <span style="font-size: 20px; font-weight: 600;">Nama<br/></span>
      <span style="font-size: 15px; font-weight: 500;"><?php echo htmlspecialchars($fullname); ?><br/><br/></span>
      
      <span style="font-size: 20px; font-weight: 600;">Email<br/></span>
      <span style="font-size: 15px; font-weight: 500;"><?php echo htmlspecialchars($user_email); ?><br/><br/></span>
      
      <span style="font-size: 20px; font-weight: 600;">Bio<br/></span>
      <span style="font-size: 15px; font-weight: 500;"><?php echo nl2br(htmlspecialchars($bio)); ?></span>
    </div>

    <!-- Tombol Edit Profil -->
    <a href="editprofile.php" class="EditProfilButton">Edit Profil</a>
  </div>

  <?php include 'sidebar.php'; ?>
</body>
</html>
