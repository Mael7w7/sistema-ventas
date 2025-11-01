<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Util;
use App\Models\Almacen;

class AlmacenesController extends Controller
{
    public function index(): void
    {
        $almacenes = Almacen::all();
        $this->view('almacenes/index', compact('almacenes'));
    }

    public function create(): void
    {
        $this->view('almacenes/form', ['almacen' => null]);
    }

    public function store(): void
    {
        Almacen::create([
            'nombre' => $_POST['nombre'] ?? '',
            'direccion' => $_POST['direccion'] ?? null,
            'area' => $_POST['area'] ?? null,
        ]);
        Util::redirect('/almacenes');
    }

    public function edit(): void
    {
        $id = (int)($_GET['id'] ?? 0);
        $almacen = Almacen::find($id);
        $this->view('almacenes/form', compact('almacen'));
    }

    public function update(): void
    {
        $id = (int)($_POST['id'] ?? 0);
        Almacen::update($id, [
            'nombre' => $_POST['nombre'] ?? '',
            'direccion' => $_POST['direccion'] ?? null,
            'area' => $_POST['area'] ?? null,
        ]);
        Util::redirect('/almacenes');
    }

    public function delete(): void
    {
        $id = (int)($_GET['id'] ?? 0);
        if ($id) Almacen::delete($id);
        Util::redirect('/almacenes');
    }
}
