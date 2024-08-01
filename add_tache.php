<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    http_response_code(403);
    echo 'Non autorisé';
    exit;
}

$id_projet = $_POST['id_projet'];
$nom_tache = $_POST['name'];
$delai = $_POST['delai'];
$id_user = $_POST['user'];

$stmt = $pdo->prepare("INSERT INTO tache (nom_tache, delai, id_projet, id, create_at, statut) VALUES (:nom_tache, :delai, :id_projet, :id_user, NOW(), 'Enregistrée')");
$stmt->bindParam(':nom_tache', $nom_tache);
$stmt->bindParam(':delai', $delai);
$stmt->bindParam(':id_projet', $id_projet);
$stmt->bindParam(':id_user', $id_user);

// Ajouter une notification pour l'utilisateur assigné
$notificationStmt = $pdo->prepare("INSERT INTO notification (texte,user_id ) VALUES (?, ?)");
$notificationMessage = "Vous avez une nouvelle tâche: " . $nom_tache;
$notificationStmt->execute([$notificationMessage,$id_user]);
if ($stmt->execute()) {
    http_response_code(200);
    echo 'Tâche ajoutée avec succès';
} else {
    http_response_code(500);
    echo 'Erreur lors de l\'ajout de la tâche';
}
?>
