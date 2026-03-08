<?php
// Inclure le fichier de connexion
require 'db.php';

// Vérifier si l'ID est bien passé dans l'URL
if (!isset($_GET['id'])) {
    // S'il n'y a pas d'ID, on redirige vers l'accueil
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];

// Récupérer les informations de l'étudiant concerné
$stmt = $pdo->prepare("SELECT * FROM students WHERE id = :id");
$stmt->execute([':id' => $id]);
$student = $stmt->fetch(PDO::FETCH_ASSOC);

// Si l'étudiant n'existe pas en base de données
if (!$student) {
    die("Étudiant introuvable.");
}

// Vérifier si le formulaire de modification a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des nouvelles données
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $filiere = $_POST['filiere'];

    // Préparer la requête de mise à jour
    $sql = "UPDATE students SET nom = :nom, prenom = :prenom, email = :email, filiere = :filiere WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    
    // Exécuter la mise à jour
    $stmt->execute([
        ':nom' => $nom,
        ':prenom' => $prenom,
        ':email' => $email,
        ':filiere' => $filiere,
        ':id' => $id
    ]);

    // Rediriger vers l'accueil
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Étudiant</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

    <h2 class="mb-4">Modifier l'Étudiant</h2>
    
    <!-- Bouton de retour -->
    <a href="index.php" class="btn btn-secondary mb-3">Retour à la liste</a>

    <!-- Formulaire pré-rempli avec les données de l'étudiant -->
    <form action="edit.php?id=<?= htmlspecialchars($student['id']) ?>" method="POST" class="border p-4 shadow-sm rounded bg-light">
        <div class="mb-3">
            <label for="nom" class="form-label">Nom :</label>
            <!-- L'attribut value contient l'ancienne valeur, sécurisée avec htmlspecialchars -->
            <input type="text" name="nom" id="nom" class="form-control" value="<?= htmlspecialchars($student['nom']) ?>" required>
        </div>
        
        <div class="mb-3">
            <label for="prenom" class="form-label">Prénom :</label>
            <input type="text" name="prenom" id="prenom" class="form-control" value="<?= htmlspecialchars($student['prenom']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email :</label>
            <input type="email" name="email" id="email" class="form-control" value="<?= htmlspecialchars($student['email']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="filiere" class="form-label">Filière :</label>
            <input type="text" name="filiere" id="filiere" class="form-control" value="<?= htmlspecialchars($student['filiere']) ?>" required>
        </div>

        <button type="submit" class="btn btn-warning">Mettre à jour</button>
    </form>

</body>
</html>
