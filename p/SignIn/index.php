<?php

session_start();
if (isset($_SESSION['email']) && $_SESSION['role'] === 'guest') {
    header("Location: ../../index.php");
    exit();
} else if (isset($_SESSION['email']) && ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'staff')){
    header("Location: ../../admin-panel/index.php");
    exit();
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
    <form action="../../auth/signInAuth.php" method="post">
        <div class="card">
            <div class="container">
                <h1>Login</h1>
                <div class="input-container">
                    <div id="email-container" class="data-container">
                        <label for="email">E-mail</label>
                        <input type="text" name="email" id="email" class="box-input" maxlength="200">
                    </div>

                    <div id="password-container" class="data-container">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="box-input" maxlength="18">
                        <div id="check-password"></div>
                    </div>

                    <div id="button-container">
                        <input type="submit" value="Submit" class="button-submit">
                        <p>Belum punya akun? <a href="./mail.php">register</a></p>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script src="./script.js"></script>
</body>

</html>