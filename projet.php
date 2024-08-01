<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SESSION['role']=='chef'):
    $stmt = $pdo->query("SELECT * FROM projets");
    $projets = $stmt->fetchAll(PDO::FETCH_ASSOC);
else:
    $idt=$_SESSION['user_id'];
    $stmt = $pdo->query("SELECT projets.id_projet, projets.nom_projet, projets.description 
        FROM projets 
        JOIN tache ON projets.id_projet = tache.id_projet 
        JOIN users ON tache.id = users.id 
        WHERE users.id = $idt 
        GROUP BY projets.id_projet");
    $projets = $stmt->fetchAll(PDO::FETCH_ASSOC);
endif;
include 'squelette.php'
?>
    <main>
        <div class="modif">
             <h1 style="margin-left:1rem;">Listes des projets</h1>
             <?php if ($_SESSION['role'] == 'chef') : ?>
             <button id="addProjet">Ajouter<i class="ri-add-circle-line"></i></button>
             <?php endif; ?>
        </div>
       
        <div id="afficherProjet" class="art">
           <?php foreach($projets as $projet) { ?>
                <a class="art-item" style="cursor: pointer; text-decoration:none; color:black" href="tache.php?id_projet=<?php echo htmlspecialchars($projet['id_projet']); ?>">
                    <h2><?php echo htmlspecialchars($projet['nom_projet']); ?></h2>
                    <p><?php echo htmlspecialchars($projet['description']); ?></p>
                </a>
            <?php } ?>
        </div>
    </main>
    <div id="modalOverlay" style="display:none;">
    <div id="addModalProjet" class="mod">
        <form id="addProjetForm" method="post" action="add_projet.php">
            <label for="name">Nom Projet:</label>
            <input type="text" id="name" name="name" required>
            <label for="desc">Description:</label>
            <input type="text" id="desc" name="desc" required>
            <button type="submit" value="pro">Ajouter</button>
        </form>
    </div>
    </div>

    <script>
        document.getElementById('addProjet').onclick = function() {
            document.getElementById('modalOverlay').style.display = 'flex';
        };
      document.getElementById('modalOverlay').onclick = function(event) {
        if (event.target === this) {
            this.style.display = 'none';
        }}
    </script>
</body>
</html>