-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 19 Bulan Mei 2025 pada 17.45
-- Versi server: 8.0.30
-- Versi PHP: 8.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog_bollywood2`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `article`
--

CREATE TABLE `article` (
  `id` int NOT NULL,
  `title` varchar(534) COLLATE utf8mb4_general_ci NOT NULL,
  `content` text COLLATE utf8mb4_general_ci NOT NULL,
  `image_url` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `publish_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `article`
--

INSERT INTO `article` (`id`, `title`, `content`, `image_url`, `publish_date`) VALUES
(1, 'Kabhi Khushi Kabhie Gham', 'Anak 20-an pasti sudah tidak asing lagi dengan film legendaris ini. Film India bergenre romantis yang cukup fenomenal di masanya yaitu tahun 2001 dan bahkan masih fenomenal sampai sekarang. Film ini bercerita tentang kisah yang terjadi di suatu keluarga yang ceritanya mengandung bawang karena saking sedihnya.\nDikisahkan, Yashvardhan Raichand dan sang istri bernama Nandini Raichand memutuskan akan mengadopsi seorang anak laki-laki bernama Rahul Raichand yang berumur 8 tahun.\nKetika dewasa, sosok Rahul kecil diperankan Shah Rukh Khan. Suatu hari, Rahul bertemu Anjali, seorang gadis cantik dan ceria yang diperankan Kajol. Singkatnya, Rahul telah jatuh cinta pada Anjali. Tapi sayangnya, keluarganya tak merestui hubungan mereka, karena Anjali berasal dari keluarga biasa. Sejak saat itu lah konflik terus terjadi dan kisah yang menguras air mata.\n', 'Picture1.jpg', '2025-04-17'),
(2, 'Ek Villain', 'Film yang ditayangkan pada tahun 2014 ini berhasil mencuri perhatian di seluruh dunia karena alur cerita yang menarik. Cerita sedih, kesal, romantis ada pada film satu ini, pecinta Bollywood pasti akan mengakui bahwa film ini terlalu worth it untuk di tonton.\r\nFilm ini berkisah tentang Guru, seorang mantan penjahat yang marah karena istrinya dibunuh oleh pembunuh berantai kejam, Rakesh. Guru (Sidharth Malhotra) adalah seorang penjahat yang berubah setelah jatuh cinta dengan Aisha (Shraddha Kapoor). Ia mencoba hidup normal, tetapi kehidupannya hancur ketika Aisha dibunuh oleh pembunuh berantai bernama Rakesh (Riteish Deshmukh). Guru kemudian membalaskan dendamnya kepada Rakesh.\r\n', 'Picture2.jpg', '2025-04-17'),
(3, 'Aashiqui 2', 'Film yang terkenal dengann soundtrack ‘Tum Hi Ho’ ini dirilis pada tahun 2013, yang dimana film ini menyentuh hati banyak penonton dengan kisah cinta yang intens dan penuh kesedihan. film ini adalah sekuel dari film \'Aashiqui\' yang dirilis pada tahun 1990. \'Aashiqui 2\' mengisahkan tentang cinta yang indah namun penuh dengan penderitaan dan pengorbanan, menjadikannya sebuah perjalanan emosional yang mendalam.\r\n\'Aashiqui 2\' mengikuti kisah Rahul (diperankan oleh Aditya Roy Kapur), seorang penyanyi terkenal yang sedang berada di puncak kariernya namun terjebak dalam kecanduan alkohol dan depresi. Hidupnya berubah drastis saat ia bertemu dengan Aarohi (diperankan oleh Shraddha Kapoor), seorang penyanyi kafe yang memiliki bakat luar biasa tetapi belum dikenal. Rahul melihat potensi besar dalam diri Aarohi dan memutuskan untuk membantunya mencapai impian di dunia musik.\r\nSeiring waktu, hubungan antara Rahul dan Aarohi berkembang dari kerja sama profesional menjadi cinta yang dalam. Namun, kesuksesan Aarohi juga membawa tantangan besar dalam hubungan mereka. Rahul, yang semakin tenggelam dalam kecanduan alkohol dan perasaannya yang gelap, mulai menunjukkan sisi destruktif yang mempengaruhi kehidupan Aarohi. Konflik ini membangun ketegangan emosional yang memuncak dalam akhir cerita yang tragis.\r\n', 'Picture3.jpg', '2025-04-17'),
(4, 'Padmavati', 'Film ini tayang pada tahun 2018 dengan latar kerajaan yang mengambil cerita dari kerajaan di India pada abad abad lalu. Ceita film ini sangatlah menarik dan banyak pelajaran yang dapat dipetik, misalnya keadilan, kesetiaan, dan keserakahan yang musnah.\r\nPadmaavat mengisahkan Padmavati (Deepika Padukone), seorang putri kerajaan Sinhala yang menikah dengan Raja Rajput, Ratan Singh (Shahid Kapoor). Kisah tersebut berkelindan dengan perjalanan Alauddin Khilji (Ranveer Singh) yang berambisi menjadi raja Delhi dan menaklukkan kerajaan-kerajaan lainnya. Sebab pengaruh dan sakit hati Raghav Chetan, seorang Brahma yang diusir dari Mewar Ratan Singh, Alauddin dengan tekad bajanya bersikeras ingin merebut sang ratu Padmavati dari kerajaannya. Disinilah keberanian, ketegasan dan kecerdasan Padmavati diuji untuk menghadapi Alauddin Khilji yang digambarkan sebagai seorang raja yang keji.\r\nKisah Rani Padmavati sendiri memiliki beragam versi, antara lain versi Malik Mohammad Jayasi, James Tod, Hemratan, dan berbagai karya literatur lainnya.\r\n', 'Picture4.jpg', '2018-02-02'),
(5, 'Sanam Teri Kasam', 'Film yang rilis pada tahun 2016 ini berhasil mencuri hati para penonton. Perjuangan cinta yang apik dan menguras emosi dan adat istiadat India juga digambarkan dalam film ini.\r\nBerkisah tentang Saru, seorang pustakawan muda yang kesulitan mendapatkan pasangan karena dianggap kurang menarik. Tekanan datang dari keluarga, terutama saat tunangan adiknya memberi batas waktu satu bulan untuk Saru menikah. Ayahnya pun tidak merestui hubungan apa pun, membuat Saru merasa terpinggirkan.\r\nDalam keputusasaan, Saru bertemu Inder, mantan narapidana yang tinggal satu apartemen. Awalnya mereka bertemu tak sengaja, lalu menjadi dekat, meski hubungan mereka tak direstui. Saat Saru jatuh sakit, dokter menyatakan ia mengidap meningoma dan tak punya banyak waktu. Ia pun meminta Inder untuk menikahinya. Mereka sempat merasakan kebahagiaan singkat sebelum akhirnya Saru meninggal di pelukan Inder, yang terus mengenangnya setelah kepergiannya.', 'Picture5.jpg', '2025-04-17'),
(6, 'Teri Baaton Mein Aisa Uljha Jiya', 'Film ini rilis pada tahun 2024, film ini menggabungkan unsur Artificial Intelligence (AI), perasaan  manusia, dan teknologi. Film ini bercerita tentang  kisah cinta antara Aryan Agnihotri (Shahid Kapoor) dan Sifra (Kriti Sanon), robot wanita super cerdas.\r\nFilm ini menceritakan Aryan, insinyur robotika asal India, yang pergi ke AS dan jatuh cinta pada SIFRA asisten cerdas yang ternyata adalah robot ciptaan bibinya. Setelah mengetahui identitas asli SIFRA, Aryan patah hati dan kembali ke India untuk menjalani perjodohan. Namun, ia tak bisa melupakan SIFRA dan akhirnya membawanya pulang sebagai calon istri, tanpa memberi tahu keluarganya bahwa SIFRA adalah robot. Hubungan mereka diuji saat SIFRA mengalami kerusakan sistem, termasuk di hari pernikahan. Film ini memadukan komedi, romansa, dan refleksi etis tentang hubungan manusia dengan kecerdasan buatan.\r\n', 'Picture6.jpg', '2025-04-17'),
(7, 'Dilwale', 'Film ini rilis tahun 2015 yang dibintangi oleh 2 artis terkenal Bollywood, yaitu Kajol dan Shahrukh Khan. Film ini bercerita tentang perjalanan cinta antara Raj (Sha Rukh Khan) dan Meera (Kajol) yang terpisah karena kesalahpahaman.\r\nDilwale mengisahkan Raj, pemimpin klan gangster di Bulgaria, yang terjebak dalam konflik antara dua keluarga kriminal. Hidupnya berubah ketika ia jatuh cinta pada Meera, tanpa mengetahui bahwa Meera adalah putri musuh utamanya. Hubungan mereka hancur karena pengkhianatan masa lalu. Bertahun-tahun kemudian, adik Raj, Veer, jatuh cinta pada adik Meera, mempertemukan kembali dua keluarga yang berseteru. Lewat serangkaian kilas balik dan aksi penuh ketegangan, rahasia lama terungkap dan kesalahpahaman diselesaikan, hingga akhirnya Raj dan Meera kembali bersatu.\r\n', 'Picture7.jpg', '2025-04-17'),
(8, 'Ramaiya Vastavaiya', 'Film ini rilis pada tahun 2013, dibintangi oleh Girish Kumar (Ram) bersama Shruti Haasan (Sona) dalam peran utama. Film ini tidak hanya bergenre romantis tapi juga diselingi drama komedi yang dijamin ceritanya tidak membosankan.\r\nSona, gadis desa dari Punjab, dibesarkan oleh kakaknya, Raghuveer. Hidup mereka sulit karena hutang kepada Zamindar. Saat Ram, pemuda kaya dari Australia, datang ke desa untuk menghadiri pernikahan sepupunya, ia bertemu Sona. Meski awalnya tak akur, cinta tumbuh di antara mereka. Namun, ibu Ram menentang hubungan itu karena perbedaan status sosial. Untuk membuktikan cintanya, Ram menerima tantangan Raghuveer bekerja di ladang. Setelah melewati banyak ujian dan menyelamatkan Sona dari penculikan, Ram berhasil mendapatkan restu keluarga. Meski Raghuveer harus dipenjara karena melindungi Ram, ia akhirnya hadir di pernikahan adiknya yang penuh kebahagiaan.\r\n', 'Picture8.jpg', '2025-04-17'),
(9, 'Pal Pal Dil Ke Paas', 'Film bergenre romantis yang berlatar belakang sebuah pendakian gunung yang dilakukan seorang vlogger dan seorang pemilik kamp, kisah cinta mereka tumbuh dalam pendakian tersebut. Film yang dibintangi oleh Karan Deol (Karan Sehgal) dan Shaheer Bamba (Sahher Seth) ini dirilis pada 2019.\r\nFilm Pal Pal Dil Ke Paas menceritakan Sahher, seorang gadis terkenal di media sosial yang diminta datang ke tempat wisata alam untuk membuat ulasan. Tempat itu dikelola oleh Karan, seorang pria baik hati yang tinggal di pegunungan. Awalnya, Sahher menganggap tempat itu tidak sebanding dengan harganya, tapi setelah beberapa hari bersama Karan, dia mulai melihat sisi lain dari tempat itu dan dari Karan sendiri. Mereka mulai saling menyukai, meski belum berani mengungkapkan perasaan. Cerita ini menunjukkan bagaimana dua orang dari dunia yang berbeda bisa saling jatuh cinta lewat pengalaman sederhana.\r\n', 'Picture9.jpg', '2025-04-17'),
(10, 'Kal Ho Naa Ho', 'Film ini di rilis pada tahun 2003, film yang terkenal dengan cerita sedih dan pengorbanan perasaan cinta ini berhasil dibintangi oleh Preity Zinta (Naina), Shahrukh Khan (Aman).\r\nFilm Kal Ho Naa Ho berkisah tentang Naina, seorang mahasiswi di New York yang hidupnya kelam pasca kematian ayahnya dan konflik keluarga. Kehadiran tetangga ceria, Aman membawa perubahan positif dan cinta bagi Naina. Namun, Aman menyembunyikan penyakit jantungnya dan berusaha menjodohkan Naina dengan sahabatnya, Rohit. Setelah terungkap rahasia keluarga, mereka berdamai. Naina menikah dengan Rohit, dan Aman meninggal. Bertahun-tahun kemudian, Naina mengenang pengorbanan Aman.\r\n', 'Picture10.jpg', '2025-04-17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `article_author`
--

CREATE TABLE `article_author` (
  `article_id` int DEFAULT NULL,
  `author_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `article_author`
--

INSERT INTO `article_author` (`article_id`, `author_id`) VALUES
(1, 2),
(2, 2),
(3, 1),
(4, 2),
(8, 1),
(6, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `article_category`
--

CREATE TABLE `article_category` (
  `article_id` int DEFAULT NULL,
  `category_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `article_category`
--

INSERT INTO `article_category` (`article_id`, `category_id`) VALUES
(1, 4),
(2, 5),
(3, 4),
(4, 5),
(5, 6),
(6, 4),
(7, 5),
(8, 7),
(9, 8);

-- --------------------------------------------------------

--
-- Struktur dari tabel `author`
--

CREATE TABLE `author` (
  `author_id` int NOT NULL,
  `username` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `author`
--

INSERT INTO `author` (`author_id`, `username`, `email`, `password`) VALUES
(1, 'Cantika Melati', 'cantikamelati@gmail.com', '$2y$10$gvWl8.txfHeAKsGk4wG37u/3ka/T5PIT2hZ2aciHto.5JWUaMKXlC'),
(2, 'Ali Satri Efendi', 'alisatriefendi@gmail.com', '$2y$10$/xphEnWXRBdjah4otOVrgOV0i7FUoa155ap1cOuNx4GV1POKsrMCK'),
(3, 'alvinzanua', 'alvinzanua@gmail.com', '$2y$10$KVmzOPoW6EImcF/EVzNVluFj1UZMCiotLrytYyYN1N6VxaH0.7gRi'),
(4, 'jelekanjay', 'jelekanjay@gmail.com', '$2y$10$Zo25v5DnbpOpir4edomz7.heEWKr2nKR8nNUO7hKeL9139h.5yeJS');

-- --------------------------------------------------------

--
-- Struktur dari tabel `category`
--

CREATE TABLE `category` (
  `id` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `category`
--

INSERT INTO `category` (`id`, `name`, `description`) VALUES
(4, 'Film Drama', NULL),
(5, 'Romantis', NULL),
(6, 'Action', NULL),
(7, 'Drama kekaisaran', NULL),
(8, 'Drama', NULL),
(9, 'Komedi', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `favorite`
--

CREATE TABLE `favorite` (
  `id_fav` int NOT NULL,
  `article_id` int DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `author_id_author` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `favorite`
--

INSERT INTO `favorite` (`id_fav`, `article_id`, `username`, `author_id_author`) VALUES
(1, 1, 'Cantika Melati', NULL),
(2, 2, 'Cantika Melati', NULL),
(3, 3, 'Cantika Melati', NULL),
(8, 10, 'jelekanjay', NULL),
(9, 5, 'jelekanjay', NULL),
(10, 3, 'jelekanjay', NULL),
(11, 1, 'jelekanjay', NULL),
(12, 2, 'jelekanjay', NULL),
(13, 4, 'jelekanjay', NULL),
(14, 6, 'jelekanjay', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kontributor`
--

CREATE TABLE `kontributor` (
  `id` int NOT NULL,
  `author_id` int NOT NULL,
  `article_id` int NOT NULL,
  `category_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kontributor`
--

INSERT INTO `kontributor` (`id`, `author_id`, `article_id`, `category_id`) VALUES
(1, 2, 1, 4),
(2, 2, 2, 5),
(3, 2, 3, 4),
(4, 2, 4, 5),
(5, 2, 8, 7),
(6, 1, 5, 6),
(7, 1, 6, 4),
(8, 1, 7, 5),
(9, 3, 9, 8),
(10, 3, 10, 9);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `article_author`
--
ALTER TABLE `article_author`
  ADD KEY `article_id` (`article_id`),
  ADD KEY `author_id` (`author_id`);

--
-- Indeks untuk tabel `article_category`
--
ALTER TABLE `article_category`
  ADD KEY `article_id` (`article_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indeks untuk tabel `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`author_id`);

--
-- Indeks untuk tabel `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `favorite`
--
ALTER TABLE `favorite`
  ADD PRIMARY KEY (`id_fav`),
  ADD KEY `favorite_ibfk_1` (`article_id`),
  ADD KEY `user_id` (`author_id_author`);

--
-- Indeks untuk tabel `kontributor`
--
ALTER TABLE `kontributor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_kontributor_author` (`author_id`),
  ADD KEY `fk_kontributor_article` (`article_id`),
  ADD KEY `fk_kontributor_category` (`category_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `category`
--
ALTER TABLE `category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `favorite`
--
ALTER TABLE `favorite`
  MODIFY `id_fav` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `kontributor`
--
ALTER TABLE `kontributor`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `article_author`
--
ALTER TABLE `article_author`
  ADD CONSTRAINT `fk_article_author_article` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`),
  ADD CONSTRAINT `fk_article_author_author` FOREIGN KEY (`author_id`) REFERENCES `author` (`author_id`);

--
-- Ketidakleluasaan untuk tabel `article_category`
--
ALTER TABLE `article_category`
  ADD CONSTRAINT `fk_article_category_article` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`),
  ADD CONSTRAINT `fk_article_category_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

--
-- Ketidakleluasaan untuk tabel `favorite`
--
ALTER TABLE `favorite`
  ADD CONSTRAINT `favorite_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `favorite_ibfk_3` FOREIGN KEY (`author_id_author`) REFERENCES `author` (`author_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kontributor`
--
ALTER TABLE `kontributor`
  ADD CONSTRAINT `fk_kontributor_article` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`),
  ADD CONSTRAINT `fk_kontributor_author` FOREIGN KEY (`author_id`) REFERENCES `author` (`author_id`),
  ADD CONSTRAINT `fk_kontributor_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
