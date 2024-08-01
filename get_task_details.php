<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    http_response_code(403);
    echo json_encode(['error' => 'Non autorisé']);
    exit;
}

if (isset($_GET['id_tache'])) {
    $id_tache = $_GET['id_tache'];

    $stmt = $pdo->prepare("
        SELECT *
        FROM tache
        JOIN users ON tache.id = users.id
        WHERE tache.id_tache = :id_tache
    ");
    $stmt->bindParam(':id_tache', $id_tache);
    $stmt->execute();

    $task = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($task) {
        http_response_code(200);
        echo json_encode($task);
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'Tâche non trouvée']);
    }
} else {
    http_response_code(400);
    echo json_encode(['error' => 'ID de tâche manquant']);
}
?>