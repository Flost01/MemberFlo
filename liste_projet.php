<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
$idt=$_SESSION['user_id'];
$stmt = $pdo->query("SELECT * FROM projets JOIN tache ON projets.id_projet=tache.id_projet RIGHT JOIN users ON tache.id=users.id WHERE tache.id=$idt");
$projets = $stmt->fetchAll(PDO::FETCH_ASSOC);
include 'squelette.php'
?>

    <main>
        <div class="modif">
             <h1 style="margin-left:1rem;">Listes des projets</h1>
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
    </body>
</html>