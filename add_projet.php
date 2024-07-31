<?php
session_start();
require 'config.php';

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['message' => 'Non autorisé.']);
    exit;
}

// Traitement de l'ajout d'un projet
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom_projet = $_POST['name'];
    $description = $_POST['desc'];
    $date =  date('Y-m-d H:i:s');

    // Préparez et exécutez la requête
    $stmt = $pdo->prepare("INSERT INTO projets (nom_projet, description, create_at) VALUES (:nom_projet, :description, :date)");
    $stmt->bindParam(':nom_projet', $nom_projet);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':date', $date);
    $stmt->execute();
    header("Location: projet.php");}
?>