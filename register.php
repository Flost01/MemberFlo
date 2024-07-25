<?php
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role=$_POST['role'];

    $stmt = $pdo->prepare("INSERT INTO users (name, email, password,role) VALUES (:name, :email, :password, :role)");
    $stmt->execute(['name' => $name, 'email' => $email, 'password' => $password, 'role' => $role]);

    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="register-container">
        <h1>Inscription</h1>
        <form action="register.php" method="post" id="registrationForm">
            <label for="name">Nom:</label>
            <input type="text" id="name" name="name" class="nom">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" class="email">
            <label for="password">Mot de passe:</label>
            <input type="password" id="password" name="password" class="pwd">
            <select name="role" id="role">
                <option value="chef">chef projet</option>
                <option value="member">membre</option>
            </select>
            <button type="submit">S'inscrire</button>
        </form>
        <p>Déjà un compte ? <a href="login.php">Se connecter</a></p>
    </div>
    <script src="script.js"></script>
</body>
</html>