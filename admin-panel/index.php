<?php
session_start();

if (!isset($_SESSION['email']) || !isset($_SESSION['username']) || !isset($_SESSION['role'])) {
    header("Location: ../p/SignIn/");
    exit();
} else if ($_SESSION['role'] === 'guest') {
    header("Location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" type="text/css" href="./style.css">
</head>

<body>
    <div class="container">
        <div class="side-navbar">
            <div class="logo">
                <a href="#">Logo</a>
            </div>
            <nav>
                <ul>
                    <li><a href="#" class="<?= "bgInfo" ?>" style="<?= "color:black;" ?>">Dashboard</a></li>
                    <li><a href="#">Log Buku</a></li>
                    <?php if($_SESSION['role'] == "admin") {?>
                        <?php  echo '<li><a href="./p/user/index.php?locate=user">User</a></li>' ?>
                    <?php } ?>
                    <li><a href="#">Buku</a></li>
                </ul>
            </nav>
        </div>
        <main class="main">
            <div class="top-navbar">
                <input type="checkbox" id="menu-check" class="cb">
                <nav id="nav-profile">
                    <img src="../assets/img/profile.png" alt="profile" id="profile-menu">

                    <div class="sub-menu-wrap" id="sub-menu-wrap">
                        <div class="sub-menu">
                            <div class="user-info">
                                <img src="../assets/img/profile.png">
                                <?php echo "<h2>$_SESSION[username]</h2>" ?>
                            </div>
                            <hr>

                            <a href="#">
                                <i class="fa-regular fa-circle-user"></i>
                                <p>Profile</p>
                            </a>

                            <a href="../auth/logoutAuth.php">
                                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                <p>Logout</p>
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
        </main>
    </div>

    <script src="./script.js"></script>
</body>

</html>