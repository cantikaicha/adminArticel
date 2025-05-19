<?php
session_start();
include '../koneksi.php';

// Cek apakah user sudah login dan memiliki role admin
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

// Ambil data artikel yang akan diedit
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM article WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $article = $result->fetch_assoc();

    // Fetch current category
    $sql_category = "SELECT category_id FROM article_category WHERE article_id = ?";
    $stmt_category = $conn->prepare($sql_category);
    $stmt_category->bind_param("i", $id);
    $stmt_category->execute();
    $result_category = $stmt_category->get_result();
    $current_category = $result_category->fetch_assoc();

    // Fetch all categories
    $sql_categories = "SELECT * FROM category";
    $result_categories = $conn->query($sql_categories);
    $categories = $result_categories->fetch_all(MYSQLI_ASSOC);

    if (!$article) {
        header("Location: ../dashboard.php");
        exit();
    }
} else {
    header("Location: ../dashboard.php");
    exit();
}

// Proses form edit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $publish_date = $_POST['publish_date'];
    $category_id = $_POST['category_id'];
    
    // Handle file upload
    $image_url = $article['image_url']; // Default ke gambar yang ada
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $target_dir = "../assets/artikel/";
        $file_extension = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
        $new_filename = uniqid() . '.' . $file_extension;
        $target_file = $target_dir . $new_filename;

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            // Hapus gambar lama jika ada
            if ($article['image_url'] && file_exists($target_dir . $article['image_url'])) {
                unlink($target_dir . $article['image_url']);
            }
            $image_url = $new_filename;
        }
    }

    $sql = "UPDATE article SET title = ?, content = ?, image_url = ?, publish_date = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $title, $content, $image_url, $publish_date, $id);
    
    if ($stmt->execute()) {
        // Update category
        $sql_delete_category = "DELETE FROM article_category WHERE article_id = ?";
        $stmt_delete = $conn->prepare($sql_delete_category);
        $stmt_delete->bind_param("i", $id);
        $stmt_delete->execute();

        $sql_insert_category = "INSERT INTO article_category (article_id, category_id) VALUES (?, ?)";
        $stmt_insert = $conn->prepare($sql_insert_category);
        $stmt_insert->bind_param("ii", $id, $category_id);
        $stmt_insert->execute();

        header("Location: ../dashboard.php");
        exit();
    } else {
        $error = "Gagal mengupdate artikel";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Artikel - Bollyreads</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
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
<body class="card-wattpad">
    <div class="flex flex-col md:flex-row lg:p-2 lg:ml-2 bg-white">
        <!-- Sidebar -->
        <div class="hidden md:block w-64 sidebar-wattpad fixed justify-between inset-y-0 left-0 md:flex flex-col items-center py-4 px-2 m-2 rounded-lg">
            <div class="flex flex-wrap">
                <a href="../dashboard.php" class="flex items-center">
                    <img src="../assets/images/navbar3.png" alt="Logo" class="w-40 h-auto lg:w-60 pb-6">
                </a>
                <a href="../dashboard.php"
                    class="flex items-center gap-x-2 w-full py-2 px-4 text-center text-[#ff7300] rounded mb-4 font-bold hover:text-[#ff730f] duration-500 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="#ff7300" viewBox="0 0 256 256">
                        <path d="M208,32H48A16,16,0,0,0,32,48V208a16,16,0,0,0,16,16H208a16,16,0,0,0,16-16V48A16,16,0,0,0,208,32Zm-16,72h16v48H192Zm16-16H192V48h16ZM48,48H176V208H48ZM208,208H192V168h16v40Zm-56.25-42a39.76,39.76,0,0,0-17.19-23.34,32,32,0,1,0-45.12,0A39.84,39.84,0,0,0,72.25,166a8,8,0,0,0,15.5,4c2.64-10.25,13.06-18,24.25-18s21.62,7.73,24.25,18a8,8,0,1,0,15.5-4ZM96,120a16,16,0,1,1,16,16A16,16,0,0,1,96,120Z"></path>
                    </svg>
                    Daftar Artikel
                </a>
                <a href="../favorite_article.php"
                    class="flex items-center gap-x-2 w-full py-2 px-4 text-center text-[#ff7300] rounded hover:text-[#ff730f] font-bold duration-500 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="#ff7300" viewBox="0 0 256 256">
                        <path d="M83.19,174.4a8,8,0,0,0,11.21-1.6,52,52,0,0,1,83.2,0,8,8,0,1,0,12.8-9.6A67.88,67.88,0,0,0,163,141.51a40,40,0,1,0-53.94,0A67.88,67.88,0,0,0,81.6,163.2,8,8,0,0,0,83.19,174.4ZM112,112a24,24,0,1,1,24,24A24,24,0,0,1,112,112Zm96-88H64A16,16,0,0,0,48,40V64H32a8,8,0,0,0,0,16H48v40H32a8,8,0,0,0,0,16H48v40H32a8,8,0,0,0,0,16H48v24a16,16,0,0,0,16,16H208a16,16,0,0,0,16-16V40A16,16,0,0,0,208,24Zm0,192H64V40H208Z"></path>
                    </svg>
                    Artikel Favorit
                </a>
                <a href="../logout.php" onclick="return confirm('Apakah Anda yakin ingin keluar ?');"
                    class="flex items-center gap-x-2 w-full py-2 px-4 text-center text-[#ff7300] rounded hover:text-[#ff730f] font-bold duration-500 transition-all mt-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="#ff7300" viewBox="0 0 256 256">
                        <path d="M120,216a8,8,0,0,1-8,8H48a8,8,0,0,1-8-8V40a8,8,0,0,1,8-8h64a8,8,0,0,1,0,16H56V208h56A8,8,0,0,1,120,216Zm109.66-93.66-40-40a8,8,0,0,0-11.32,11.32L204.69,120H112a8,8,0,0,0,0,16h92.69l-26.35,26.34a8,8,0,0,0,11.32,11.32l40-40A8,8,0,0,0,229.66,122.34Z"></path>
                    </svg>
                    Keluar
                </a>
            </div>
            <div class="bg-white rounded-lg mx-2 px-2 py-4 pr-8 border border-[#ff7300]" style="font-size: 15px;">
                <p>Masuk sebagai <?php echo htmlspecialchars($_SESSION['email']); ?></p>
            </div>
        </div>

        <!-- Main Content -->
        <div class="p-4 flex-1 md:ml-64 ml-2 mr-1 rounded-lg bg-wattpad">
            <div class="flex justify-between items-center mb-6">
                <h1 class="flex items-center text-2xl heading-wattpad font-bold gap-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#fff" viewBox="0 0 256 256">
                        <path d="M220.17,100,202.86,70a28,28,0,0,0-38.24-10.25,27.69,27.69,0,0,0-9,8.34L138.2,38a28,28,0,0,0-48.48,0A28,28,0,0,0,48.15,74l1.59,2.76A27.67,27.67,0,0,0,38,80.41a28,28,0,0,0-10.24,38.25l40,69.32a87.47,87.47,0,0,0,53.43,41,88.56,88.56,0,0,0,22.92,3,88,88,0,0,0,76.06-132Zm-6.66,62.64A72,72,0,0,1,81.62,180l-40-69.32a12,12,0,0,1,20.78-12L81.63,132a8,8,0,1,0,13.85-8L62,66A12,12,0,1,1,82.78,54L114,108a8,8,0,1,0,13.85-8L103.57,58h0a12,12,0,1,1,20.78-12l33.42,57.9a48,48,0,0,0-5.54,60.6,8,8,0,0,0,13.24-9A32,32,0,0,1,172.78,112a8,8,0,0,0,2.13-10.4L168.23,90A12,12,0,1,1,189,78l17.31,30A71.56,71.56,0,0,1,213.51,162.62ZM184.25,31.71A8,8,0,0,1,194,26a59.62,59.62,0,0,1,36.53,28l.33.57a8,8,0,1,1-13.85,8l-.33-.57a43.67,43.67,0,0,0-26.8-20.5A8,8,0,0,1,184.25,31.71ZM80.89,237a8,8,0,0,1-11.23,1.33A119.56,119.56,0,0,1,40.06,204a8,8,0,0,1,13.86-8,103.67,103.67,0,0,0,25.64,29.72A8,8,0,0,1,80.89,237Z"></path>
                    </svg>
                    Edit Artikel
                </h1>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <?php if (isset($error)): ?>
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>

                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                            Judul Artikel
                        </label>
                        <input type="text" name="title" id="title" value="<?php echo htmlspecialchars($article['title']); ?>"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="content">
                            Konten
                        </label>
                        <textarea name="content" id="content" rows="10"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"><?php echo htmlspecialchars($article['content']); ?></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="category">
                            Kategori
                        </label>
                        <select name="category_id" id="category" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <?php foreach ($categories as $category): ?>
                                <option value="<?php echo $category['id']; ?>" <?php echo ($current_category && $current_category['category_id'] == $category['id']) ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($category['name']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="image">
                            Gambar
                        </label>
                        <input type="file" name="image" id="image" accept="image/*"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <?php if ($article['image_url']): ?>
                            <p class="text-sm text-gray-600 mt-2">Gambar saat ini: <?php echo htmlspecialchars($article['image_url']); ?></p>
                            <img src="../assets/artikel/<?php echo htmlspecialchars($article['image_url']); ?>" alt="Gambar Artikel" class="w-32 h-auto">
                        <?php endif; ?>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="publish_date">
                            Tanggal Publikasi
                        </label>
                        <input type="date" name="publish_date" id="publish_date" value="<?php echo $article['publish_date']; ?>"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>

                    <div class="flex items-center justify-between">
                        <button type="submit"
                            class="bg-orange-500 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Simpan Perubahan
                        </button>
                        <a href="../dashboard.php"
                            class="text-orange-500 hover:text-orange-700 font-bold">
                            Kembali ke Dashboard
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
