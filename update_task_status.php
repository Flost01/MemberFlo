<?php
session_start();
require 'config.php';

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    http_response_code(403);
    echo 'Non autorisé';
    exit;
}

// Vérifiez que les données nécessaires sont présentes
if (isset($_POST['id_tache']) && isset($_POST['statut'])) {
    $id_tache = $_POST['id_tache'];
    $nouveau_statut = $_POST['statut'];

    // Préparez la requête pour mettre à jour le statut de la tâche
    $stmt = $pdo->prepare("UPDATE tache SET statut = :statut WHERE id_tache = :id_tache");
    $stmt->bindParam(':statut', $nouveau_statut);
    $stmt->bindParam(':id_tache', $id_tache);

    // Exécutez la requête
    if ($stmt->execute()) {
        echo 'Statut mis à jour avec succès.';
    } else {
        http_response_code(500);
        echo 'Erreur lors de la mise à jour du statut.';
    }
} else {
    http_response_code(400);
    echo 'Données manquantes.';
}
?>
