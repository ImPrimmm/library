<?php

include "../../../Include/database.php";

session_start();

if (!isset($_SESSION['email']) || !isset($_SESSION['username']) || !isset($_SESSION['role'])) {
    header("Location: ../../index.php");
    exit();
} else if ($_SESSION['role'] === 'guest' || $_SESSION['role'] === 'staff') {
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
                    <li><a href="../../index.php">Dashboard</a></li>
                    <li><a href="#">Log Buku</a></li>
                    <li><a href="index.php?locate=user" class="bgInfo" style="color:black;">User</a></li>
                    <li><a href="#">Buku</a></li>
                </ul>
            </nav>
        </div>
        <main class="main">
            <div class="top-navbar">
                <input type="checkbox" id="menu-check" class="cb">
                <nav id="nav-profile">
                    <img src="../../../assets/img/profile.png" alt="profile" id="profile-menu">

                    <div class="sub-menu-wrap" id="sub-menu-wrap">
                        <div class="sub-menu">
                            <div class="user-info">
                                <img src="../../../assets/img/profile.png">
                                <?php echo "<h2>$_SESSION[username]</h2>" ?>
                            </div>
                            <hr>

                            <a href="#">
                                <i class="fa-regular fa-circle-user"></i>
                                <p>Profile</p>
                            </a>

                            <a href="../../../auth/logoutAuth.php">
                                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                <p>Logout</p>
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="content-wrapper">
                <div class="content">
                    <div class="wrapper">
                        <h2>User</h2>
                        <a href="../create/user/index.php">+ Create</a>
                    </div>
                    <div class="table-wrapper">
                        <table border="1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>User Id</th>
                                    <th>Email</th>
                                    <th>Username</th>
                                    <th>password</th>
                                    <th>Phone Number</th>
                                    <th>Role</th>
                                    <th>Verify Token</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="tbody"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        const sessionId = '<?= "$_SESSION[id]" ?>'
    </script>
    <script src="./script.js"></script>
</body>

</html>

<?php
if (isset($_GET['locate']) && isset($_GET['deleteId']) && !isset($_GET['status'])) {
    $userId = $_GET['deleteId'];

    $delete = $conn->prepare("DELETE FROM users WHERE user_id = ?");
    $delete->bind_param("s", $userId);
    $delete->execute();

    header("Location: index.php?locate=user");
}
?>