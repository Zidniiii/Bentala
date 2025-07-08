<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
    <title>Bentala - Sidebar</title>
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

        body.dark {
            background: #111 !important;
            color: #f5f5f5 !important;
        }
        body.light {
            background: #fff !important;
            color: #222 !important;
        }

        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: none;
            z-index: 999;
        }

        .sidebar.show {
            display: block;
        }

        .sidebar-overlay {
            position: absolute;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.4);
            z-index: 1;
        }

        .sidebar-content {
            position: absolute;
            width: 427px;
            max-width: 90%;
            height: 100%;
            background: linear-gradient(180deg, #507681 0%, #ACB797 100%);
            padding: 20px;
            box-sizing: border-box;
            overflow-y: auto;
            transform: translateX(-100%);
            transition: transform 0.4s ease;
            z-index: 2;
            display: flex;
            flex-direction: column;
        }

        .sidebar.show .sidebar-content {
            transform: translateX(0);
        }

        .sidebar-close {
            position: absolute;
            top: 15px;
            right: 15px;
            cursor: pointer;
            z-index: 3;
            padding: 8px;
            border-radius: 4px;
            transition: background-color 0.2s ease;
        }
        
        .sidebar-close:hover {
            background-color: rgba(255,255,255,0.1);
        }

        .sidebar-profile-wrapper {
            position: relative;
            width: 130px;
            height: 130px;
            margin: 0 auto 30px auto;
        }
        .sidebar-profile {
            width: 130px;
            height: 130px;
            border-radius: 50%;
            background: white;
            border: 2px solid #678687;
            display: block;
        }
        .edit-icon {
            position: absolute;
            right: 0;
            bottom: 0;
            width: 40px;
            height: 40px;
            background: white;
            border-radius: 50%;
            border: 2px solid #678687;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 6px rgba(0,0,0,0.07);
            cursor: pointer;
            z-index: 2;
        }
        .edit-icon svg {
            width: 22px;
            height: 22px;
            display: block;
            stroke: #507681;
            fill: none;
        }
        
        .profile-icon-wrapper {
            position: absolute;
            top: 20%;
            left: 60%;
            transform: translateX(-50%);
        }
        
        .sidebar-username {
            text-align: center;
            font-size: 20px;
            color: #F5F5F5;
            font-family: Rasa, serif;
            margin-bottom: 40px;
        }

        .sidebar-links a {
            display: block;
            margin: 15px 0;
            background: #CECDB9;
            border-radius: 100px;
            padding: 20px;
            text-align: center;
            color: #22393C;
            font-size: 20px;
            font-family: Rasa, serif;
            text-decoration: none;
            transition: all 0.2s ease;
        }
        
        .sidebar-links a:hover {
            background: #B8B7A3;
            transform: translateY(-2px);
        }

        .sidebar-logout a {
            display: block;
            margin: 40px auto 0;
            width: 200px;
            background: #22393C;
            border-radius: 100px;
            padding: 10px;
            text-align: center;
            color: #CECDB9;
            font-size: 20px;
            font-family: Rasa, serif;
            text-decoration: none;
            transition: all 0.2s ease;
        }
        
        .sidebar-logout a:hover {
            background: #1A2A2D;
            transform: translateY(-2px);
        }

        .toggle-darkmode-switch {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            width: 90%;
            margin: 0;
            padding: 0;
            background: none;
            border: none;
            cursor: pointer;
            outline: none;
        }
        .toggle-darkmode-bg {
            width: 120px;
            height: 36px;
            border-radius: 20px;
            background: #F5F5F5;
            display: flex;
            align-items: center;
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            box-shadow: 0 2px 8px rgba(0,0,0,0.07);
            transition: background 0.3s;
        }
        body.dark .toggle-darkmode-bg {
            background: #222;
        }
        .toggle-darkmode-icon {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-left: 2px;
            margin-right: 2px;
            transition: background 0.3s;
        }
        body.dark .toggle-darkmode-icon {
            background: #111;
        }
        .toggle-darkmode-label {
            font-size: 13px;
            font-family: Rasa, serif;
            font-weight: 600;
            color: #222;
            transition: color 0.3s;
        }
        body.dark .toggle-darkmode-label {
            color: #F5F5F5;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .sidebar-content {
                width: 320px;
                padding: 15px;
            }
            
            .sidebar-profile {
                width: 100px;
                height: 100px;
                margin: 30px auto 10px;
            }
            
            .sidebar-username {
                font-size: 18px;
                margin-bottom: 30px;
            }
            
            .sidebar-links a {
                padding: 15px;
                font-size: 18px;
                margin: 10px 0;
            }
            
            .sidebar-logout a {
                width: 180px;
                font-size: 18px;
                padding: 12px;
            }
            
            .edit-icon {
                transform: translateX(25px);
            }
            
            .profile-icon-wrapper {
                left: 55%;
            }
        }

        @media (max-width: 480px) {
            .sidebar-content {
                width: 280px;
                padding: 12px;
            }
            
            .sidebar-profile {
                width: 80px;
                height: 80px;
                margin: 25px auto 10px;
            }
            
            .sidebar-username {
                font-size: 16px;
                margin-bottom: 25px;
            }
            
            .sidebar-links a {
                padding: 12px;
                font-size: 16px;
                margin: 8px 0;
            }
            
            .sidebar-logout a {
                width: 160px;
                font-size: 16px;
                padding: 10px;
            }
            
            .edit-icon {
                transform: translateX(20px);
            }
            
            .profile-icon-wrapper {
                left: 52%;
            }
        }

        /* Touch device optimizations */
        @media (hover: none) and (pointer: coarse) {
            .sidebar-links a, .sidebar-logout a {
                min-height: 44px;
                display: flex;
                align-items: center;
                justify-content: center;
            }
        }

        .sidebar-logout {
            margin-top: auto;
            padding-bottom: 10px;
        }

        .sidebar-links {
            margin-top: 25px;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div id="sidebar" class="sidebar">
        <div class="sidebar-overlay" onclick="closeSidebar()"></div>
        <div class="sidebar-content">
            <div class="sidebar-close" onclick="closeSidebar()">
                <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6 24H42M6 12H42M6 36H42" stroke="white" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <div class="sidebar-profile-wrapper">
                <div class="sidebar-profile"></div>
                <a href="profilepage.php" class="edit-icon" title="Edit Profil">
                    <svg viewBox="0 0 24 24">
                        <path d="M5 19H6.425L16.2 9.225L14.775 7.8L5 17.575V19Z" stroke="#507681" stroke-width="2" fill="none"/>
                        <path d="M3 21V16.75L16.2 3.575C17.04 2.915 18.22 2.915 19.05 3.6L20.425 5C21.085 5.66 21.085 6.84 20.425 7.5L7.25 21H3Z" stroke="#507681" stroke-width="2" fill="none"/>
                    </svg>
                </a>
            </div>
            <div class="sidebar-username"><?php echo $_SESSION['user_fullname']; ?></div>
            <div style="display: flex; justify-content: center; align-items: center; width: 100%; margin-bottom: 10px;">
                <button id="toggle-darkmode-switch" class="toggle-darkmode-switch" aria-label="Ganti Mode" style="margin: 0 auto; display: block;">
                  <span class="toggle-darkmode-bg">
                    <span class="toggle-darkmode-icon" id="toggle-darkmode-icon">
                      <!-- SVG icon will be injected by JS -->
                    </span>
                    <span class="toggle-darkmode-label" id="toggle-darkmode-label">DAYMODE</span>
                  </span>
                </button>
            </div>
            <div class="sidebar-links">
                <a href="homepage.php">Beranda</a>
                <a href="perpustakaanku.php">Perpustakaanku</a>
                <a href="riwayatbaca.php">Riwayat Baca</a>
                <a href="kategori.php">Kategori</a>
            </div>
            <div class="sidebar-logout">
                <a href="logout.php">Log Out</a>
            </div>
        </div>
    </div>

    <script>
        function openSidebar() {
            document.getElementById("sidebar").classList.add("show");
            document.body.style.overflow = 'hidden'; // Prevent background scrolling
        }

        function closeSidebar() {
            document.getElementById("sidebar").classList.remove("show");
            document.body.style.overflow = ''; // Restore scrolling
        }

        // Close sidebar when clicking outside
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const sidebarContent = document.querySelector('.sidebar-content');
            const menuButton = document.querySelector('.Menu');
            
            if (sidebar.classList.contains('show') && 
                !sidebarContent.contains(event.target) && 
                !menuButton.contains(event.target)) {
                closeSidebar();
            }
        });

        // Close sidebar on escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeSidebar();
            }
        });

        // Touch event handling for mobile
        let touchStartX = 0;
        let touchEndX = 0;

        document.addEventListener('touchstart', function(event) {
            touchStartX = event.changedTouches[0].screenX;
        });

        document.addEventListener('touchend', function(event) {
            touchEndX = event.changedTouches[0].screenX;
            handleSwipe();
        });

        function handleSwipe() {
            const sidebar = document.getElementById('sidebar');
            const swipeThreshold = 50;
            
            if (touchEndX < touchStartX - swipeThreshold) {
                // Swipe left - close sidebar if open
                if (sidebar.classList.contains('show')) {
                    closeSidebar();
                }
            } else if (touchEndX > touchStartX + swipeThreshold) {
                // Swipe right - open sidebar if closed
                if (!sidebar.classList.contains('show')) {
                    openSidebar();
                }
            }
        }

        // Prevent zoom on double tap for mobile
        let lastTouchEnd = 0;
        document.addEventListener('touchend', function(event) {
            const now = (new Date()).getTime();
            if (now - lastTouchEnd <= 300) {
                event.preventDefault();
            }
            lastTouchEnd = now;
        }, false);

        // Listen for toggle event from navbar
        document.addEventListener('toggleSidebar', function() {
            openSidebar();
        });

        // Initialize
        document.addEventListener("DOMContentLoaded", function () {
            const menuIcon = document.querySelector(".Menu");
            if (menuIcon) {
                menuIcon.addEventListener("click", openSidebar);
            }
        });

        // Fungsi toggle dark/light mode
        function getModeIcon(isDark) {
            if (isDark) {
                // Bulan + bintang
                return `<svg width="18" height="18" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="14" cy="14" r="10" stroke="#F5F5F5" stroke-width="2"/><path d="M18 14c0 2.21-1.79 4-4 4" stroke="#F5F5F5" stroke-width="2"/><circle cx="21" cy="9" r="1" fill="#F5F5F5"/><circle cx="23" cy="13" r="1" fill="#F5F5F5"/></svg>`;
            } else {
                // Matahari
                return `<svg width="18" height="18" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="14" cy="14" r="6" stroke="#222" stroke-width="2"/><g stroke="#222" stroke-width="2"><line x1="14" y1="2" x2="14" y2="6"/><line x1="14" y1="22" x2="14" y2="26"/><line x1="2" y1="14" x2="6" y2="14"/><line x1="22" y1="14" x2="26" y2="14"/><line x1="5.22" y1="5.22" x2="8.05" y2="8.05"/><line x1="19.95" y1="19.95" x2="22.78" y2="22.78"/><line x1="5.22" y1="22.78" x2="8.05" y2="19.95"/><line x1="19.95" y1="8.05" x2="22.78" y2="5.22"/></g></svg>`;
            }
        }
        function setDarkMode(isDark) {
            document.body.classList.remove('dark', 'light');
            document.body.classList.add(isDark ? 'dark' : 'light');
            localStorage.setItem('darkmode', isDark ? '1' : '0');
            document.getElementById('toggle-darkmode-label').innerText = isDark ? 'NIGHTMODE' : 'DAYMODE';
            document.getElementById('toggle-darkmode-icon').innerHTML = getModeIcon(isDark);
        }
        document.addEventListener('DOMContentLoaded', function() {
            var isDark = localStorage.getItem('darkmode') === '1';
            setDarkMode(isDark);
            document.getElementById('toggle-darkmode-switch').onclick = function() {
                isDark = !isDark;
                setDarkMode(isDark);
            };
        });
    </script>
</body>
</html> 