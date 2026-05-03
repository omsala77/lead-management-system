<?php
include "db.php";

$login = "admin";
$password = password_hash("1234", PASSWORD_DEFAULT);

$sql = "INSERT INTO users (login, password) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $login, $password);

$stmt->execute();

echo "User created";