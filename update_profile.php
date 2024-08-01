<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['message' => 'Utilisateur non connecté']);
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $date =  date('Y-m-d H:i:s');
    $text= 'L utilisateur '.$name.' a modifie son profil';

    $stmt = $pdo->prepare("UPDATE users SET name = :name, email = :email WHERE id = :id");
    $stmt->execute(['name' => $name, 'email' => $email, 'id' => $_SESSION['user_id']]);

    $req= $pdo->prepare("INSERT INTO `history`(`description`, `create_at`) VALUES (?,?)");
    $req->execute(array($text,$date));

    echo json_encode(['message' => 'Profil mis à jour avec succès']);
}