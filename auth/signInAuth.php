<?php

session_start();

include '../Include/database.php';
require './verifyEmail.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $query->bind_param("s", $email);
    $query->execute();
    $result = $query->get_result();

    function addSession($role, $email, $username, $id)
    {
        if ($role === "admin" || $role === "staff") {
            $_SESSION['role'] = $role;
            $_SESSION['email'] = $email;
            $_SESSION['username'] = $username;
            $_SESSION['id'] = $id;
        } else {
            $_SESSION['role'] = $role;
            $_SESSION['email'] = $email;
            $_SESSION['username'] = $username;
        }
    }

    function verifyingPassword($pass, $data, $email, $conn)
    {
        $verifyPassword = password_verify($pass, $data['password']);

        if ($verifyPassword) {
            if ($data['verify_token'] == NULL) {
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
            } else {
                if ($data['role'] == 'guest') {
                    addSession("guest", $email, $data['username'], $data['user_id']);
                    header("Location: ../index.php");
                    exit;
                } else if ($data['role'] == 'admin') {
                    addSession("admin", $email, $data['username'], $data['user_id']);
                    header("Location: ../admin-panel/index.php");
                    exit;
                } else if ($data['role'] == 'staff') {
                    addSession("staff", $email, $data['username'], $data['user_id']);
                    header("Location: ../admin-panel/index.php");
                    exit;
                }
            }
        } else {
            $_SESSION['alert'] = 'wrongPassword';
            header("Location: ../p/SignIn");
            exit;
        }
    }

    if (mysqli_num_rows($result) == 1) {
        $row = $result->fetch_assoc();

        verifyingPassword($password, $row, $email, $conn);
    } else {
        $_SESSION['alert'] = 'wrongEmail';
        header("Location: ../p/SignIn");
        exit;
    }
} else {
    header("Location: ../p/SignIn/index.php");
    exit;
}
