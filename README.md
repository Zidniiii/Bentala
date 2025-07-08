# BENTALA - Sistem Perpustakaan Digital
BENTALA adalah aplikasi perpustakaan digital berbasis PHP dan MySQL. Aplikasi ini memungkinkan pengguna untuk mendaftar, login, melihat daftar buku, membaca detail buku, menyimpan buku ke perpustakaan pribadi, dan melacak riwayat baca.

## Fitur Utama
- **Autentikasi Pengguna:** Signup, login, logout.
- **Manajemen Buku:** Admin dapat menambah, menghapus, dan mengupdate data buku.
- **Perpustakaan Pribadi:** Pengguna dapat menyimpan buku ke perpustakaan pribadi mereka.
- **Riwayat Baca:** Melacak progress pembacaan buku pengguna.
- **Pencarian Buku:** Fitur pencarian buku berdasarkan judul.
- **Profil Pengguna:** Pengguna dapat melihat dan mengedit profilnya.
- **Notifikasi:** Sistem notifikasi untuk pengguna.
- **Responsive UI:** Tampilan web yang responsif dan user-friendly.

## Struktur Folder dan File
BENTALA/
├── Pict/                       # Folder untuk menyimpan gambar dan cover buku
├── db.php                      # File terkait database, seperti seeding data atau query khusus
├── detailbuku.php              # Halaman detail informasi buku
├── editprofile.php             # Halaman untuk edit profil pengguna
├── hapusbuku.php               # Script untuk menghapus buku
├── homepage.php                # Halaman utama setelah login
├── index.html                  # Halaman landing page (mungkin untuk sebelum login)
├── kategori.php                # Halaman untuk menampilkan buku berdasarkan kategori/genre
├── koneksi.php                 # File koneksi ke database MySQL
├── login.php                   # Halaman login
├── logout.php                  # Script untuk logout dan destroy session
├── navbar.php                  # Komponen navbar yang digunakan di beberapa halaman
├── notifikasi.php              # Halaman atau script untuk menampilkan notifikasi
├── perpustakaanku.php          # Halaman perpustakaan pribadi pengguna
├── profilepage.php             # Halaman profil pengguna
├── riwayatbaca.php             # Halaman riwayat pembacaan buku
├── rolesession.php             # Pengaturan role session (admin/user)
├── search.php                  # Halaman hasil pencarian buku
├── sidebar.php                 # Komponen sidebar untuk navigasi
├── signup.html                 # Form signup (frontend)
├── signup.php                  # Proses signup user baru
├── signupsuccess.html          # Halaman sukses signup
├── tambahkeperpustakaan.php    # Script untuk menambah buku ke perpustakaan pengguna
├── update\_progress.php        # Update progress baca buku
├── update\_riwayat\_baca.php   # Update riwayat baca pengguna
├── update.php                  # Script untuk update data (bisa profil atau buku)

## Cara Instalasi dan Menjalankan
1. Pastikan sudah menginstall **XAMPP** atau web server dengan PHP dan MySQL.
2. Clone atau download repository ini ke dalam folder `htdocs` (misal: `C:\xampp\htdocs\bentala`).
3. Import database MySQL yang digunakan (file SQL tidak disertakan di sini, pastikan kamu punya file SQL-nya).
4. Sesuaikan konfigurasi database di file `koneksi.php`.
5. Jalankan web server dan buka browser, akses ke `http://localhost/bentala/index.html` atau `homepage.php` jika sudah login.
6. Daftar akun baru lewat `signup.html`, lalu login menggunakan `login.php`.

Dibuat oleh Zidni Ilma
Untuk keperluan pembelajaran dan portofolio
