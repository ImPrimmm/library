<?php

include "../../Include/database.php";

session_start();
if (isset($_SESSION['email']) && ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'staff')) {
    header("Location: ./admin-panel/index.php");
    exit();
} else if (!isset($_GET['id'])) {
    header("Location: ../../index.php");
}

$idBuku = $_GET['id'];
$buku = $conn->prepare("SELECT * FROM buku WHERE id_buku = ?");
$buku->bind_param("s", $idBuku);
$buku->execute();
$result = $buku->get_result();

$bookGenre = $conn->prepare("SELECT * FROM genre_buku WHERE id_buku = ?");
$bookGenre->bind_param("s", $idBuku);
$bookGenre->execute();
$resultBookGenre = $bookGenre->get_result();
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail</title>
    <link rel="stylesheet" type="text/css" href="./style.css">
</head>

<body>
    <header class="header">
        <nav class="navbar">
            <a href="/" class="logo">
                Logo
            </a>
            <a class="text mybooks" href="#home">
                My Books
            </a>
            <a class="text kategori" href="/#product">
                Kategori
            </a>
        </nav>
        <form action="" method="get" class="form-search">
            <input type="search" name="search" id="search" placeholder="search....">
        </form>
        <?php
        if (!isset($_SESSION['username'])) {
            echo "<a href='../SignIn' class='action-button'>Get Started</a>";
        } else {
            echo "<a href='../../auth/logoutAuth.php' class='logout-button'>Logout</a>";
        }
        ?>
    </header>

    <main>
        <div class="container">
            <div class="card">
                <section class="cover">
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <?php
                        echo "<div class='book'>";
                        echo "<img src='data:image;base64," . base64_encode($row['cover']) . "' alt='Image' height='120px'>";
                        echo "<a href='index.php?id=$row[id_buku]&status=borrow'><button>Pinjam</button></a>";
                        echo "</div>"
                        ?>
                </section>
                <section class="description">
                    <div class="title">
                        <?php echo "<h1 class='title-book'>$row[judul_buku]</h1>" ?>
                        <?php echo "<h4>Qty: $row[qty]</h4>" ?>
                    </div>
                    <div class="kategori">
                        <?php
                        $idKategori = $row['id_kategori'];
                        $kategori = $conn->prepare("SELECT * FROM kategori WHERE id_kategori = ?");
                        $kategori->bind_param("s", $idKategori);
                        $kategori->execute();
                        $resultKategori = $kategori->get_result();
                        while ($rowKategori = $resultKategori->fetch_assoc()) { ?>
                            <?php echo "<h5>kategori: $rowKategori[kategori]</h5>" ?>
                        <?php } ?>
                    </div>
                    <div class="genre">
                        <?php while ($rowBookGenre = $resultBookGenre->fetch_assoc()) { ?>
                            <?php
                            $genre = $conn->prepare("SELECT * FROM genre WHERE genre_id = ?");
                            $genre->bind_param("s", $rowBookGenre['genre_id']);
                            $genre->execute();
                            $resultGenre = $genre->get_result();
                            ?>
                            <?php while ($rowGenre = $resultGenre->fetch_assoc()) { ?>
                                <?php echo "<div class='tag-genre'>$rowGenre[genre]</div>" ?>
                            <?php } ?>
                        <?php } ?>
                    </div>
                    <div class="desc">
                        <?php echo "<p>$row[description]</p>" ?>
                    </div>
                    <div class="card-description">
                        <div class="year info-card">
                            <div class="wrapper">
                                <h4>Tahun Terbit</h4>
                                <?php echo "<p>$row[tahun_terbit]</p>" ?>
                            </div>
                        </div>
                        <div class="penulis info-card">
                            <div class="wrapper">
                                <h4>Penulis</h4>
                                <?php
                                $idPenulis = $row['id_penulis'];
                                $penulis = $conn->prepare("SELECT * FROM penulis WHERE id_penulis = ?");
                                $penulis->bind_param("s", $idPenulis);
                                $penulis->execute();
                                $resultPenulis = $penulis->get_result();
                                while ($rowPenulis = $resultPenulis->fetch_assoc()) { ?>
                                    <?php echo "<p>$rowPenulis[penulis]</p>" ?>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="pages info-card">
                            <div class="wrapper">
                                <h4>Pages</h4>
                                <?php echo "<p>$row[pages]</p>" ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                </section>
            </div>
        </div>
    </main>

    <footer>&copy; 2026 www.Philib.com - All Rights Reserved.</footer>
</body>

</html>