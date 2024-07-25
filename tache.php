<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
$ide = $_GET['id_projet'];
$stmt = $pdo->query("SELECT * FROM projets WHERE id_projet=$ide");
$projet = $stmt->fetch(PDO::FETCH_ASSOC);

$use = $pdo->query('SELECT * FROM users');
$uses = $use->fetchAll(PDO::FETCH_ASSOC);

$tache = $pdo->query("SELECT * FROM users JOIN tache ON tache.id=users.id JOIN projets ON tache.id_projet=projets.id_projet WHERE tache.id_projet=$ide");
$taches = $tache->fetchAll(PDO::FETCH_ASSOC);
include 'squelette.php';
?>

<div class="modif">
    <h1 style="margin-left:1rem;"><?php echo htmlspecialchars($projet['nom_projet']); ?></h1>
    <?php if ($_SESSION['role'] == 'chef') : ?>
        <button id="addProjet">Ajouter<i class="ri-add-circle-line"></i></button>
    <?php endif; ?>
</div>

<!-- Champ de recherche -->
<div class="search-container">
    <input type="text" id="searchInput" placeholder="Rechercher une tâche..." />
</div>

<div class="tab">
    <table id="taskTable">
        <thead>
            <tr>
                <th>#</th>
                <th>Nom Tâche</th>
                <th>Créé le</th>
                <th>Délai</th>
                <th>Utilisateur</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
            foreach ($taches as $ta) { ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo htmlspecialchars($ta['nom_tache']); ?></td>
                    <td><?php echo htmlspecialchars($ta['create_at']); ?></td>
                    <td><?php echo htmlspecialchars($ta['delai']); ?></td>
                    <td><?php echo htmlspecialchars($ta['name']); ?></td>
                    <td><?php echo htmlspecialchars($ta['statut']);
                        if ($_SESSION['role'] == 'chef' || $_SESSION['user_id'] == $ta['id']) {
                            if ($ta['statut'] == 'Enregistrée') { ?>
                                <a href="modifier.php?id_tache=<?php echo htmlspecialchars($ta['id_tache']); ?>&id_projet=<?php echo htmlspecialchars($ta['id_projet']); ?>"><i class="ri-arrow-right-circle-line"></i></a>
                            <?php } else if ($ta['statut'] == 'En cours') { ?>
                                <a href="terminer.php?id_tache=<?php echo htmlspecialchars($ta['id_tache']); ?>&id_projet=<?php echo htmlspecialchars($ta['id_projet']); ?>"><i class="ri-thumb-up-line"></i></a>
                        <?php }
                        } ?>
                    </td>
                </tr>
            <?php $i++;
            } ?>
        </tbody>
    </table>
</div>

<div id="modalOverlay" style="display:none;">
    <div id="addModalProjet" class="mod">
        <form id="addProjetForm" method="post" action="add_tache.php?id_projet=<?php echo $ide ?>">
            <label for="name">Nom Tâche:</label>
            <input type="text" id="name" name="name" required>
            <label for="desc">Délai d'exécution:</label>
            <input type="date" id="delai" name="delai" required>
            <label for="user">Choisir un membre:</label>
            <select name="user" id="user">
                <?php foreach ($uses as $use) { ?>
                    <option value="<?php echo htmlspecialchars($use['id']); ?>"><?php echo htmlspecialchars($use['name']); ?></option>
                <?php } ?>
            </select>
            <button type="submit" value="pro">Ajouter</button>
        </form>
    </div>
</div>

<script>
    // Affichage de la modal
    document.getElementById('addProjet').onclick = function() {
        document.getElementById('modalOverlay').style.display = 'flex';
    };

    // Fermeture de la modal
    document.getElementById('modalOverlay').onclick = function(event) {
        if (event.target === this) {
            this.style.display = 'none';
        }
    };

    // Fonction de recherche instantanée avec AJAX
    document.getElementById('searchInput').addEventListener('input', function() {
        const searchTerm = this.value;

        // Requête AJAX
        const xhr = new XMLHttpRequest();
        xhr.open('GET', 'search_tasks.php?query=' + encodeURIComponent(searchTerm) + '&id_projet=<?php echo $ide; ?>', true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                // Mettre à jour le tableau avec les résultats
                document.querySelector('#taskTable tbody').innerHTML = xhr.responseText;
            }
        };
        xhr.send();
    });
</script>