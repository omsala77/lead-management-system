<?php

$host = "localhost";
$user = "root";
$password = "";
$db = "test_project";

$conn = new mysqli($host, $user, $password, $db);

if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}