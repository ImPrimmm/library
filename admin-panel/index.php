<?php

include "../Include/database.php";

session_start();
if (!isset($_SESSION['email']) || !isset($_SESSION['username']) || !isset($_SESSION['role'])) {
    header("Location: ../index.php");
    exit();
} else if ($_SESSION['role'] === 'guest') {
    header("Location: ../index.php");
    exit();
}

if (isset($_SESSION['alert']) && $_SESSION['alert'] === 'wrongPassword') {
    echo "<script>alert('Password tidak sama')</script>";
    $_SESSION['alert'] = '';
} else if (isset($_SESSION['alert']) && $_SESSION['alert'] === 'wrongEmail') {
    echo "<script>alert('email sudah dipakai')</script>";
    $_SESSION['alert'] = '';
} else if (isset($_SESSION['alert']) && $_SESSION['alert'] === 'verif') {
    echo "<script>alert('harap verifikasi email, harap check pula bagian spam')</script>";
    $_SESSION['alert'] = '';
}

$role = "admin";

if ($_SESSION['role'] === 'staff') {
    $role = "staff";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        .update,
        .delete {
            height: 24px;
            width: 24px;
        }
    </style>
</head>

<body>
    <h1>Welcome <?= $role; ?></h1>
    <form action="./auth/create.php" method="post">
        <label for="id">id</label>
        <input type="text" name="id" id="id" readonly>

        <label for="email">email</label>
        <input type="email" name="email" id="email">

        <label for="username">username</label>
        <input type="text" name="username" id="username">

        <label for="password">password</label>
        <input type="password" name="password" id="password">

        <label for="confirm-password">confirm-password</label>
        <input type="password" name="confirm-password" id="confirm-password">

        <label for="role">role</label>
        <select name="roleOption" id="roleOption">
            <option value=""></option>
            <option value="guest">guest</option>
            <option value="admin">admin</option>
            <option value="staff">staff</option>
        </select>

        <button type="submit">Create</button>
        <a href="../auth/logoutAuth.php">Logout</a>
    </form>

    <table border="1">
        <tr>
            <th>no</th>
            <th>id</th>
            <th>email</th>
            <th>username</th>
            <th>password</th>
            <th>phone number</th>
            <th>role</th>
            <th>verif-token</th>
            <th>action</th>
        </tr>
        <?php

        $no = 0;
        $data = $conn->prepare("SELECT * FROM users");
        $data->execute();
        $result = $data->get_result();
        while ($show = $result->fetch_assoc()) {
            if ($show['user_id'] !== $_SESSION['id']) {
                $tag = "<td>
                <a href='update.php?kode=$show[user_id]'><img class='update' src='../assets/img/edit.png'></a>
                <a href='?userId=$show[user_id]'><img class='delete' src='../assets/img/trash.png'></a>
              </td>";
            } else {
                $tag = "<td></td>";
            }
            $no++;
            echo "
            <tr>
              <td id='no$no'>$no</td>
              <td id='userId$no' class='userId'>$show[user_id]</td>
              <td id='email$no'>$show[email]</td>
              <td id='username$no'>$show[username]</td>
              <td id='password$no'>$show[password]</td>
              <td id='phoneNumber$no'>$show[phone_number]</td>
              <td id='role$no'>$show[role]</td>
              <td id='verifyToken$no'>$show[verify_token]</td>
              $tag
            </tr>
          ";
        }
        ?>
    </table>

    <script>
        const roleOption = document.getElementById('roleOption');
        const id = document.getElementById('id');
        const userId = Array.from(document.querySelectorAll(".userId"));

        window.addEventListener("DOMContentLoaded", () => {
            roleOption.addEventListener("change", () => {
                if (roleOption.value !== "") {
                    sortData(generateId(), roleOption.value);
                } else {
                    id.value = "";
                }
            })
        });

        function generateId() {
            return Math.floor(Math.random() * 90000) + 10000;
        }

        function sortData(number, role) {
            for (let i = 0; i < userId.length; i++) {
                if (role + String(number) == userId[0].innerText) {
                    generateId();
                    i = 0;
                } else {
                    id.value = role + String(number);
                }
            }
        }
    </script>

    <?php


    if (isset($_GET['userId'])) {
        if ($_GET['userId'] === $_SESSION['id']) {
            echo "<script>alert('Anda tidak bisa menghapus akun yang sedang anda gunakan')</script>";
        } else {
            $userId = $_GET['userId'];

            $delete = $conn->prepare("DELETE FROM users WHERE user_id = ?");
            $delete->bind_param("s", $userId);
            $delete->execute();

            header("Location: index.php");
        }
    }
    ?>
</body>

</html>