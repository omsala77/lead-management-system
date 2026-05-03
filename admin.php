<?php
session_start();

if ($_POST['login'] == "admin" && $_POST['password'] == "1234") {
    $_SESSION['auth'] = true;
    header("Location: leads.php");
} else {
    echo "Неверный логин";
}