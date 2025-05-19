<?php
session_start();
if (isset($_SESSION['username'])) {
    echo "<script>
        alert('Anda sudah login!');
        window.location.href = 'dashboard.php';
    </script>";
    exit();
}
include 'koneksi.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bollyreads</title>
    <link rel="icon" href="./assets/images/ICON1.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', Arial, sans-serif;
            background: #F24C1A;
            min-height: 100vh;
        }

        .header-btn {
            background: #fff;
            color: #F24C1A;
            font-weight: bold;
            border-radius: 9999px;
            padding: 0.5rem 1.5rem;
            margin-left: 1rem;
            transition: background 0.3s, color 0.3s;
        }

        .header-btn:hover {
            background: #F24C1A;
            color: #fff;
            border: 1px solid #fff;
        }

        .main-title {
            font-size: 6rem;
            font-weight: 700;
            color: transparent;
            letter-spacing: 1px;
            margin-bottom: 0.5rem;
            -webkit-text-stroke: 3px #fff;
        }

        .main-title span {
            display: block;
        }

        .main-gif {
            max-width: 800px;
            width: 100%;
            border-radius: 1.5rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
            margin: 1rem auto 0 auto;
        }

        .nav-link {
            color: #fff;
            font-weight: 500;
            margin: 0 1rem;
            transition: color 0.2s;
        }

        .nav-link:hover {
            color: #ffe0c2;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header class="flex justify-between items-center px-8 py-6 bg-[#000000] bg-opacity-50" style="background: #F24C1A;">
        <div class="flex items-center gap-2">
            <img src="./assets/images/navbar.png" alt="Logo" class="w-64 h-auto">
        </div>
        <div class="flex items-center">
            <a href="register.php" class="header-btn">DAFTARKAN DIRIMU</a>
            <a href="login.php" class="header-btn">GABUNG BOLLYREADS</a>
        </div>
    </header>
    <!-- Main Content -->
    <main class="flex flex-col items-start justify-start min-h-[70vh] text-left px-4">
        <div class="relative w-full max-w-3xl" style="height:500px;">
            <video
                src="./assets/video/main.mp4"
                autoplay
                muted
                loop
                class="absolute top-0 left-1/2 transform-translate-x-1/2 h-full object-cover main-gif"
                style="z-index: 1; max-width:800px; width:100%;">
            </video>
            <div class="absolute inset-0" style="z-index: 2;"></div>
            <h1 class="main-title relative z-10 text-left w-full pl-4">
                <span>BACA ARTIKEL BOLLYWOOD</span>
                <span>YANG KEREN</span>
            </h1>
        </div>
    </main>
    <!-- Footer -->
    <footer class="text-white text-center pt-6 pb-2" style="background: #F24C1A;">
        <div class="font-bold">Cantika Melati Nugraini</div>
        <div class="text-xs mt-2">Pemrograman Web</div>
    </footer>
</body>

</html>