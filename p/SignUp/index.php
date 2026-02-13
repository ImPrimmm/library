<?php

include '../../Include/database.php';

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

            header("Location: ../../auth/mail.php");
        }
    } else {
        header("Location: ./SignUp/index.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-size: 18px;
        }

        form {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background-color: #dddddd;
        }

        form .card {
            background-color: gray;
            height: 80%;
            width: 30%;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            gap: 20px;
            background-color: white;
            padding: 60px 0px;
            border-radius: 1em;
        }

        form .card .container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 80px;
            width: 100%;
            height: 100%;
        }

        form .card .container h1 {
            font-size: 47.122632px;
        }

        form .card .container .input-container {
            width: 80%;
            height: 100%;
            gap: 3em;
            display: flex;
            flex-direction: column;
        }

        form .card .container .input-container .data-container {
            width: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 4px;
        }

        form .card .container .input-container .data-container input {
            border-collapse: collapse;
            border: 0px solid black;
            border-bottom: 2px solid black;
            background-color: transparent;
            padding: 8px 16px 0px 0px;
            width: 100%;
        }

        form .card .container .input-container .data-container input[type="text"]:focus,
        input[type="number"]:focus {
            outline: none;
        }

        form .card .container .input-container .data-container label {
            font-size: 18px;
        }

        form .card .container .input-container #button-container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        form .card .container .input-container #button-container input {
            padding: 4px 8px;
            border-collapse: collapse;
            border: 0px solid black;
            background-color: black;
            color: white;
            border-radius: 8px;
            padding: 15px 30px;
        }
    </style>
</head>

<body>
    <form method="post">
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
                        <p>Sudah punya akun? <a href="">login</a></p>
                    </div>
                </div>
            </div>
        </div>
    </form>
</body>

</html>