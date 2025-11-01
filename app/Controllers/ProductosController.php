<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Util;
use App\Models\Producto;

class ProductosController extends Controller
{
    public function index(): void
    {
        $productos = Producto::all();
        $this->view('productos/index', compact('productos'));
    }

    public function create(): void
    {
        $this->view('productos/form', ['producto' => null]);
    }

    public function store(): void
    {
        Producto::create([
            'nombre' => $_POST['nombre'] ?? '',
            'precio' => $_POST['precio'] ?? 0,
            'stock' => $_POST['stock'] ?? 0,
            'tipo' => $_POST['tipo'] ?? null,
        ]);
        Util::redirect('/productos');
    }

    public function edit(): void
    {
        $id = (int)($_GET['id'] ?? 0);
        $producto = Producto::find($id);
        $this->view('productos/form', compact('producto'));
    }

    public function update(): void
    {
        $id = (int)($_POST['id'] ?? 0);
        Producto::update($id, [
            'nombre' => $_POST['nombre'] ?? '',
            'precio' => $_POST['precio'] ?? 0,
            'stock' => $_POST['stock'] ?? 0,
            'tipo' => $_POST['tipo'] ?? null,
        ]);
        Util::redirect('/productos');
    }

    public function delete(): void
    {
        $id = (int)($_GET['id'] ?? 0);
        if ($id) Producto::delete($id);
        Util::redirect('/productos');
    }
}
