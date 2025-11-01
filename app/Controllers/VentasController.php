<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Util;
use App\Models\Venta;
use App\Models\Cliente;
use App\Models\Vendedor;
use App\Models\Producto;
use App\Models\Almacen;
use App\Models\Stock;
use App\Core\DB;

class VentasController extends Controller
{
    public function index(): void
    {
        $ventas = Venta::all();
        $this->view('ventas/index', compact('ventas'));
    }

    public function create(): void
    {
        $clientes = Cliente::all();
        $vendedores = Vendedor::all();
        $productos = Producto::all();
        $almacenes = Almacen::all();
        $this->view('ventas/form', compact('clientes','vendedores','productos','almacenes'));
    }

    public function store(): void
    {
        $idcliente = (int)($_POST['idcliente'] ?? 0);
        $idvendedor = (int)($_POST['idvendedor'] ?? 0);
        $idalmacen = (int)($_POST['idalmacen'] ?? 0);
        $tipopago = $_POST['tipopago'] ?? 'EFECTIVO';
        $ids = $_POST['idproducto'] ?? [];
        $cants = $_POST['cantidad'] ?? [];
        $precios = $_POST['precio'] ?? [];

        if (!$idcliente || !$idvendedor || !$idalmacen || empty($ids)) {
            Util::redirect('/ventas/crear');
        }

        $pdo = DB::conn();
        $pdo->beginTransaction();
        try {
            $idventa = Venta::create($idcliente,$idvendedor,$tipopago);

            $st = $pdo->prepare("INSERT INTO detalle_venta(idventa,idproducto,cantidad,precio_unit) VALUES(?,?,?,?)");
            foreach ($ids as $i => $idprod) {
                $idp = (int)$idprod;
                $cant = max(1, (int)($cants[$i] ?? 1));
                $precio = (float)($precios[$i] ?? 0);

                // valida stock por almacén
                $row = Stock::of($idp, $idalmacen);
                if (!$row || $row['cantidad'] < $cant) {
                    throw new \Exception('Stock insuficiente');
                }
                // descuenta stock
                Stock::decrease($idp, $idalmacen, $cant);

                $st->execute([$idventa,$idp,$cant,$precio]);
            }
            $pdo->commit();
        } catch (\Throwable $e) {
            $pdo->rollBack();
        }
        Util::redirect('/ventas');
    }
}
