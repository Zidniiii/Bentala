<?php
session_start();
include 'koneksi.php'; // file koneksi ke MySQL

// Cek apakah user sudah login
if (!isset($_SESSION['user_id'])) {
  header('Location: index.php');
  exit;
}

$user_id = $_SESSION['user_id'];

// Ambil data user dari database
$query = "SELECT nama, email, bio, profile_pic FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($nama, $email, $bio, $profile_pic);
$stmt->fetch();
$stmt->close();

// Jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nama_baru = $_POST['nama'];
  $email_baru = $_POST['email'];
  $bio_baru = $_POST['bio'];
  $profile_pic_baru = $profile_pic;
  if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] === UPLOAD_ERR_OK) {
    $ext = pathinfo($_FILES['profile_pic']['name'], PATHINFO_EXTENSION);
    $allowed = ['jpg','jpeg','png','gif','webp'];
    if (in_array(strtolower($ext), $allowed)) {
      $newname = 'profile_' . $user_id . '_' . time() . '.' . $ext;
      $dest = 'Pict/profile/' . $newname;
      if (move_uploaded_file($_FILES['profile_pic']['tmp_name'], $dest)) {
        $profile_pic_baru = $newname;
      }
    }
  }
  $update = "UPDATE users SET nama = ?, email = ?, bio = ?, profile_pic = ? WHERE id = ?";
  $stmt = $conn->prepare($update);
  $stmt->bind_param("ssssi", $nama_baru, $email_baru, $bio_baru, $profile_pic_baru, $user_id);
  if ($stmt->execute()) {
    header("Location: profilepage.php?update=success");
    exit;
  } else {
    echo "<script>alert('Gagal menyimpan perubahan');</script>";
  }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Edit Profil Pengguna</title>
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Rasa', serif;
      background-color: black;
      color: white;
      overflow-x: hidden;
    }

    .ProfilePage {
      padding: 20px;
      max-width: 1000px;
      margin: auto;
    }

    .navbar {
      background-color: #6B8B81;
      height: 64px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 20px;
    }

    .navbar img {
      height: 40px;
    }

    .ProfilePengguna {
      text-align: center;
      font-size: 24px;
      font-weight: 600;
      margin: 30px 0 20px;
    }

    .profile-container {
      display: flex;
      flex-wrap: wrap;
      gap: 30px;
      justify-content: center;
    }

    .profile-photo {
      width: 300px;
      height: 400px;
      background-color: #d9d9d9;
    }

    form {
      display: flex;
      flex-direction: column;
      gap: 15px;
      max-width: 400px;
      width: 100%;
    }

    label {
      font-weight: 600;
      font-size: 18px;
    }

    input,
    textarea {
      width: 100%;
      padding: 10px;
      border-radius: 5px;
      border: 1px solid #ccc;
      font-size: 16px;
      background: #F5F5F5;
      color: #000;
    }

    textarea {
      resize: vertical;
      min-height: 80px;
    }

    .save-button {
      margin-top: 20px;
      background-color: transparent;
      color: #6B8B81;
      border: 1px solid #6B8B81;
      font-size: 18px;
      font-weight: 600;
      padding: 10px;
      border-radius: 5px;
      cursor: pointer;
      transition: all 0.3s;
    }

    .save-button:hover {
      background-color: #6B8B81;
      color: white;
    }

    @media (max-width: 768px) {
      .profile-container {
        flex-direction: column;
        align-items: center;
      }

      form {
        width: 100%;
      }
    }
  </style>
</head>
<body>
  <div class="navbar">
    <img src="Pict/bentala logo 1.svg" alt="Logo" />
    <div class="icons">
      <!-- Tambahkan ikon lainnya jika dibutuhkan -->
    </div>
  </div>

  <div class="ProfilePage">
    <div class="ProfilePengguna">EDIT PROFIL</div>

    <div class="profile-container">
      <div class="profile-photo" style="background: #d9d9d9; display: flex; align-items: center; justify-content: center; overflow: hidden;">
        <?php if (!empty($profile_pic) && file_exists('Pict/profile/' . $profile_pic)): ?>
          <img src="Pict/profile/<?php echo htmlspecialchars($profile_pic); ?>" alt="Foto Profil" style="width: 100%; height: 100%; object-fit: cover;" />
        <?php endif; ?>
      </div>

      <form action="" method="POST" enctype="multipart/form-data">
        <div>
          <label for="nama">Nama</label>
          <input type="text" id="nama" name="nama" value="<?php echo htmlspecialchars($nama); ?>" required />
        </div>

        <div>
          <label for="email">Email</label>
          <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required />
        </div>

        <div>
          <label for="bio">Bio</label>
          <textarea id="bio" name="bio"><?php echo htmlspecialchars($bio); ?></textarea>
        </div>

        <div>
          <label for="profile_pic">Foto Profil</label>
          <input type="file" id="profile_pic" name="profile_pic" accept="image/*" />
        </div>

        <button type="submit" class="save-button">Simpan</button>
      </form>
    </div>
  </div>
</body>
</html>
