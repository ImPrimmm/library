<?php

session_start();
if (isset($_SESSION['email']) && $_SESSION['role'] === 'guest') {
    header("Location: ../../index.php");
    exit();
} else if (isset($_SESSION['email']) && ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'staff')) {
    header("Location: ../../admin-panel/index.php");
    exit();
} else if (isset($_SESSION['alert']) && $_SESSION['alert'] === 'wrongPassword') {
    echo "<script>alert('Password atau Email salah')</script>";
    session_destroy();
} else if (isset($_SESSION['alert']) && $_SESSION['alert'] === 'wrongEmail') {
    echo "<script>alert('Akun belum terdaftar')</script>";
    session_destroy();
} else if (isset($_SESSION['alert']) && $_SESSION['alert'] === 'wrongVerification') {
    echo "<script>alert('Akun belum diverifikasi, mohon untuk memverifikasi lewat email anda, harap check pula bagian spam')</script>";
    session_destroy();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link rel="stylesheet" type="text/css" href="./style.css">
</head>

<body>
    <form action="../../auth/signInAuth.php" method="post">
        <div class="card">
            <div class="container">
                <h1>Login</h1>
                <div class="input-container">
                    <div id="email-container" class="data-container">
                        <label for="email">email <span style="color: red;">*</span></label>
                        <input type="text" name="email" id="email" class="box-input" maxlength="200">
                    </div>

                    <div id="password-container" class="data-container">
                        <label for="password">Password <span style="color: red;">*</span></label>
                        <input type="password" name="password" id="password" class="box-input" maxlength="18">
                        <div id="check-password"></div>
                    </div>

                    <div id="button-container">
                        <input type="submit" value="Submit" class="button-submit">
                        <p>Belum punya akun? <a href="../SignUp/">register</a></p>
                    </div>
                </div>
            </div>
        </div>
    </form>
</body>

</html>