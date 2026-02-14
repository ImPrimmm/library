<?php

include '../Include/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm-password'];
    $phoneNumber = $_POST['phone-number'];

    $emailValidation = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");

    $generateId = (string) "guest" . rand(10000, 99999);
    $validationId = mysqli_query($conn, "SELECT * FROM users WHERE user_id = '$generateId'");

    $status = true;

    for (; $status;) {
        if (mysqli_num_rows($validationId) == 1) {
            $generateId = (string) "guest" . rand(10000, 99999);
        } else {
            $status = false;
        }
    };

    if ($password == $confirmPassword) {
        if (mysqli_num_rows($emailValidation) == 1) {
            echo "<script>alert('email sudah dipakai')</script>";
        } else {
            $hashPassword = password_hash($password, PASSWORD_BCRYPT);

            $create = mysqli_query($conn, "INSERT INTO users (user_id, email, username, password, phone_number, role, verification) VALUES ('$generateId', '$email', '$username', '$hashPassword', '$phoneNumber', 'guest', 'unverified')");
        }
    } else {
        header("Location: ../p/SignUp/index.php");
    }
} else {
    header("Location: ../p/SignUp/index.php");
}

?>