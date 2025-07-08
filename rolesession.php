<?php
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['user_email'])) {
    header("Location: index.html"); // kalau belum login, balikin ke login page
    exit;
}

// Cek role user
$isAdmin = ($_SESSION['user_role'] === 'admin');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Dashboard - Bentala</title>
  <style>
    body {
      font-family: 'Rasa', sans-serif;
      background: #f0f0f0;
      margin: 0;
      padding: 20px;
    }
    .container {
      max-width: 700px;
      margin: auto;
      background: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    h1 {
      color: #6B8B81;
    }
    .btn-logout {
      background: #6B8B81;
      color: white;
      padding: 8px 15px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      float: right;
      margin-top: -50px;
    }
    .admin-section {
      margin-top: 20px;
      padding: 15px;
      background: #d0e6d3;
      border-radius: 8px;
    }
  </style>
</head>
<body>
  <div class="container">
    <button onclick="window.location.href='logout.php'" class="btn-logout">Logout</button>
    <h1>Welcome, <?= htmlspecialchars($_SESSION['user_fullname']) ?>!</h1>
    <p>Your email: <?= htmlspecialchars($_SESSION['user_email']) ?></p>
    <p>Your role: <strong><?= htmlspecialchars($_SESSION['user_role']) ?></strong></p>

    <?php if ($isAdmin): ?>
      <div class="admin-section">
        <h2>Admin Panel</h2>
        <p>Here you can input new books, manage users, and other admin tasks.</p>
        <a href="input_buku.php">Go to Input Buku</a>
      </div>
    <?php else: ?>
      <p>You are logged in as a user. You can view books and borrow them.</p>
    <?php endif; ?>
  </div>
</body>
</html>
