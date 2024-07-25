<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirige vers la page de connexion
    exit; 
}

include 'squelette.php'
?>

    <main>
        <section class="hero">
            <h1>Bienvenue sur mon site</h1>
            <p>Découvrez nos derniers articles passionnants.</p>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 MemberFlo. Tous droits réservés.</p>
    </footer>
</body>
</html>