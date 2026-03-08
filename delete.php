<?php
// Inclure le fichier de connexion
require 'db.php';

// Vérifier si un ID a été passé en paramètre
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Préparer et exécuter la requête de suppression
    $stmt = $pdo->prepare("DELETE FROM students WHERE id = :id");
    $stmt->execute([':id' => $id]);
}

// Rediriger vers la page d'accueil une fois la suppression terminée
header("Location: index.php");
exit;
?>
