<?php
include "../Include/database.php";

$token = $_GET['token'];
$email = $_GET['email'];


$update = $conn->prepare("UPDATE users SET verify_token = ? WHERE email = ?");
$update->bind_param("ss", $token, $email);
$update->execute();
header("Location: ../p/SignIn/index.php");

?>