<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$stmt = $pdo->query("SELECT * FROM history");
$projet = $stmt->fetchAll(PDO::FETCH_ASSOC);

include 'squelette.php';
?>
<main>
<div class="modif">
    <h1 style="margin-left:1rem;">Historique</h1>
</div>
<!-- Champ de recherche -->
<div class="search-container">
    <input type="text" id="searchInput" placeholder="Rechercher un historique..." />
</div>
<div class="tab">
    <table id="taskTable">
        <thead>
            <tr>
                <th>#</th>
                <th>Description</th>
                <th>Créé le</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
            foreach ($projet as $ta) { ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo htmlspecialchars($ta['description']); ?></td>
                    <td><?php echo htmlspecialchars($ta['create_at']); ?></td>
                </tr>
            <?php $i++;
            } ?>
        </tbody>
    </table>
</div>
</main>
<script>
     // Fonction de recherche instantanée avec AJAX
     document.getElementById('searchInput').addEventListener('input', function() {
        const searchTerm = this.value;

        // Requête AJAX
        const xhr = new XMLHttpRequest();
        xhr.open('GET', 'search_hitory.php?query=' + encodeURIComponent(searchTerm), true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                // Mettre à jour le tableau avec les résultats
                document.querySelector('#taskTable tbody').innerHTML = xhr.responseText;
            }
        };
        xhr.send();
    });
</script>