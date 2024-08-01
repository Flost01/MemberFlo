<?php
// session_start();
require 'config.php';

$notificationId = $_POST['notification_id'];

$stmt = $pdo->prepare("DELETE FROM notification WHERE id_notif = :id");
$stmt->bindParam(':id', $notificationId);

$stmt->execute();


