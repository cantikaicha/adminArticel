<?php
session_start();
include 'koneksi.php';

// Cek apakah user sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $username = $_SESSION['username'];

    // Query untuk menghapus artikel favorit berdasarkan article_id dan username
    $sql = "DELETE FROM favorite WHERE article_id = ? AND username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $id, $username);

    if ($stmt->execute()) {
        // Jika penghapusan berhasil
        echo "<script>
            alert('Artikel berhasil dihapus dari favorit');
            window.location.href = 'favorite_article.php';
        </script>";
    } else {
        // Jika penghapusan gagal
        echo "<script>
            alert('Gagal menghapus artikel dari favorit: " . $conn->error . "');
            window.location.href = 'favorite_article.php';
        </script>";
    }
} else {
    // Jika ID tidak ditemukan dalam URL
    echo "<script>
        alert('ID artikel tidak ditemukan');
        window.location.href = 'favorite_article.php';
    </script>";
}
?>