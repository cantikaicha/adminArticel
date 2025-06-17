<?php
session_start();
include 'koneksi.php';


// Pastikan user telah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];

// Query untuk mengambil data favorite
$query = "SELECT a.*, f.username 
          FROM favorite f 
          JOIN article a ON f.article_id = a.id 
          WHERE f.username = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bollyreads | Favorite</title>
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

        /* Media query untuk ukuran layar kecil */
        @media (max-width: 768px) {
            .btn-uniform {
                font-size: 1rem;
            }
        }

        @media (max-width: 480px) {
            .btn-uniform {
                font-size: 0.8rem;
            }
        }
    </style>
</head>

<body class="card-wattpad">
    <div class="flex flex-col md:flex-row lg:p-2 lg:ml-2 bg-white">
        <!-- Sidebar -->
        <div class="hidden md:block w-64 sidebar-wattpad fixed justify-between inset-y-0 left-0 md:flex flex-col items-center py-4 px-2 m-2 rounded-lg">
            <div class="flex flex-wrap">
                <a href="dashboard.php" class="flex items-center">
                    <img src="./assets/images/navbar3.png" alt="Logo" class="w-40 h-auto lg:w-60 pb-6">
                </a>
                <a href="dashboard.php"
                    class="flex items-center gap-x-2 w-full py-2 px-4 text-center text-[#ff7300] rounded mb-4 font-bold hover:text-[#ff730f] duration-500 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="#ff7300" viewBox="0 0 256 256">
                        <path d="M208,32H48A16,16,0,0,0,32,48V208a16,16,0,0,0,16,16H208a16,16,0,0,0,16-16V48A16,16,0,0,0,208,32Zm-16,72h16v48H192Zm16-16H192V48h16ZM48,48H176V208H48ZM208,208H192V168h16v40Zm-56.25-42a39.76,39.76,0,0,0-17.19-23.34,32,32,0,1,0-45.12,0A39.84,39.84,0,0,0,72.25,166a8,8,0,0,0,15.5,4c2.64-10.25,13.06-18,24.25-18s21.62,7.73,24.25,18a8,8,0,1,0,15.5-4ZM96,120a16,16,0,1,1,16,16A16,16,0,0,1,96,120Z"></path>
                    </svg>
                    Daftar Artikel
                </a>
                <a href="favorite_article.php"
                    class="flex items-center gap-x-2 w-full py-2 px-4 text-center text-[#ff7300] rounded hover:text-[#ff730f] font-bold duration-500 transition-all"> <svg
                        xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="#ff7300" viewBox="0 0 256 256">
                        <path
                            d="M83.19,174.4a8,8,0,0,0,11.21-1.6,52,52,0,0,1,83.2,0,8,8,0,1,0,12.8-9.6A67.88,67.88,0,0,0,163,141.51a40,40,0,1,0-53.94,0A67.88,67.88,0,0,0,81.6,163.2,8,8,0,0,0,83.19,174.4ZM112,112a24,24,0,1,1,24,24A24,24,0,0,1,112,112Zm96-88H64A16,16,0,0,0,48,40V64H32a8,8,0,0,0,0,16H48v40H32a8,8,0,0,0,0,16H48v40H32a8,8,0,0,0,0,16H48v24a16,16,0,0,0,16,16H208a16,16,0,0,0,16-16V40A16,16,0,0,0,208,24Zm0,192H64V40H208Z">
                        </path>
                    </svg>
                    Artikel Favorit
                </a>
                <a href="logout.php" onclick="return confirm('Apakah Anda yakin ingin keluar ?');"
                    class="flex items-center gap-x-2 w-full py-2 px-4 text-center text-[#ff7300] rounded hover:text-[#ff730f] font-bold duration-500 transition-all mt-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="#ff7300" viewBox="0 0 256 256">
                        <path d="M120,216a8,8,0,0,1-8,8H48a8,8,0,0,1-8-8V40a8,8,0,0,1,8-8h64a8,8,0,0,1,0,16H56V208h56A8,8,0,0,1,120,216Zm109.66-93.66-40-40a8,8,0,0,0-11.32,11.32L204.69,120H112a8,8,0,0,0,0,16h92.69l-26.35,26.34a8,8,0,0,0,11.32,11.32l40-40A8,8,0,0,0,229.66,122.34Z"></path>
                    </svg>
                    Keluar
                </a>
            </div>
            <div class="bg-white rounded-lg mx-2 px-2 py-4 pr-8 border border-[#ff7300]" style="font-size: 15px;">
                <p>Masuk sebagai
                    <?php echo htmlspecialchars($_SESSION['email']); ?>
                </p>
            </div>
        </div>

        <div class="block md:hidden w-full py-4 px-2">
            <div class="flex justify-between items-center">
                <a href="dashboard.php" class="flex items-center ml-6">
                    <img src="./assets/images/navbar3.png" alt="Logo" class="w-52 h-auto lg:w-60">
                </a>
                <button id="menu-toggle" class=" rounded px-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#ff7300" viewBox="0 0 256 256">
                        <path
                            d="M224,128a8,8,0,0,1-8,8H40a8,8,0,0,1,0-16H216A8,8,0,0,1,224,128ZM40,72H216a8,8,0,0,0,0-16H40a8,8,0,0,0,0,16ZM216,184H40a8,8,0,0,0,0,16H216a8,8,0,0,0,0-16Z">
                        </path>
                    </svg>
                </button>
            </div>
            <div id="mobile-menu" class="hidden mt-4">
                <a href="dashboard.php"
                    class="flex items-center gap-x-2 w-full py-2 px-4 text-center rounded mb-4 text-[#ff7300] font-bold hover:text-[#ff730f] duration-500 transition-all"><svg
                        xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="#ff7300" viewBox="0 0 256 256">
                        <path
                            d="M208,32H48A16,16,0,0,0,32,48V208a16,16,0,0,0,16,16H208a16,16,0,0,0,16-16V48A16,16,0,0,0,208,32Zm-16,72h16v48H192Zm16-16H192V48h16ZM48,48H176V208H48ZM208,208H192V168h16v40Zm-56.25-42a39.76,39.76,0,0,0-17.19-23.34,32,32,0,1,0-45.12,0A39.84,39.84,0,0,0,72.25,166a8,8,0,0,0,15.5,4c2.64-10.25,13.06-18,24.25-18s21.62,7.73,24.25,18a8,8,0,1,0,15.5-4ZM96,120a16,16,0,1,1,16,16A16,16,0,0,1,96,120Z">
                        </path>
                    </svg>Daftar Artikel
                </a>
                <a href="favorite_article.php"
                    class="flex items-center gap-x-2 w-full py-2 px-4 text-center rounded hover:text- text-[#ff7300] font-bold duration-500 transition-all"><svg
                        xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="#ff7300" viewBox="0 0 256 256">
                        <path
                            d="M83.19,174.4a8,8,0,0,0,11.21-1.6,52,52,0,0,1,83.2,0,8,8,0,1,0,12.8-9.6A67.88,67.88,0,0,0,163,141.51a40,40,0,1,0-53.94,0A67.88,67.88,0,0,0,81.6,163.2,8,8,0,0,0,83.19,174.4ZM112,112a24,24,0,1,1,24,24A24,24,0,0,1,112,112Zm96-88H64A16,16,0,0,0,48,40V64H32a8,8,0,0,0,0,16H48v40H32a8,8,0,0,0,0,16H48v40H32a8,8,0,0,0,0,16H48v24a16,16,0,0,0,16,16H208a16,16,0,0,0,16-16V40A16,16,0,0,0,208,24Zm0,192H64V40H208Z">
                        </path>
                    </svg> Artikel Favorit
                </a>
                <a href="logout.php" onclick="return confirm('Apakah Anda yakin ingin keluar ?');"
                    class="flex items-center gap-x-2 w-full py-2 px-4 text-center rounded hover:text-blue-600 text-[#ff7300] font-bold duration-500 transition-all mt-4"><svg
                        xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="#ff7300" viewBox="0 0 256 256">
                        <path
                            d="M120,216a8,8,0,0,1-8,8H48a8,8,0,0,1-8-8V40a8,8,0,0,1,8-8h64a8,8,0,0,1,0,16H56V208h56A8,8,0,0,1,120,216Zm109.66-93.66-40-40a8,8,0,0,0-11.32,11.32L204.69,120H112a8,8,0,0,0,0,16h92.69l-26.35,26.34a8,8,0,0,0,11.32,11.32l40-40A8,8,0,0,0,229.66,122.34Z">
                        </path>
                    </svg>
                    Keluar
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="p-4 flex-1 md:ml-64 ml-2 mr-1 rounded-lg bg-wattpad">
            <div class="flex justify-between items-center mb-6">
                <h1 class="flex items-center text-2xl heading-wattpad font-bold gap-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#fff" viewBox="0 0 256 256">
                        <path
                            d="M220.17,100,202.86,70a28,28,0,0,0-38.24-10.25,27.69,27.69,0,0,0-9,8.34L138.2,38a28,28,0,0,0-48.48,0A28,28,0,0,0,48.15,74l1.59,2.76A27.67,27.67,0,0,0,38,80.41a28,28,0,0,0-10.24,38.25l40,69.32a87.47,87.47,0,0,0,53.43,41,88.56,88.56,0,0,0,22.92,3,88,88,0,0,0,76.06-132Zm-6.66,62.64A72,72,0,0,1,81.62,180l-40-69.32a12,12,0,0,1,20.78-12L81.63,132a8,8,0,1,0,13.85-8L62,66A12,12,0,1,1,82.78,54L114,108a8,8,0,1,0,13.85-8L103.57,58h0a12,12,0,1,1,20.78-12l33.42,57.9a48,48,0,0,0-5.54,60.6,8,8,0,0,0,13.24-9A32,32,0,0,1,172.78,112a8,8,0,0,0,2.13-10.4L168.23,90A12,12,0,1,1,189,78l17.31,30A71.56,71.56,0,0,1,213.51,162.62ZM184.25,31.71A8,8,0,0,1,194,26a59.62,59.62,0,0,1,36.53,28l.33.57a8,8,0,1,1-13.85,8l-.33-.57a43.67,43.67,0,0,0-26.8-20.5A8,8,0,0,1,184.25,31.71ZM80.89,237a8,8,0,0,1-11.23,1.33A119.56,119.56,0,0,1,40.06,204a8,8,0,0,1,13.86-8,103.67,103.67,0,0,0,25.64,29.72A8,8,0,0,1,80.89,237Z">
                        </path>
                    </svg>Daftar Favorite: <?php echo htmlspecialchars($username); ?>
                </h1>
            </div>

            <!-- articel_fav List -->
            <?php if ($result->num_rows > 0): ?>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-2">
                    <?php while ($articel_favorite = $result->fetch_assoc()): ?>
                        <div class="card-wattpad rounded-md border border-white overflow-hidden shadow-lg">
                            <img src="./assets/artikel/<?php echo htmlspecialchars($articel_favorite['image_url']); ?>" alt="Poster Film"
                                class="w-full h-84 object-cover">
                            <div class="p-4">
                                <h3 class="text-lg font-bold text-orange-wattpad truncate underline"
                                    title="<?php echo htmlspecialchars($articel_favorite['title']); ?>">
                                    <?php echo htmlspecialchars($articel_favorite['title']); ?>
                                </h3>
                                <p class="text-sm mb-2 text-gray-800 truncate"
                                    title="<?php echo htmlspecialchars($articel_favorite['publish_date']); ?>">
                                    Tanggal Rilis: <?php echo htmlspecialchars($articel_favorite['publish_date']); ?>
                                </p>
                                <p class="text-xs text-gray-800 mb-2 line-clamp-3"
                                    title="<?php echo htmlspecialchars($articel_favorite['content']); ?>">
                                    <?php echo htmlspecialchars($articel_favorite['content']); ?>
                                </p>
                                <div class="flex items-center gap-x-2 text-xs">
                                    <a href="detail_article.php?id=<?php echo htmlspecialchars($articel_favorite['id']); ?>"
                                        class="btn-uniform bg-orange-500 hover:bg-orange-600 text-white rounded flex items-center justify-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-4 h-4"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M6.79 5.093A.5.5 0 0 1 7.5 5.5v5a.5.5 0 0 1-.71.458L3.71 8.457a.5.5 0 0 1 0-.914L6.79 5.093z" />
                                            <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zM8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14z" />
                                        </svg>
                                        Baca
                                    </a>
                                    <a href="hapus_artikel_favorit.php?id=<?php echo htmlspecialchars($articel_favorite['id']); ?>"
                                        class="btn-uniform bg-red-600 hover:bg-red-700 text-white rounded flex items-center justify-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-4 h-4"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5.5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6zm2-.5a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5z" />
                                            <path fill-rule="evenodd"
                                                d="M14.5 3a1 1 0 0 1-1 1H13v9.5a2.5 2.5 0 0 1-2.5 2.5h-5A2.5 2.5 0 0 1 3 13.5V4h-.5a1 1 0 0 1-1-1v-1a1 1 0 0 1 1-1H5.5l1-1h3l1 1h2.5a1 1 0 0 1 1 1v1zM4 4v9.5A1.5 1.5 0 0 0 5.5 15h5a1.5 1.5 0 0 0 1.5-1.5V4H4z" />
                                        </svg>
                                        Hapus
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php else: ?>
                <p class="text-white underline font-bold">Belum ada artikel favorit yang Anda tambahkan.</p>
            <?php endif; ?>

            <!-- Footer -->
            <footer class="text-gray-800 px-8 bg-white rounded-lg mt-6 card-wattpad">
                <div class="container mx-auto py-8">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                        <div>
                            <h3 class="text-lg font-bold mb-4 text-orange-wattpad">Genre</h3>
                            <ul class="text-sm space-y-2 text-gray-800">
                                <li>Action</li>
                                <li>Kekaisaran</li>
                                <li>Drama</li>
                                <li>Romance</li>
                                <li>Comedy</li>
                            </ul>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold mb-4 text-orange-wattpad">Lokasi</h3>
                            <div class="text-sm text-gray-800">
                                <p>Jalan Gajayana No. 50 Malang 65144</p>
                                <p>UNIVERSITAS ISLAM NEGERI MAULANA MALIK IBRAHIM MALANG</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="inline-block sm:flex sm:items-center lg:flex lg:items-center gap-2 mb-6 xs:gap-x-16 gap-x-20">
                    <div class="inline-block">
                        <h1 class="font-bold mt-6 text-gray-800">Cantika Melati Nugraini</h1>
                        <div class="flex items-center gap-2 mt-6">
                            <a href="https://www.instagram.com/cantikamelatii/" target="__blank"
                                class="flex items-center gap-2 rounded-full border border-orange-500">
                                <button
                                    class="rounded-full p-3 bg-orange-500 flex items-center justify-center cursor-pointer hover:bg-orange-600 transition">
                                    <i class="fab fa-instagram text-white"></i>
                                </button>
                            </a>
                            <a href="https://wa.me/6285894122396" target="__blank"
                                class="flex items-center gap-2 rounded-full border border-orange-500">
                                <button
                                    class="rounded-full p-3 bg-orange-500 flex items-center justify-center cursor-pointer hover:bg-orange-600 transition">
                                    <i class="fab fa-whatsapp text-white"></i>
                                </button>
                            </a>
                            <a href="https://x.com/cantikaicha7?s=09"
                                class="flex items-center gap-2 rounded-full border border-orange-500" target="__blank">
                                <button
                                    class="rounded-full p-3 bg-orange-500 flex items-center justify-center cursor-pointer hover:bg-orange-600 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#fff"
                                        viewBox="0 0 256 256">
                                        <path
                                            d="M214.75,211.71l-62.6-98.38,61.77-67.95a8,8,0,0,0-11.84-10.76L143.24,99.34,102.75,35.71A8,8,0,0,0,96,32H48a8,8,0,0,0-6.75,12.3l62.6,98.37-61.77,68a8,8,0,1,0,11.84,10.76l58.84-64.72,40.49,63.63A8,8,0,0,0,160,224h48a8,8,0,0,0,6.75-12.29ZM164.39,208,62.57,48h29L193.43,208Z">
                                        </path>
                                    </svg>
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center border-t-2 py-2 border-orange-500">
                    <div class="flex flex-wrap items-center gap-4 text-xs md:text-sm text-gray-800">
                        <ul class="flex flex-wrap items-center gap-4">
                            <li>Kebijakan</li>
                            <li>Keamanan</li>
                            <li>Privasi</li>
                            <li>Cookies</li>
                            <li>Iklan</li>
                            <li>Lainnya</li>
                        </ul>
                    </div>
                    <div class="text-xs md:text-sm font-semibold flex md:justify-end py-4 pr-8 text-gray-800">
                        <p>Kuliah Pemrograman Web Jurusan Teknik Informatika.
                            Dosen: A'la Syauqi, M.Kom</p>
                    </div>
                </div>
            </footer>
        </div>

        <div class="fixed bottom-4 right-4">
            <button id="scrollTopBtn"
                class="hidden bg-orange-500 border text-white px-4 py-2 rounded-full shadow-lg hover:bg-orange-600 transition">
                ↑ Top
            </button>
        </div>
    </div>

    <script>
        const toggleButton = document.getElementById('menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');

        toggleButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        const scrollTopBtn = document.getElementById('scrollTopBtn');

        // Tampilkan tombol saat scroll lebih dari 200px
        window.addEventListener('scroll', () => {
            if (window.scrollY > 200) {
                scrollTopBtn.classList.remove('hidden');
            } else {
                scrollTopBtn.classList.add('hidden');
            }
        });

        // Scroll ke atas saat tombol diklik
        scrollTopBtn.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    </script>
    <script src="https://cdn.tailwindcss.com"></script>
</body>

</html>