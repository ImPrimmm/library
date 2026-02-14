<?php

include '../Include/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $queryForGuest = "SELECT * FROM users WHERE email='$email' AND role='guest'";
    $resultForGuest = mysqli_query($conn, $queryForGuest);

    $queryForAdmin = "SELECT * FROM users WHERE email='$email' AND role='admin'";
    $resultForAdmin = mysqli_query($conn, $queryForAdmin);

    $queryForStaff = "SELECT * FROM users WHERE email='$email' AND role='staff'";
    $resultForStaff = mysqli_query($conn, $queryForStaff);

    function addSession($role, $email, $username)
    {
        session_start();
        $_SESSION['role'] = $role;
        $_SESSION['email'] = $email;
        $_SESSION['username'] = $username;
    }

    function verifyPassword($verify, $role, $email, $username)
    {
        if ($role == "guest" && $verify) {
            addSession($role, $email, $username);
            header("Location: ../index.php");
        } else if ($role == "admin" && $verify) {
            addSession($role, $email, $username);
            header("Location: ../admin-panel/index.php");
        } else if ($role == "staff" && $verify) {
            addSession($role, $email, $username);
            header("Location: ../admin-panel/index.php");
        }
    }

    if (mysqli_num_rows($resultForGuest) == 1) {
        $row = mysqli_fetch_assoc($resultForGuest);
        $passwordVerify = password_verify($password, $row['password']);

        verifyPassword($passwordVerify, "guest", $email, $row['username']);
    } else if (mysqli_num_rows($resultForAdmin) == 1) {
        $row = mysqli_fetch_assoc($resultForAdmin);
        $passwordVerify = password_verify($password, $row['password']);

        verifyPassword($passwordVerify, "admin", $email, $row['username']);
    } else if (mysqli_num_rows($resultForStaff) == 1) {
        $row = mysqli_fetch_assoc($resultForStaff);
        $passwordVerify = password_verify($password, $row['password']);

        verifyPassword($passwordVerify, "staff", $email, $row['username']);
    } else {
        echo "<script>Alert('Password atau Email salah')</script>";
    }
} else {
    header("Location: ../p/SignIn/index.php");
}

?>