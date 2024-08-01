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
    <div class="search-container" style="display:flex">
        <input type="text" id="searchInput" placeholder="Rechercher un historique..." />
        <button id="excel" style="background-color:#007BFF;color:aliceblue; padding:5px; border:none; cursor:pointer">Exporter<i class="ri-download-2-fill"></i></button>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.5/xlsx.full.min.js"></script>
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
    // Récupérer les données du tableau
    const tableData = [];
    const tableRows = document.querySelectorAll('#taskTable tbody tr');

    tableRows.forEach(row => {
        const cells = row.querySelectorAll('td');
        const rowData = {
            id: cells[0].textContent,
            description: cells[1].textContent,
            create_at: cells[2].textContent
        };
        tableData.push(rowData);
    });

    // Créer le fichier Excel
    function exportToExcel() {
        // Créer un nouveau classeur
        const workbook = XLSX.utils.book_new();

        // Créer une feuille de calcul
        const worksheet = XLSX.utils.json_to_sheet(tableData);
        XLSX.utils.book_append_sheet(workbook, worksheet, 'Historique');

        // Générer le fichier Excel
        XLSX.writeFile(workbook, 'historique.xlsx');
    }

    const excel = document.getElementById('excel');
    excel.addEventListener('click', exportToExcel);
</script>