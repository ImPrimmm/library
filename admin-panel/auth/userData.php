<?php

header("Content-Type: application/json");

include "../../Include/database.php";

$user = $conn->prepare("SELECT * FROM users");
$user->execute();
$result = $user->get_result();

while ($data = $result->fetch_assoc()) {
    $dataJson[] = $data;
}

$encodedData = json_encode($dataJson);

echo $encodedData;

?>