<?php
header("Content-Type: application/json");
include "../db.php";

$result = $conn->query("SELECT * FROM leads ORDER BY created_at DESC");

$data = [];

while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);