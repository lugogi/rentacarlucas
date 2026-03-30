<?php
namespace App\Core;

class Controller
{
    protected function view(string $view, array $data = []): void
    {
        View::render($view, $data);
    }

    protected function redirect(string $path): void
    {
        header("Location: {$path}");
        exit;
    }

    protected function requireAuth(): void
    {
        if (!Session::has('user_id')) {
            Session::flash('error', 'Debes iniciar sesión para acceder.');
            $this->redirect('/public/login');
        }
    }
}