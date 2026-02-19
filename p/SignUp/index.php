<?php

session_start();
if (isset($_SESSION['email']) && $_SESSION['role'] === 'guest') {
    header("Location: ../../index.php");
    exit();
} else if (isset($_SESSION['email']) && ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'staff')) {
    header("Location: ../../admin-panel/index.php");
    exit();
} else if (isset($_SESSION['alert']) && $_SESSION['alert'] === 'wrongPassword') {
    echo "<script>alert('Password tidak sama')</script>";
    session_destroy();
} else if (isset($_SESSION['alert']) && $_SESSION['alert'] === 'wrongEmail') {
    echo "<script>alert('email sudah dipakai')</script>";
    session_destroy();
} else if (isset($_SESSION['alert']) && $_SESSION['alert'] === 'verif') {
    echo "<script>alert('harap verifikasi email, harap check pula bagian spam')</script>";
    session_destroy();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" type="text/css" href="./style.css">
</head>

<body>
    <form action="../../auth/signUpAuth.php" method="post">
        <div class="card">
            <div class="container">
                <h1>Sign Up</h1>
                <div class="input-container">
                    <div id="username-container" class="data-container">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" class="box-input">
                    </div>

                    <div id="email-container" class="data-container">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="box-input">
                    </div>

                    <div id="password-container" class="data-container">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="box-input">
                    </div>

                    <div id="confirm-password-container" class="data-container">
                        <label for="confirm-password">Confirm Password</label>
                        <input type="password" name="confirm-password" id="confirm-password" class="box-input">
                    </div>

                    <div id="phone-number-container" class="data-container">
                        <label for="phone-number">Phone Number</label>
                        <input type="text" name="phone-number" id="phone-number" class="box-input">
                    </div>

                    <div id="button-container">
                        <input type="submit" value="Submit" class="button-submit">
                        <p>Sudah punya akun? <a href="../SignIn/">login</a></p>
                    </div>
                </div>
            </div>
        </div>
        </forma>
</body>

</html>