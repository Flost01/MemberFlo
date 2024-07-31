<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
$ide = $_GET['id_projet'];
$tache = $pdo->query("SELECT * FROM users JOIN tache ON tache.id=users.id JOIN projets ON tache.id_projet=projets.id_projet WHERE tache.id_projet=$ide");
$taches = $tache->fetchAll(PDO::FETCH_ASSOC);

// Générer le HTML pour les résultats en fonction des statuts
$toDoTasks = '';
$inProgressTasks = '';
$completedTasks = '';
$i=1;
foreach ($taches as $ta) {
    echo '<tr>';
    echo '<td>' . $i . '</td>';
    echo '<td>' . htmlspecialchars($ta['nom_tache']) . '</td>';
    echo '<td>' . htmlspecialchars($ta['create_at']) . '</td>';
    echo '<td>' . htmlspecialchars($ta['delai']) . '</td>';
    echo '<td>' . htmlspecialchars($ta['name']) . '</td>';
    echo '<td>' . htmlspecialchars($ta['statut']);
    if ($_SESSION['role'] == 'chef' || $_SESSION['user_id'] == $ta['id']) {
        if ($ta['statut'] == 'Enregistrée') {
            echo '<a href="modifier.php?id_tache=' . htmlspecialchars($ta['id_tache']) . '&id_projet=' . htmlspecialchars($ta['id_projet']) . '"><i class="ri-arrow-right-circle-line"></i></a>';
        } else if ($ta['statut'] == 'En cours') {
            echo '<a href="terminer.php?id_tache=' . htmlspecialchars($ta['id_tache']) . '&id_projet=' . htmlspecialchars($ta['id_projet']) . '"><i class="ri-thumb-up-line"></i></a>';
        }
    }
    echo '</td></tr>';
    $i++;
}
?>