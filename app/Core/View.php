<?php
namespace App\Core;

class View
{
    public static function render(string $view, array $data = []): void
    {
        extract($data);
        $viewPath = __DIR__ . "/../Views/{$view}.php";
        $layoutPath = __DIR__ . "/../Views/layouts/main.php";

        ob_start();
        require $viewPath;
        $content = ob_get_clean();

        require $layoutPath;
    }
}