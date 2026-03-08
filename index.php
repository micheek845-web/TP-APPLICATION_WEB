<?php
// Inclure le fichier de connexion à la base de données
require 'db.php';

// Préparer une requête pour récupérer tous les étudiants
$stmt = $pdo->query("SELECT * FROM students ORDER BY id DESC");

// Récupérer les résultats sous forme de tableau associatif
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Étudiants</title>
    <!-- Utilisation de Bootstrap pour un style simple et propre -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

    <h2 class="mb-4">Liste des Étudiants</h2>
    
    <!-- Bouton pour aller vers la page de création -->
    <a href="create.php" class="btn btn-primary mb-3">Ajouter un Étudiant</a>

    <!-- Tableau d'affichage des étudiants -->
    <table class="table table-bordered table-striped shadow-sm">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Filière</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($students as $student): ?>
                <tr>
                    <td><?= htmlspecialchars($student['id']) ?></td>
                    <td><?= htmlspecialchars($student['nom']) ?></td>
                    <td><?= htmlspecialchars($student['prenom']) ?></td>
                    <td><?= htmlspecialchars($student['email']) ?></td>
                    <td><?= htmlspecialchars($student['filiere']) ?></td>
                    <td>
                        <!-- Bouton d'édition -->
                        <a href="edit.php?id=<?= $student['id'] ?>" class="btn btn-warning btn-sm">Modifier</a>
                        <!-- Bouton de suppression avec confirmation -->
                        <a href="delete.php?id=<?= $student['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet étudiant ?');">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            
            <!-- Message si la table est vide -->
            <?php if (empty($students)): ?>
                <tr>
                    <td colspan="6" class="text-center">Aucun étudiant n'a été trouvé.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</body>
</html>
