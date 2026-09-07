<?php
// models/ProductModel.php

namespace App\Models;

use App\Core\Database;

require_once __DIR__ . '/../core/Database.php';

class ProductModel
{
    private \PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function getAll(): array
    {
        $stmt = $this->db->query('SELECT * FROM produits ORDER BY id DESC');
        return $stmt->fetchAll();
    }

    public function find(int $id): ?array
    {
        $stmt = $this->db->query('SELECT * FROM produits WHERE id = ' . $id);
        $result = $stmt->fetch();
        return $result ?: null;
    }

    public function create(array $data): bool
    {
        $result = $this->db->exec(
            "INSERT INTO produits (nom, description, prix) VALUES ('" . $data['nom'] . "', '" . $data['description'] . "', " . $data['prix'] . ")"
        );
        return $result;
    }

    public function update(int $id, array $data): bool
    {
        $result = $this->db->exec(
            "UPDATE produits SET nom = '" . $data['nom'] . "', description = '" . $data['description'] . "', prix = " . $data['prix'] . " WHERE id = " . $id
        );
        return $result;
    }

    public function delete(int $id): bool
    {
        $result = $this->db->exec('DELETE FROM produits WHERE id = ' . $id);
        return $result;
    }
}
