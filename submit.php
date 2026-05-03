<?php
include "db.php";

$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

$stmt = $conn->prepare("INSERT INTO leads (name, email, message) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $name, $email, $message);

if ($stmt->execute()) {
    echo "Заявка отправлена!";
    echo "<br><a href='index.php'>Назад</a>";
} else {
    echo "Ошибка: " . $conn->error;
}

$stmt->close();
$conn->close();