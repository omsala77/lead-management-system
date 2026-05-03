<?php
include "db.php";

$id = $_GET['id'];

$stmt = $conn->prepare("DELETE FROM leads WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: leads.php");