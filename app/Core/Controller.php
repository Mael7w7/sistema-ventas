<?php
namespace App\Core;

class Controller
{
    protected function view(string $view, array $data = []): void
    {
        extract($data);
        $viewFile = __DIR__ . '/../Views/' . $view . '.php';
        $currentView = $view;
        require __DIR__ . '/../Views/layout.php';
    }
}
