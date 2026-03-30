<?php
namespace App\Models\Entities;

class Coche extends Vehiculo
{
    private int $numeroPuertas;
    private string $tipoCombustible;

    public function __construct(?int $id, string $marca, string $modelo, string $matricula, float $precioDia, int $numeroPuertas, string $tipoCombustible)
    {
        parent::__construct($id, $marca, $modelo, $matricula, $precioDia);
        $this->numeroPuertas = $numeroPuertas;
        $this->tipoCombustible = $tipoCombustible;
    }

    public function calcularAlquiler(int $dias): float
    {
        $base = parent::calcularAlquiler($dias);
        return strtolower($this->tipoCombustible) === 'electrico' ? $base * 1.05 : $base;
    }

    public function getNumeroPuertas(): int { return $this->numeroPuertas; }
    public function getTipoCombustible(): string { return $this->tipoCombustible; }
}