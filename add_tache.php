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
    $nom_tache = $_POST['name'];
    $delai = $_POST['delai'];
    $user = $_POST['user'];
    $date =  date('Y-m-d H:i:s');
    $proj = $_GET['id_projet'];

    // Préparez et exécutez la requête
    $stmt = $pdo->prepare("INSERT INTO tache (nom_tache,create_at,delai,id,id_projet) VALUES (:nom_tache,:date,:delai,:user,:proj)");
    $stmt->bindParam(':nom_tache', $nom_tache);
    $stmt->bindParam(':date', $date);
    $stmt->bindParam(':delai', $delai);
    $stmt->bindParam(':user', $user);
    $stmt->bindParam(':proj', $proj);
    $stmt->execute();
    header("Location: tache.php?id_projet=$proj");}
?>