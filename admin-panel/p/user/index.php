<?php
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
            <div class="top-navbar"></div>
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

    <script src="./script.js"></script>
</body>

</html>

<?php
if (isset($_GET['deleteId'])) {
    if ($_GET['deleteId'] === $_SESSION['id']) {
        echo "
        <script>
            alert('Anda tidak bisa menghapus akun yang sedang anda gunakan');
            window.location.href = 'index.php?locate=user';
        </script>
        ";
    } else {
        $userId = $_GET['deleteId'];

        $delete = $conn->prepare("DELETE FROM users WHERE user_id = ?");
        $delete->bind_param("s", $userId);
        $delete->execute();

        header("Location: index.php?locate=user");
    }
} else if (isset($_GET['status']) && $_GET['status'] == 'pending') {
    $userId = $_SESSION['id'];
    echo "
    <script>
        if (confirm('Yakin ingin menghapus akun?')) {
            window.location.href = 'index.php?locate=user&deleteId=$userId';
        } else {
            window.location.href = 'index.php?locate=user';
        }
    </script>";
}
?>