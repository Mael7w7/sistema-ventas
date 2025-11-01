<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Util;
use App\Models\Vendedor;

class VendedoresController extends Controller
{
    public function index(): void
    {
        $vendedores = Vendedor::all();
        $this->view('vendedores/index', compact('vendedores'));
    }

    public function create(): void
    {
        $this->view('vendedores/form', ['vendedor' => null]);
    }

    public function store(): void
    {
        Vendedor::create([
            'nombre' => $_POST['nombre'] ?? '',
            'codigo' => $_POST['codigo'] ?? '',
            'genero' => $_POST['genero'] ?? null,
        ]);
        Util::redirect('/vendedores');
    }

    public function edit(): void
    {
        $id = (int)($_GET['id'] ?? 0);
        $vendedor = Vendedor::find($id);
        $this->view('vendedores/form', compact('vendedor'));
    }

    public function update(): void
    {
        $id = (int)($_POST['id'] ?? 0);
        Vendedor::update($id, [
            'nombre' => $_POST['nombre'] ?? '',
            'codigo' => $_POST['codigo'] ?? '',
            'genero' => $_POST['genero'] ?? null,
        ]);
        Util::redirect('/vendedores');
    }

    public function delete(): void
    {
        $id = (int)($_GET['id'] ?? 0);
        if ($id) Vendedor::delete($id);
        Util::redirect('/vendedores');
    }
}
