<?php
$conn = new mysqli("localhost", "root", "", "test_project");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}