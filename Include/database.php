<?php

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$host = $_ENV['DBHOST'];
$username = $_ENV['DBUSERNAME'];
$password = $_ENV['DBPASSWORD'];
$database = $_ENV['DB'];

$conn = mysqli_connect($host, $username, $password, $database);

?>