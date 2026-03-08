CREATE DATABASE IF NOT EXISTS gestion_etudiants;
USE gestion_etudiants;

-- Création de la table students
CREATE TABLE IF NOT EXISTS students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    filiere VARCHAR(100) NOT NULL
);
elisabethmudahama2026