<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Util;
use App\Models\Cliente;

class ClientesController extends Controller
{
    public function index(): void
    {
        $clientes = Cliente::all();
        $this->view('clientes/index', compact('clientes'));
    }

    public function create(): void
    {
        $this->view('clientes/form', ['cliente' => null]);
    }

    public function store(): void
    {
        Cliente::create([
            'nombre' => $_POST['nombre'] ?? '',
            'dni' => $_POST['dni'] ?? '',
            'telefono' => $_POST['telefono'] ?? null,
            'correo' => $_POST['correo'] ?? null,
            'estado' => isset($_POST['estado']) ? 1 : 0,
        ]);
        Util::redirect('/clientes');
    }

    public function edit(): void
    {
        $id = (int)($_GET['id'] ?? 0);
        $cliente = Cliente::find($id);
        $this->view('clientes/form', compact('cliente'));
    }

    public function update(): void
    {
        $id = (int)($_POST['id'] ?? 0);
        Cliente::update($id, [
            'nombre' => $_POST['nombre'] ?? '',
            'dni' => $_POST['dni'] ?? '',
            'telefono' => $_POST['telefono'] ?? null,
            'correo' => $_POST['correo'] ?? null,
            'estado' => isset($_POST['estado']) ? 1 : 0,
        ]);
        Util::redirect('/clientes');
    }

    public function delete(): void
    {
        $id = (int)($_GET['id'] ?? 0);
        if ($id) Cliente::delete($id);
        Util::redirect('/clientes');
    }
}
