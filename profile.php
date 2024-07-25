<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
$stmt->execute(['id' => $_SESSION['user_id']]);
$user = $stmt->fetch();
include 'squelette.php'
?>

    <main>
        <section class="profile">
            <h1>Mon profil</h1>
            <p><strong>Nom:</strong> <?php echo htmlspecialchars($user['name']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
            <button id="editProfileBtn">Modifier le profil</button>
        </section>
    </main>

    <div id="modalOverlay" style="display:none;">
    <div id="editProfileModal">
        <form id="editProfileForm">
            <label for="name">Nom:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            <button type="submit">Mettre à jour</button>
        </form>
    </div>
</div>

    <script>
        document.getElementById('editProfileBtn').onclick = function() {
            document.getElementById('modalOverlay').style.display = 'flex';
        };

        document.getElementById('editProfileForm').onsubmit = function(event) {
            event.preventDefault();
            const formData = new FormData(this);
            fetch('update_profile.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
               // alert(data.message);
                location.reload();
            });
        };
         // Fermer la modal en cliquant en dehors de celle-ci
      document.getElementById('modalOverlay').onclick = function(event) {
        if (event.target === this) {
            this.style.display = 'none';
        }
    };
    </script>
</body>
</html>