<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;
use App\Models\VehiculoModel;

class VehicleController extends Controller
{
    private VehiculoModel $model;

    public function __construct()
    {
        $this->model = new VehiculoModel();
    }

    public function index(): void
    {
        $this->view('vehicles/index', [
            'vehicles' => $this->model->allRaw()
        ]);
    }

    public function create(): void
    {
        $this->requireAuth();
        $this->view('vehicles/create');
    }

    public function store(): void
    {
        $this->requireAuth();
        $data = $this->mapPostData();

        if (!$data) {
            Session::flash('error', 'Datos inválidos.');
            $this->redirect('/public/vehicles/create');
        }

        try {
            $this->model->create($data);
            Session::flash('success', 'Vehículo creado correctamente.');
            $this->redirect('/public');
        } catch (\Throwable $e) {
            Session::flash('error', 'No se pudo crear (matrícula duplicada o datos inválidos).');
            $this->redirect('/public/vehicles/create');
        }
    }

    public function edit(): void
    {
        $this->requireAuth();

        $id = (int)($_GET['id'] ?? 0);
        $vehicle = $this->model->find($id);

        if (!$vehicle) {
            Session::flash('error', 'Vehículo no encontrado.');
            $this->redirect('/public');
        }

        $this->view('vehicles/edit', ['v' => $vehicle]);
    }

    public function update(): void
    {
        $this->requireAuth();

        $id = (int)($_POST['id'] ?? 0);
        $data = $this->mapPostData();

        if (!$id || !$data) {
            Session::flash('error', 'Datos inválidos.');
            $this->redirect('/public');
        }

        try {
            $this->model->update($id, $data);
            Session::flash('success', 'Vehículo actualizado.');
            $this->redirect('/public');
        } catch (\Throwable $e) {
            Session::flash('error', 'No se pudo actualizar.');
            $this->redirect('/public/vehicles/edit?id=' . $id);
        }
    }

    public function delete(): void
    {
        $this->requireAuth();

        $id = (int)($_POST['id'] ?? 0);
        if ($id) {
            $this->model->delete($id);
            Session::flash('success', 'Vehículo eliminado.');
        } else {
            Session::flash('error', 'ID inválido.');
        }

        $this->redirect('/public');
    }

    private function mapPostData(): ?array
    {
        $tipoVehiculo = $_POST['tipoVehiculo'] ?? '';
        $marca = trim($_POST['marca'] ?? '');
        $modelo = trim($_POST['modelo'] ?? '');
        $matricula = trim($_POST['matricula'] ?? '');
        $precioDia = (float)($_POST['precioDia'] ?? 0);

        if (!$tipoVehiculo || !$marca || !$modelo || !$matricula || $precioDia <= 0) {
            return null;
        }

        $numeroPuertas = null;
        $tipoCombustible = null;
        $cilindrada = null;
        $incluyeCasco = null;

        if ($tipoVehiculo === 'Coche') {
            $numeroPuertas = (int)($_POST['numeroPuertas'] ?? 0);
            $tipoCombustible = trim($_POST['tipoCombustible'] ?? '');
            if ($numeroPuertas <= 0 || !$tipoCombustible) return null;
        } elseif ($tipoVehiculo === 'Motocicleta') {
            $cilindrada = (int)($_POST['cilindrada'] ?? 0);
            $incluyeCasco = isset($_POST['incluyeCasco']) ? 1 : 0;
            if ($cilindrada <= 0) return null;
        } else {
            return null;
        }

        return [
            'tipoVehiculo' => $tipoVehiculo,
            'marca' => $marca,
            'modelo' => $modelo,
            'matricula' => $matricula,
            'precioDia' => $precioDia,
            'numeroPuertas' => $numeroPuertas,
            'tipoCombustible' => $tipoCombustible,
            'cilindrada' => $cilindrada,
            'incluyeCasco' => $incluyeCasco
        ];
    }
}