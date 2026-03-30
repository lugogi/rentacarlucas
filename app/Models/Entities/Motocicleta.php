<?php
namespace App\Models\Entities;

class Motocicleta extends Vehiculo
{
    private int $cilindrada;
    private bool $incluyeCasco;

    public function __construct(?int $id, string $marca, string $modelo, string $matricula, float $precioDia, int $cilindrada, bool $incluyeCasco)
    {
        parent::__construct($id, $marca, $modelo, $matricula, $precioDia);
        $this->cilindrada = $cilindrada;
        $this->incluyeCasco = $incluyeCasco;
    }

    public function calcularAlquiler(int $dias): float
    {
        $base = parent::calcularAlquiler($dias);
        return $this->incluyeCasco ? $base + 10 : $base;
    }

    public function getCilindrada(): int { return $this->cilindrada; }
    public function isIncluyeCasco(): bool { return $this->incluyeCasco; }
}