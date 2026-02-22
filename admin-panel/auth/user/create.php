<?php

include "../../../Include/database.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm-password'];
    $role = $_POST['roleOption'];

    $statusVerify = true;

    for (; $statusVerify;) {
        $verifyToken = md5(rand());
        $tokenValidation = $conn->prepare("SELECT * FROM users WHERE verify_token = ?");
        $tokenValidation->bind_param("s", $verifyToken);
        $tokenValidation->execute();
        $tokenResult = $tokenValidation->get_result();
        if ($tokenResult->num_rows == 1) {
            $verifyToken = md5(rand());
        } else {
            $statusVerify = false;
        }
    };

    $emailValidation = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $emailValidation->bind_param("s", $email);
    $emailValidation->execute();
    $emailResult = $emailValidation->get_result();

    if ($password === $confirmPassword) {
        if (mysqli_num_rows($emailResult) == 1) {
            session_start();
            $_SESSION['alert'] = 'wrongEmail';
            header("Location: ../index.php");
        } else {
            $hashPassword = password_hash($password, PASSWORD_BCRYPT);

            $create = $conn->prepare("INSERT INTO users (user_id, email, username, password, phone_number, role, verify_token) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $create->bind_param("sssssss", $id, $email, $username, $hashPassword, $phoneNumber, $role, $verifyToken);
            $create->execute();

            header("Location: ../../p/create/user/index.php");
        }
    } else {
        session_start();
        $_SESSION['alert'] = 'wrongPassword';
        header("Location: ../index.php");
    }
} else {
    header("Location: ../index.php");
}
