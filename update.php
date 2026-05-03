<?php
include "db.php";

$id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

$stmt = $conn->prepare("
    UPDATE leads 
    SET name=?, email=?, message=? 
    WHERE id=?
");

$stmt->bind_param("sssi", $name, $email, $message, $id);
$stmt->execute();

header("Location: leads.php");