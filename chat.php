<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$project_id = $_GET['project_id']; 
$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message = $_POST['message'];
    $timestamp = date('Y-m-d H:i:s');
    $imagePath = '';

    // Gestion de l'image
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($_FILES["image"]["name"]);
        
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            $imagePath = $targetFile; 
        }
    }

    $stmt = $pdo->prepare("INSERT INTO chat (project_id, user_id, message, timestamp, image_path) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$project_id, $user_id, $message, $timestamp, $imagePath]);

    // Retourner une réponse JSON
    echo json_encode(['success' => true, 'imagePath' => $imagePath]);
    exit;
}

// Récupérer les messages du projet
$stmt = $pdo->prepare("SELECT * FROM chat c JOIN users u ON c.user_id = u.id WHERE c.project_id = ? ORDER BY c.timestamp");
$stmt->execute([$project_id]);
$messages = $stmt->fetchAll();

$currentUserId = $_SESSION['user_id']; 


foreach ($messages as $message) {
    // Décaler l'affichage selon l'utilisateur
    $messageClass = ($message['user_id'] == $currentUserId) ? 'my-message' : 'other-message';
    
    echo '<div class="chat ' . $messageClass . '">';
    echo '<small>' . htmlspecialchars($message['name']) . '</small>';
    echo '<div>' . htmlspecialchars($message['message']) . '</div>';
    
    if ($message['image_path']) {
        echo '<img src="' . htmlspecialchars($message['image_path']) . '" alt="Image" style="max-width: 90%; height: auto;" />';
    }
    
    echo '<small><i>' . htmlspecialchars($message['timestamp']) . '</i></small><br>';
    echo '</div>';
}