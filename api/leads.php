<?php
header("Content-Type: application/json");

include "../db.php";
include "middleware.php";

$user = auth();

$stmt = $conn->prepare("
    SELECT * FROM leads WHERE user_id = ?
");

$stmt->bind_param("i", $user->id);
$stmt->execute();

$result = $stmt->get_result();

$data = [];

while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);