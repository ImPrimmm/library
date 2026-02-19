<?php

include "../../Include/database.php";

session_start();
if (isset($_SESSION['email']) && ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'staff')) {
    header("Location: ./admin-panel/index.php");
    exit();
} else if (!isset($_GET['id'])) {
    header("Location: ../../index.php");
}

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
            echo "<a href='./p/SignIn' class='action-button'>Get Started</a>";
        } else {
            echo "<a href='./auth/logoutAuth.php' class='logout-button'>Logout</a>";
        }
        ?>
    </header>

    <main>
        <div class="container">
            <div class="card">
                <section class="cover">
                    <?php
                    $idBuku = $_GET['id'];
                    $buku = $conn->prepare("SELECT * FROM buku WHERE id_buku = ?");
                    $buku->bind_param("s", $idBuku);
                    $buku->execute();
                    $result = $buku->get_result();
                    while ($row = $result->fetch_assoc()) { ?>
                        <?php echo "<div class='book'><img src='data:image;base64," . base64_encode($row['cover']) . "' alt='Image' height='120px'><a href='./p/detail/index.php?id=$row[id_buku]'><button>Pinjam</button></a></div>"; ?>
                </section>
                <section class="description">
                    <div class="title">
                        <?php echo "<h2>$row[judul_buku]</h2>" ?>
                        <?php echo "<p>Qty: $row[qty]</p>" ?>
                    </div>
                    <div class="desc">
                        <?php echo "<p>$row[description]</p>" ?>
                    </div>
                    <div class="card-description">
                        <div class="year"></div>
                        <div class="penerbit"></div>
                        <div class="pages">
                            <!-- <?php echo "<p>$row[pages]</p>" ?> -->
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