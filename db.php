<?php
// Paramètres de connexion à la base de données
$host = 'localhost';
$dbname = 'gestion_etudiants';
$username = 'brother_kev';
$password = 'kevinmulemberi2547';

try {
    // Création de l'instance PDO pour la connexion
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    
    // Configurer PDO pour afficher les exceptions en cas d'erreur
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
    // Si la connexion échoue, on affiche un message d'erreur et on arrête le script
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>
