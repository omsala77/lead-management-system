<?php
header("Content-Type: application/json");

require "../vendor/autoload.php";
use Firebase\JWT\JWT;

include "../db.php";

$login = $_POST['login'];
$password = $_POST['password'];

$stmt = $conn->prepare("SELECT * FROM users WHERE login=?");
$stmt->bind_param("s", $login);
$stmt->execute();

$user = $stmt->get_result()->fetch_assoc();

if ($user && password_verify($password, $user['password'])) {

    $key = "SECRET_KEY_123";

    $payload = [
        "id" => $user['id'],
        "login" => $user['login'],
        "role" => $user['role'],
        "exp" => time() + 3600
    ];

    $jwt = JWT::encode($payload, $key, 'HS256');

    echo json_encode([
        "token" => $jwt,
        "user" => $user['login']
    ]);

} else {
    http_response_code(401);
    echo json_encode(["error" => "Wrong login"]);
}