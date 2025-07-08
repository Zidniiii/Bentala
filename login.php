<?php
session_start();
include 'db.php'; // koneksi ke database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    // Cek email di database
    $result = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

    if (mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);

        // Verifikasi password
        if (password_verify($password, $user['password'])) {
            // Login berhasil, simpan data user ke session
            $_SESSION['user_email'] = $email;
            $_SESSION['user_fullname'] = $user['fullname'];
            $_SESSION['user_role'] = $user['role']; // simpan role

            // Redirect ke homepage langsung
            header("Location: ./homepage.php");
            exit;
        } else {
            echo "Password salah.";
        }
    } else {
        echo "Email tidak ditemukan.";
    }
}
?>
