<?php
// Inclure le fichier de connexion
require 'db.php';

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $filiere = $_POST['filiere'];

    // Préparer la requête SQL d'insertion (utilisation de requêtes préparées pour la sécurité)
    $sql = "INSERT INTO students (nom, prenom, email, filiere) VALUES (:nom, :prenom, :email, :filiere)";
    $stmt = $pdo->prepare($sql);
    
    // Exécuter la requête en passant les valeurs
    $stmt->execute([
        ':nom' => $nom,
        ':prenom' => $prenom,
        ':email' => $email,
        ':filiere' => $filiere
    ]);

    // Rediriger vers la page d'accueil après l'ajout
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Étudiant</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

    <h2 class="mb-4">Ajouter un Étudiant</h2>
    
    <!-- Bouton de retour -->
    <a href="index.php" class="btn btn-secondary mb-3">Retour à la liste</a>

    <!-- Formulaire d'ajout -->
    <form action="create.php" method="POST" class="border p-4 shadow-sm rounded bg-light">
        <div class="mb-3">
            <label for="nom" class="form-label">Nom :</label>
            <input type="text" name="nom" id="nom" class="form-control" placeholder="Entrez le nom" required>
        </div>
        
        <div class="mb-3">
            <label for="prenom" class="form-label">Prénom :</label>
            <input type="text" name="prenom" id="prenom" class="form-control" placeholder="Entrez le prénom" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email :</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="exemple@email.com" required>
        </div>

        <div class="mb-3">
            <label for="filiere" class="form-label">Filière :</label>
            <input type="text" name="filiere" id="filiere" class="form-control" placeholder="Ex: Informatique" required>
        </div>

        <button type="submit" class="btn btn-success">Enregistrer</button>
    </form>

</body>
</html>
