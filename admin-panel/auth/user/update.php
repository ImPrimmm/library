<?php

include "../../../Include/database.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm-password'];
    $role = $_POST['roleOption'];

    $emailValidation = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $emailValidation->bind_param("s", $email);
    $emailValidation->execute();
    $emailResult = $emailValidation->get_result();

    if ($password === $confirmPassword) {
        if (mysqli_num_rows($emailResult) == 1) {
            session_start();
            $_SESSION['alert'] = 'wrongEmail';
            header("Location: ../../p/update/user/index.php?updateId=$id");
        } else {
            $hashPassword = password_hash($password, PASSWORD_BCRYPT);

            $create = $conn->prepare("UPDATE users SET user_id = ?, email = ?, username = ?, password = ?, phone_number = ?, role = ? WHERE user_id = ?");
            $create->bind_param("sssssss", $id, $email, $username, $hashPassword, $phoneNumber, $role, $id);
            $create->execute();

            header("Location: ../../p/update/user/index.php?updateId=$id");
        }
    } else {
        session_start();
        $_SESSION['alert'] = 'wrongPassword';
        header("Location: ../../p/update/user/index.php?updateId=$id");
    }
} else {
    header("Location: ../../p/update/user/index.php?updateId=$id");
}
