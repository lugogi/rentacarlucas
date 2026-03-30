<?php
namespace App\Models;

use App\Core\Database;
use PDO;

class UsuarioModel
{
    private PDO $db;
    public function __construct() { $this->db = Database::getConnection(); }

    public function create(string $email, string $passwordHash): bool
    {
        $sql = "INSERT INTO usuario (email, password) VALUES (:email, :password)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['email' => $email, 'password' => $passwordHash]);
    }

    public function findByEmail(string $email): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM usuario WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => $email]);
        $row = $stmt->fetch();
        return $row ?: null;
    }
}