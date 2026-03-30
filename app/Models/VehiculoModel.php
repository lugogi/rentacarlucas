<?php
namespace App\Models;

use App\Core\Database;
use App\Models\Entities\Coche;
use App\Models\Entities\Motocicleta;
use PDO;

class VehiculoModel
{
    private PDO $db;
    public function __construct() { $this->db = Database::getConnection(); }

    public function all(): array
    {
        $stmt = $this->db->prepare("SELECT * FROM vehiculo ORDER BY id DESC");
        $stmt->execute();
        $rows = $stmt->fetchAll();

        return array_map(function($r) {
            if ($r['tipoVehiculo'] === 'Coche') {
                return new Coche((int)$r['id'], $r['marca'], $r['modelo'], $r['matricula'], (float)$r['precioDia'], (int)$r['numeroPuertas'], (string)$r['tipoCombustible']);
            }
            return new Motocicleta((int)$r['id'], $r['marca'], $r['modelo'], $r['matricula'], (float)$r['precioDia'], (int)$r['cilindrada'], (bool)$r['incluyeCasco']);
        }, $rows);
    }

    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM vehiculo WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public function create(array $data): bool
    {
        $sql = "INSERT INTO vehiculo (tipoVehiculo, marca, modelo, matricula, precioDia, numeroPuertas, tipoCombustible, cilindrada, incluyeCasco)
                VALUES (:tipoVehiculo, :marca, :modelo, :matricula, :precioDia, :numeroPuertas, :tipoCombustible, :cilindrada, :incluyeCasco)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    public function update(int $id, array $data): bool
    {
        $data['id'] = $id;
        $sql = "UPDATE vehiculo SET
                tipoVehiculo=:tipoVehiculo, marca=:marca, modelo=:modelo, matricula=:matricula, precioDia=:precioDia,
                numeroPuertas=:numeroPuertas, tipoCombustible=:tipoCombustible, cilindrada=:cilindrada, incluyeCasco=:incluyeCasco
                WHERE id=:id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM vehiculo WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}