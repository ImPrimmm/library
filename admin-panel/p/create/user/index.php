<?php
session_start();

if (!isset($_SESSION['email']) || !isset($_SESSION['username']) || !isset($_SESSION['role'])) {
    header("Location: ../../../index.php");
    exit();
} else if ($_SESSION['role'] === 'guest' || $_SESSION['role'] === 'staff') {
    header("Location: ../../../user/index.php");
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
    <script src="https://kit.fontawesome.com/39f0f07a3f.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <div class="side-navbar">
            <div class="logo">
                <a href="#">Logo</a>
            </div>
            <nav>
                <ul>
                    <li><a href="../../../index.php">Dashboard</a></li>
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
                        <a href="../../user/index.php">
                            < Kembali</a>
                    </div>
                    <div class="form-wrapper">
                        <form action="../../../auth/create.php" method="post">
                            <div class="roleId-wrapper">
                                <div class="role-wrapper">
                                    <select name="roleOption" id="roleOption">
                                        <button>
                                            <selectedcontent></selectedcontent>
                                            <span class="picker"><i class="fa-solid fa-caret-down" style="color: white;"></i></span>
                                        </button>
                                        <option value="guest"><span>Guest</span></option>
                                        <option value="admin"><span>Admin</span></option>
                                        <option value="staff" class="last-option"><span>Staff</span></option>
                                    </select>
                                </div>
                                <input type="text" name="id" id="id" placeholder="Id..." readonly maxlength="10">
                            </div>
                            <div class="email-wrapper">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email">
                            </div>
                            <div class="username-wrapper">
                                <label for="username">Username</label>
                                <input type="text" name="username" id="username" maxlength="12" minlength="5">
                            </div>
                            <div class="pass-wrapper">
                                <div class="firstPass-wrapper">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" id="password" maxlength="18" minlength="8">
                                </div>
                                <div class="secondPass-wrapper" style="padding-top: 1em;">
                                    <label for="confirm-password">Confirm Password</label>
                                    <input type="password" name="confirm-password" id="confirm-password" maxlength="18" minlength="8">
                                </div>
                            </div>
                            <div class="phoneNumber-wrapper">
                                <label for="phoneNumber">Phone Number</label>
                                <input type="number" name="phoneNumber" id="phoneNumber" maxlength="20">
                            </div>
                            <div class="submit-wrapper" style="padding-top: 1em;">
                                <input type="submit" value="submit">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="./script.js"></script>
</body>

</html>