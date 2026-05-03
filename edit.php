<?php
include "db.php";

$id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM leads WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();
$lead = $result->fetch_assoc();
?>

<form method="POST" action="update.php">
    <input type="hidden" name="id" value="<?= $lead['id'] ?>">
    <input name="name" value="<?= $lead['name'] ?>">
    <input name="email" value="<?= $lead['email'] ?>">
    <textarea name="message"><?= $lead['message'] ?></textarea>
    <button>Обновить</button>
</form>