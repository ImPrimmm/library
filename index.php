<?php

session_start();
if (isset($_SESSION['email']) && ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'staff')){
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
    <header>
        <nav class="navbar">
            <ul class="links">
                <li><a href="#" class="logo">Logo</a></li>
                <li><a href="#">My Books</a></li>
                <li><a href="#">Kategori</a></li>
            </ul>
            <form method="get" class="form-search">
                <input type="text" id="search-bar" placeholder="Search.....">
            </form>
            <?php
                if (!isset($_SESSION['username'])) {
                    echo "<a href='' class='action-button'>Get Started</a>";
                } else {
                    echo "<a href='' class='action-button'>Profile</a>";
                }
            ?>
        </nav>
    </header>

    <main>
        <div class="container">
            <article id="introduce">
                <section class="card">
                    <img src="./assets/img/jam.png" alt="jam" height="130px">
                    <span>
                        <h3>Akses informasi lebih cepat</h3>
                        <p>Pengunjung bisa cari buku, cek ketersediaan, lihat detail penulis, genre, bahkan sinopsis tanpa harus datang langsung. Hemat waktu banget.</p>
                    </span>
                </section>
                <section class="card">
                    <img src="./assets/img/management.png" alt="management" height="130px">
                    <span>
                        <h3>Manajemen data lebih rapi dan efisien</h3>
                        <p>Data buku, anggota, peminjaman, dan pengembalian tercatat otomatis di sistem. Jadi kecil kemungkinan data hilang atau salah catat dibanding manual.</p>
                    </span>
                </section>
                <section class="card">
                    <img src="./assets/img/location.png" alt="location" height="130px">
                    <span>
                        <h3>Bisa diakses kapan saja dan di mana saja</h3>
                        <p>Selama ada internet, pengguna bisa cek katalog atau status pinjaman 24/7. Ini bikin layanan perpustakaan jadi lebih fleksibel dan modern.</p>
                    </span>
                </section>
            </article>

            <article id="trending-books" class="book-list"></article>
            <article class="book-list"></article>
            <article class="book-list"></article>
        </div>
    </main>

    <footer>Footer</footer>
</body>

</html>