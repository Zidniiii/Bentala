<?php
// ... existing code sebelum HTML ...
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bentala - Navbar</title>
</head>
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
    /* Navbar Styles */
    .Group4 {
        width: 100%;
        height: 64px;
        position: relative;
        background: #6B8B81;
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: flex-start;
        padding: 0 20px;
        gap: 5px;
    }
    .Rectangle2 {
        position: absolute;
        width: 100%;
        height: 100%;
        background-color: #6B8B81;
        top: 0; left: 0;
        z-index: 1;
    }
    .Menu {
        position: relative;
        cursor: pointer;
        z-index: 2;
        padding: 8px;
        border-radius: 4px;
        transition: background-color 0.2s ease;
    }
    .Menu:hover {
        background-color: rgba(255,255,255,0.1);
    }
    .Menu:active {
        background-color: rgba(255,255,255,0.2);
    }
    .BentalaLogo1 {
        position: relative;
        width: 120px;
        height: 62px;
        z-index: 3;
        object-fit: contain;
    }
    .nav-right {
        display: flex;
        align-items: center;
        gap: 15px;
        z-index: 2;
        position: relative;
        margin-left: auto;
    }
    .Rectangle3 {
        position: relative;
        width: 384px;
        height: 44px;
        background: #22393C;
        border-radius: 30px;
        z-index: 1;
        display: block;
    }
    .search-container {
        position: relative;
        display: inline-block;
    }
    .notifications-container {
        position: relative;
        display: inline-block;
    }
    .notifications-bg {
        width: 43px;
        height: 43px;
        border-radius: 50%;
        background: #22393C;
        display: block;
    }
    @media (max-width: 768px) {
        .notifications-bg { width: 35px; height: 35px; }
    }
    @media (max-width: 480px) {
        .notifications-bg { width: 35px; height: 35px; }
    }
    .Search, .Notifications, .ProfileUser {
        position: relative;
        cursor: pointer;
        z-index: 2;
        padding: 8px;
        border-radius: 4px;
        transition: background-color 0.2s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .Notifications {
        position: absolute;
        right: 50%;
        top: 50%;
        transform: translate(50%, -50%);
        z-index: 3;
        background: transparent;
        padding: 8px;
    }
    .Search {
        position: absolute;
        right: 0;
        top: 50%;
        transform: translateY(-50%);
        z-index: 3;
        background: transparent;
        padding: 8px;
    }
    .Search:hover, .Notifications:hover, .ProfileUser:hover {
        background-color: rgba(255,255,255,0.1);
    }
    .Search:active, .Notifications:active, .ProfileUser:active {
        background-color: rgba(255,255,255,0.2);
    }
    .Ellipse2 { display: none; }
    @media (max-width: 1200px) {
        .Rectangle3 { width: 300px; }
        .BentalaLogo1 { width: 100px; height: 52px; }
    }
    @media (max-width: 768px) {
        .Group4 { height: 60px; padding: 0 15px; }
        .Rectangle2 { height: 60px; }
        .Menu svg { width: 28px; height: 28px; }
        .BentalaLogo1 { width: 80px; height: 42px; }
        .Rectangle3 { width: 35px; height: 35px; border-radius: 50%; background: #22393C; }
        .Search { position: absolute; right: 50%; top: 50%; transform: translate(50%, -50%); z-index: 3; background: transparent; padding: 8px; }
        .nav-right { gap: 15px; }
        .search-container { margin-left: 5px; }
        .notifications-container { margin-left: 5px; }
        .ProfileUser { margin-left: 0px; }
        .Search svg, .Notifications svg { width: 28px; height: 28px; }
        .ProfileUser svg { width: 35px; height: 35px; }
    }
    @media (max-width: 480px) {
        .Group4 { height: 55px; padding: 0 10px; }
        .Rectangle2 { height: 55px; }
        .Menu svg { width: 24px; height: 24px; }
        .BentalaLogo1 { width: 70px; height: 36px; }
        .Rectangle3 { width: 35px; height: 35px; border-radius: 50%; background: #22393C; }
        .Search { position: absolute; right: 50%; top: 50%; transform: translate(50%, -50%); z-index: 3; background: transparent; padding: 6px; }
        .nav-right { gap: 12px; }
        .search-container { margin-left: 3px; }
        .notifications-container { margin-left: 3px; }
        .ProfileUser { margin-left: -1px; }
        .Search svg, .Notifications svg { width: 24px; height: 24px; }
        .ProfileUser svg { width: 35px; height: 35px; }
    }
    @media (max-width: 360px) {
        .BentalaLogo1 { width: 60px; height: 31px; }
        .Group4 { padding: 0 8px; }
        .nav-right { gap: 6px; }
    }
    @media (hover: none) and (pointer: coarse) {
        .Menu, .Search, .Notifications, .ProfileUser {
            min-height: 44px;
            min-width: 44px;
        }
    }
</style>
<div class="Group4" aria-label="Navbar atas">
    <div class="Rectangle2"></div>
    <div class="Menu" aria-label="Menu" onclick="openSidebar()">
        <svg width="34" height="35" viewBox="0 0 34 35" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M4.25 17.2791H29.75M4.25 8.77907H29.75M4.25 25.7791H29.75" stroke="#1E1E1E" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </div>
    <img class="BentalaLogo1" src="Pict/bentala logo 1.svg" alt="Bentala Logo" />
    <div class="nav-right">
        <?php if ($current_page !== 'search.php'): ?>
        <div class="search-container">
            <div class="Rectangle3"></div>
            <a href="search.php" class="Search" aria-label="Cari">
                <svg width="34" height="35" viewBox="0 0 34 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M29.75 30.0291L23.5875 23.8666M26.9167 15.8624C26.9167 22.1216 21.8426 27.1957 15.5833 27.1957C9.32411 27.1957 4.25 22.1216 4.25 15.8624C4.25 9.60318 9.32411 4.52907 15.5833 4.52907C21.8426 4.52907 26.9167 9.60318 26.9167 15.8624Z" stroke="#6B8B81" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
        </div>
        <?php endif; ?>
        <div class="notifications-container">
            <div class="notifications-bg"></div>
            <a href="notifikasi.php" class="Notifications" aria-label="Notifikasi">
                <svg width="35" height="35" viewBox="0 0 35 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5.66663 27.1957V24.3624H8.49996V14.4457C8.49996 12.486 9.09024 10.7506 10.2708 9.23949C11.4513 7.70476 12.9861 6.70129 14.875 6.22907V5.2374C14.875 4.64712 15.0757 4.15129 15.477 3.7499C15.902 3.3249 16.4097 3.1124 17 3.1124C17.5902 3.1124 18.0861 3.3249 18.4875 3.7499C18.9125 4.15129 19.125 4.64712 19.125 5.2374V6.22907C21.0139 6.70129 22.5486 7.70476 23.7291 9.23949C24.9097 10.7506 25.5 12.486 25.5 14.4457V24.3624H28.3333V27.1957H5.66663ZM17 31.4457C16.2208 31.4457 15.5479 31.1742 14.9812 30.6312C14.4382 30.0645 14.1666 29.3916 14.1666 28.6124H19.8333C19.8333 29.3916 19.55 30.0645 18.9833 30.6312C18.4402 31.1742 17.7791 31.4457 17 31.4457ZM11.3333 24.3624H22.6666V14.4457C22.6666 12.8874 22.1118 11.5534 21.002 10.4437C19.8923 9.33393 18.5583 8.77907 17 8.77907C15.4416 8.77907 14.1076 9.33393 12.9979 10.4437C11.8882 11.5534 11.3333 12.8874 11.3333 14.4457V24.3624Z" fill="#6B8B81"/>
                </svg>
            </a>
        </div>
        <a href="profilepage.php" class="ProfileUser" aria-label="Profil">
            <svg width="43" height="43" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="21.5" cy="21.7791" r="21.5" fill="#22393C"/>
            </svg>
        </a>
    </div>
</div>
<script>
    function openSidebar() {
        // Trigger sidebar toggle event
        const event = new CustomEvent('toggleSidebar');
        document.dispatchEvent(event);
    }
</script> 