<?php
require_once '../includes/config.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM produtos WHERE id = ?");
$stmt->execute([$id]);

header("Location: read.php");
exit;
?>
