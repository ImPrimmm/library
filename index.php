<?php

include "./Include/database.php";

session_start();
if (isset($_SESSION['email']) && ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'staff')) {
    header("Location: ./admin-panel/index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phi Library</title>
    <link rel="stylesheet" type="text/css" href="./style.css">
</head>

<body>
    <header class="header">
        <nav class="navbar">
            <a href="/" class="logo">
                Logo
            </a>
            <a class="text" href="#home">
                My Books
            </a>
            <a class="text" href="/#product">
                Kategori
            </a>
        </nav>
        <form action="" method="get" class="form-search">
            <input type="search" name="search" id="search" placeholder="search....">
        </form>
        <?php
            if (!isset($_SESSION['username'])) {
                echo "<a href='./p/SignIn' class='action-button'>Get Started</a>";
            } else {
                echo "<a href='./auth/logoutAuth.php' class='logout-button'>Logout</a>";
            }
        ?>
    </header>

    <main>
        <div class="container">
            <article id="introduce">
                <section class="card">
                    <img src="./assets/img/jam.png" alt="jam" height="130px">
                    <span class="info-1">
                        <h3>Akses informasi lebih cepat</h3>
                        <p>Pengunjung bisa cari buku, cek ketersediaan, lihat detail penulis, genre, bahkan sinopsis tanpa harus datang langsung.</p>
                    </span>
                </section>
                <section class="card">
                    <img src="./assets/img/management.png" alt="management" height="130px">
                    <span class="info-2">
                        <h3>Manajemen data lebih rapi dan efisien</h3>
                        <p>Ada fitur search, filter kategori, dan sorting. Ini bikin proses mencari buku jauh lebih efisien dibanding harus mencari manual di rak.</p>
                    </span>
                </section>
                <section class="card">
                    <img src="./assets/img/location.png" alt="location" height="130px">
                    <span>
                        <h3>Bisa diakses kapan saja dan di mana saja</h3>
                        <p>Selama ada internet, pengguna bisa cek katalog atau status pinjaman 24/7. Menghadirkan layanan yang lebih fleksibel dan modern.</p>
                    </span>
                </section>
            </article>

            <section>
                <h2>Trending Books</h2>
            </section>

            <article id="trending-books" class="book-list">
                <div class="wrapper" method="post">
                    <?php
                    $image = $conn->prepare("SELECT * FROM buku ORDER BY total_borrowed DESC");
                    $image->execute();
                    $resultImage = $image->get_result();
                    $no = 0;

                    while ($row = $resultImage->fetch_assoc()) {
                        if ($no < 7) {
                            $no++;
                    ?>

                            <?php echo "<div class='book'><img src='data:image;base64," . base64_encode($row['cover']) . "' alt='Image' height='120px'><a href='./p/detail/index.php?id=$row[id_buku]'><button>Detail</button></a></div>"; ?>
                    <?php
                        }
                    }
                    ?>

                    <a href="#" class="next"><button>></button></a>
                </div>
            </article>
            <article class="book-list"></article>
            <article class="book-list"></article>
        </div>
    </main>

    <footer>&copy; 2026 www.Philib.com - All Rights Reserved.</footer>
</body>

</html>