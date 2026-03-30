<?php
namespace App\Models\Entities;

class Vehiculo
{
    protected ?int $id;
    protected string $marca;
    protected string $modelo;
    protected string $matricula;
    protected float $precioDia;

    public function __construct(?int $id, string $marca, string $modelo, string $matricula, float $precioDia)
    {
        $this->id = $id;
        $this->marca = $marca;
        $this->modelo = $modelo;
        $this->matricula = $matricula;
        $this->precioDia = $precioDia;
    }

    public function calcularAlquiler(int $dias): float
    {
        return $dias * $this->precioDia;
    }

    public function getId(): ?int { return $this->id; }
    public function getMarca(): string { return $this->marca; }
    public function getModelo(): string { return $this->modelo; }
    public function getMatricula(): string { return $this->matricula; }
    public function getPrecioDia(): float { return $this->precioDia; }
}