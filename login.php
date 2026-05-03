<?php
session_start();
include "db.php";

$login = $_POST['login'];
$password = $_POST['password'];

$stmt = $conn->prepare("SELECT * FROM users WHERE login=?");
$stmt->bind_param("s", $login);
$stmt->execute();

$user = $stmt->get_result()->fetch_assoc();

if ($user && password_verify($password, $user['password'])) {

    $_SESSION['auth'] = true;
    $_SESSION['role'] = $user['role'];

    header("Location: leads.php");

} else {
    echo "Login failed";
}