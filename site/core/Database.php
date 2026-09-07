<?php
// core/Database.php

namespace App\Core;

require_once __DIR__ . '/../config/env.php';

class Database
{
    private static ?\PDO $instance = null;

    public static function getConnection(): \PDO
    {
        if (self::$instance === null) {
            $dsn = "mysql:host={$_ENV['SERVEUR_BD']};dbname={$_ENV['NOM_BD']};charset={$_ENV['CHARSET']}";

            try {
                self::$instance = new \PDO($dsn, $_ENV['USER'], $_ENV['MDP'], [
                    \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
                    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                ]);
            } catch (\PDOException $e) {
                die('Erreur de connexion à la base de données : ' . $e->getMessage());
            }
        }

        return self::$instance;
    }
}
