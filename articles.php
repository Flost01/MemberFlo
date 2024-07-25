<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Articles</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <nav>
            <h3><a href="index.php" class="logo">MemberFlo</a></h3>
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="articles.php">Articles</a></li>
                <li><a href="logout.php">Déconnexion</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h1 style="margin-left:1rem;">Articles</h1>
        <div id="articlesContainer" class="art"></div>
    </main>

    <script>
        fetch('https://jsonplaceholder.typicode.com/posts') // Remplacez par l'URL de votre API
            .then(response => response.json())
            .then(data => {
                const articlesContainer = document.getElementById('articlesContainer');
                data.forEach(article => {
                    const articleDiv = document.createElement('div');
                    articleDiv.innerHTML = `<h2>${article.title}</h2><p>${article.body}</p>`;
                    articlesContainer.appendChild(articleDiv);
                });
            });
    </script>
</body>
</html>