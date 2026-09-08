-- Création de la base de données
CREATE DATABASE IF NOT EXISTS mvc_app CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE mvc_app;

-- Table des produits
CREATE TABLE IF NOT EXISTS produits (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    description TEXT,
    prix DECIMAL(10,2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Quelques données de test
INSERT INTO produits (nom, description, prix) VALUES
('Clavier mécanique', 'Clavier RGB switch rouge', 79.99),
('Souris sans fil', 'Souris ergonomique 1600 DPI', 29.90),
('Écran 27 pouces', 'Dalle IPS 144Hz', 249.00);
