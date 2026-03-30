<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;
use App\Models\UsuarioModel;

class AuthController extends Controller
{
    public function showLogin(): void
    {
        $this->view('auth/login');
    }

    public function showRegister(): void
    {
        $this->view('auth/register');
    }

    public function register(): void
    {
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        if (!$email || !$password) {
            Session::flash('error', 'Completa todos los campos.');
            $this->redirect('/public/register');
        }

        $model = new UsuarioModel();

        if ($model->findByEmail($email)) {
            Session::flash('error', 'El email ya está registrado.');
            $this->redirect('/public/register');
        }

        $hash = password_hash($password, PASSWORD_DEFAULT);
        $model->create($email, $hash);

        Session::flash('success', 'Usuario creado correctamente.');
        $this->redirect('/public/login');
    }

    public function login(): void
    {
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        $model = new UsuarioModel();
        $user = $model->findByEmail($email);

        if (!$user || !password_verify($password, $user['password'])) {
            Session::flash('error', 'Credenciales inválidas.');
            $this->redirect('/public/login');
        }

        Session::set('user_id', $user['id']);
        Session::set('user_email', $user['email']);

        Session::flash('success', 'Bienvenido.');
        $this->redirect('/public');
    }

    public function logout(): void
    {
        Session::destroy();
        $this->redirect('/public');
    }
}