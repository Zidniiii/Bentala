<?php
include 'db.php'; // koneksi ke database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $confirm = $_POST['password_confirm'];

    if ($password !== $confirm) {
        echo "Password dan konfirmasi tidak sama.";
        exit;
    }

    $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    if (mysqli_num_rows($check) > 0) {
        echo "Email sudah terdaftar.";
        exit;
    }

    $hashed = password_hash($password, PASSWORD_DEFAULT);

    // role default 'user'
    $query = "INSERT INTO users (fullname, email, password, role) VALUES ('$fullname', '$email', '$hashed', 'user')";

    if (mysqli_query($conn, $query)) {
    header("Location: signupsuccess.html");
    exit;
} else {
    echo "Gagal menyimpan data: " . mysqli_error($conn);
}
}
?>
