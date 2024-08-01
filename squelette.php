<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MemberFlo</title>
    <link rel="stylesheet" href="style.css">
    <!--<script src="script.js" defer></script>-->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/emojione/3.1.0/assets/css/emojione.min.css" />
</head>

<body>
    <header>
        <nav>
            <h3 href="#" class="logo"><i class="ri-pass-pending-line" style="color:#007BFF"></i>MemberFlo</h3>
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="articles.php">Articles</a></li>
                <li><a href="profile.php">Profil</a></li>
                <li><a href="projet.php">Projets</a></li>
                <?php if ($_SESSION['role'] == 'chef') : ?>
                    <li><a href="history.php">Historique</a></li>
                <?php endif; ?>
                <li><a href="logout.php">Déconnexion</a></li>
            </ul>
        </nav>
    </header>