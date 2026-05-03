<?php
require "../vendor/autoload.php";

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function auth() {

    $headers = getallheaders();

    if (!isset($headers['Authorization'])) {
        http_response_code(401);
        exit(json_encode(["error" => "No token"]));
    }

    $token = str_replace("Bearer ", "", $headers['Authorization']);

    $key = "SECRET_KEY_123";

    try {
        return JWT::decode($token, new Key($key, 'HS256'));
    } catch (Exception $e) {
        http_response_code(401);
        exit(json_encode(["error" => "Invalid token"]));
    }
}