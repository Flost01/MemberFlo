<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MemberFlo</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
    <link
    href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css"
    rel="stylesheet"
/>
</head>
<body>
    <header>
        <nav>
            <h3 href="#" class="logo">MemberFlo</h3>
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="articles.php">Articles</a></li>
                <li><a href="profile.php">Profil</a></li>
                <?php if ($_SESSION['role']=='chef'): ?>
                    <li><a href="projet.php">Projets</a></li>
                <?php else: ?>
                    <li><a href="liste_projet.php">Listes projets</a></li>
                <?php endif; ?>
                <li><a href="logout.php">Déconnexion</a></li>
            </ul>
        </nav>
    </header>