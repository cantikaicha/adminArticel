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


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Cek duplikasi username/email
    $checkQuery = "SELECT * FROM author WHERE username = ? OR email = ?";
    $stmt = $conn->prepare($checkQuery);
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if ($user['username'] === $username) {
            $error = "Username sudah terdaftar!";
        } else {
            $error = "Email sudah terdaftar!";
        }
    } else {
        // Dapatkan author_id terakhir
        $lastIdQuery = "SELECT MAX(author_id) as max_id FROM author";
        $lastIdResult = mysqli_query($conn, $lastIdQuery);
        $row = mysqli_fetch_assoc($lastIdResult);
        $newId = ($row['max_id'] ?? 0) + 1;

        $query = "INSERT INTO author (author_id, username, email, password) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("isss", $newId, $username, $email, $password);

        if ($stmt->execute()) {
            $success = "Registrasi berhasil! Silakan <a href='login.php'>login di sini</a>.";
        } else {
            $error = "Registrasi gagal: " . $conn->error;
        }
    }

    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bollyreads | Daftar</title>
    <link rel="icon" href="./assets/images/ICON1.png" type="image/png">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', Arial, sans-serif;
            background: linear-gradient(90deg, #ff7300 0%, #ff4e8e 100%);
            min-height: 100vh;
        }
        .btn-uniform {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 5px 1px 5px 1px;
            width: 100%;
            font-size: 1.2w;
            text-align: center;
            background: #ff7300;
            color: #fff;
            border: none;
            transition: background 0.3s;
        }
        .btn-uniform:hover {
            background: #ff4e8e;
            color: #fff;
        }
        .bg-wattpad {
            background: linear-gradient(90deg, #ff7300 0%, #ff4e8e 100%);
        }
        .sidebar-wattpad {
            background: #fff;
            border: 2px solid #ff7300;
        }
        .card-wattpad {
            background: #fff;
            border: 2px solid #ff4e8e;
        }
        .heading-wattpad {
            color: #fff;
            text-shadow: 1px 1px 8px #ff7300;
        }
        .text-orange-wattpad {
            color: #ff7300;
        }
    </style>
</head>

<body class="bg-black bg-opacity-60 text-white"
    style="background-image: url('./assets/images/background.jpg');">
    <a href="index.php" class="bg-black bg-opacity-60 flex items-center px-6 py-4">
        <img src="./assets/images/navbar3.png" alt="Logo" class="w-56 h-auto lg:w-60">
    </a>
    <div class="flex items-center justify-center h-screen">
        <div class="w-full max-w-md bg-black bg-opacity-60 p-12 rounded-sm shadow-lg">
            <h2 class="text-3xl font-bold text-center mb-2">Daftar</h2>

            <?php if (isset($error))
                echo "<div class='bg-red-500 text-white p-1 rounded mb-1 text-sm'>{$error}</div>"; ?>
            <?php if (isset($success))
                echo "<div class='bg-green-500 text-white p-1 rounded mb-1 text-sm'>{$success}</div>"; ?>

            <form action="" method="POST" class="space-y-6">
                <div>
                    <label for="username" class="block text-sm font-semibold mb-2">Username</label>
                    <input id="username" type="text" name="username" required
                        class="w-full py-2.5 px-3 rounded-sm border border-[#ff7300] bg-gray-800 bg-opacity-65 text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-white"
                        placeholder="Masukkan Username">
                </div>
                <div>
                    <label for="email" class="block text-sm font-semibold mb-2">Email</label>
                    <input id="email" type="text" name="email" required
                        class="w-full py-2.5 px-3 rounded-sm border border-[#ff7300] bg-gray-800 bg-opacity-65 text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-white"
                        placeholder="Masukkan Email">
                </div>
                <div>
                    <label for="password" class="block text-sm font-semibold mb-2">Password</label>
                    <input id="password" type="password" name="password" required
                        class="w-full py-2.5 px-3 rounded-sm border border-[#ff7300] bg-gray-800 bg-opacity-65 text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-white"
                        placeholder="Masukkan Password">
                </div>

                <div>
                    <button type="submit"
                        class="w-full bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-3 rounded-sm transition-all duration-400">
                        Daftar
                    </button>
                </div>
            </form>

            <p class="mt-6 text-center text-sm">
                Sudah punya akun? <a href="login.php"
                    class="text-orange-500 font-semibold duration-500 transition-all underline">
                    Login di sini
                </a>
            </p>
        </div>
    </div>
    <footer class="text-white px-8 bg-black rounded-lg ">
        <div class="container mx-auto py-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-lg font-bold mb-4 underline">Kategori</h3>
                    <ul class="text-sm space-y-2">
                        <li>Final Project</li>
                        <li>Pemrograman Website</li>
                        <li>Laravel 10</li>
                        <li>CRUD</li>
                        <li>MySQL</li>
                        <li>Autentikasi</li>
                        <li>Tailwind CSS</li>
                        <li>Middleware</li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-bold mb-4 underline">Genre</h3>
                    <ul class="text-sm space-y-2">
                        <li>Action</li>
                        <li>Adventure</li>
                        <li>Marvel</li>
                        <li>Sci-Fi</li>
                        <li>DC</li>
                        <li>Romance</li>
                        <li>Comedy</li>
                        <li>Anime</li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-bold mb-4 underline">Lokasi</h3>
                    <div class="text-sm">
                        <p>Semolowaru Utara VIII / 21, Sukolilo, Jawa Timur, Indonesia 60119</p>
                        <p>Institut Teknologi Sepuluh Nopember</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="inline-block sm:flex sm:items-center lg:flex lg:items-center gap-2 mb-6 xs:gap-x-16 gap-x-20">
            <div class="inline-block">
                <h1 class="font-bold mt-6">Alvin Zanua Putra</h1>
                <div class="flex items-center gap-2 mt-6">
                    <a href="https://www.instagram.com/alvinzanua" target="__blank"
                        class="flex items-center gap-2 rounded-full border border-white">
                        <button
                            class="rounded-full p-3 bg-neutral-700 flex items-center justify-center cursor-pointer hover:opacity-75 transition">
                            <i class="fab fa-instagram text-white"></i>
                        </button>
                    </a>
                    <a href="https://wa.me/6281217835337" target="__blank"
                        class="flex items-center gap-2 rounded-full border border-white">
                        <button
                            class="rounded-full p-3 bg-neutral-700 flex items-center justify-center cursor-pointer hover:opacity-75 transition">
                            <i class="fab fa-whatsapp text-white"></i>
                        </button>
                    </a>
                    <a href="https://x.com/AlvinZanua" class="flex items-center gap-2 rounded-full border border-white"
                        target="__blank">
                        <button
                            class="rounded-full p-3 bg-neutral-700 flex items-center justify-center cursor-pointer hover:opacity-75 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#fff"
                                viewBox="0 0 256 256">
                                <path
                                    d="M214.75,211.71l-62.6-98.38,61.77-67.95a8,8,0,0,0-11.84-10.76L143.24,99.34,102.75,35.71A8,8,0,0,0,96,32H48a8,8,0,0,0-6.75,12.3l62.6,98.37-61.77,68a8,8,0,1,0,11.84,10.76l58.84-64.72,40.49,63.63A8,8,0,0,0,160,224h48a8,8,0,0,0,6.75-12.29ZM164.39,208,62.57,48h29L193.43,208Z">
                                </path>
                            </svg>
                        </button>
                    </a>
                    <a href="https://www.linkedin.com/in/alvin-zanua-putra-34a758288" target="__blank"
                        class="flex items-center gap-2 rounded-full border border-white">
                        <button
                            class="rounded-full p-3 bg-neutral-700 flex items-center justify-center cursor-pointer hover:opacity-75 transition">
                            <i class="fab fa-linkedin text-white"></i>
                        </button>
                    </a>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center border-t-2 py-2 border-gray-500">
            <div class="flex flex-wrap items-center gap-4 text-xs md:text-sm">
                <ul class="flex flex-wrap items-center gap-4">
                    <li>Kebijakan</li>
                    <li>Keamanan</li>
                    <li>Privasi</li>
                    <li>Cookies</li>
                    <li>Iklan</li>
                    <li>Lainnya</li>
                </ul>
            </div>
            <div class="text-xs md:text-sm font-semibold flex md:justify-end py-4 pr-8">
                <p>Kuliah Pemrograman Web Jurusan Teknik Informatika ITS (2024).
                    Dosen: Imam Kuswardayan, S.Kom, M.T.</p>
            </div>
        </div>
    </footer>
    <script src="https://cdn.tailwindcss.com"></script>
</body>

</html>