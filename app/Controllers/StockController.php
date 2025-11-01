<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Util;
use App\Models\Stock as StockModel;
use App\Models\Producto;
use App\Models\Almacen;

class StockController extends Controller
{
    public function index(): void
    {
        $stocks = StockModel::all();
        $this->view('stock/index', compact('stocks'));
    }

    public function create(): void
    {
        $productos = Producto::all();
        $almacenes = Almacen::all();
        $this->view('stock/form', compact('productos','almacenes'));
    }

    public function store(): void
    {
        $idproducto = (int)($_POST['idproducto'] ?? 0);
        $idalmacen = (int)($_POST['idalmacen'] ?? 0);
        $cantidad = (int)($_POST['cantidad'] ?? 0);
        if($idproducto && $idalmacen){
            StockModel::upsert($idproducto,$idalmacen,$cantidad);
        }
        Util::redirect('/stock');
    }
}
