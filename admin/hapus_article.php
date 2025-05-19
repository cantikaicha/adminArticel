<?php
session_start();
include '../koneksi.php';

// Cek apakah user sudah login dan memiliki role admin
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Ambil informasi gambar sebelum menghapus artikel
    $sql = "SELECT image_url FROM article WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $article = $result->fetch_assoc();
    
    // Hapus artikel dari database
    $sql = "DELETE FROM article WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        // Hapus file gambar jika ada
        if ($article && $article['image_url']) {
            $image_path = "../assets/artikel/" . $article['image_url'];
            if (file_exists($image_path)) {
                unlink($image_path);
            }
        }
        
        // Hapus relasi di tabel lain
        $sql = "DELETE FROM article_author WHERE article_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        
        $sql = "DELETE FROM article_category WHERE article_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        
        $sql = "DELETE FROM favorite WHERE article_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        
        header("Location: ../dashboard.php");
        exit();
    } else {
        echo "Gagal menghapus artikel";
    }
} else {
    header("Location: ../dashboard.php");
    exit();
}
?>
