<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$query = $_GET['query'];

// Préparer la requête pour éviter les injections SQL
$stmt = $pdo->prepare("SELECT * FROM history WHERE description LIKE :query");
$stmt->bindValue(':query', '%' . $query . '%'); // Ajoute des jokers pour la recherche
$stmt->execute();

$taches = $stmt->fetchAll(PDO::FETCH_ASSOC);
$i = 1;

// Générer le HTML pour les résultats
foreach ($taches as $ta) {
    echo '<tr>';
    echo '<td>' . $i . '</td>';
    echo '<td>' . htmlspecialchars($ta['description']) . '</td>';
    echo '<td>' . htmlspecialchars($ta['create_at']) . '</td>';
    echo '</tr>';
    $i++;
}
?>
