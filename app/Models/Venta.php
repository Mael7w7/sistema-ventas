<?php
namespace App\Models;

use App\Core\DB;
use PDO;

class Venta
{
    public static function all(): array
    {
        $sql = "SELECT v.*, c.nombre AS cliente, ve.nombre AS vendedor
                FROM venta v
                JOIN cliente c ON c.idcliente=v.idcliente
                JOIN vendedor ve ON ve.idvendedor=v.idvendedor
                ORDER BY v.idventa DESC";
        return DB::conn()->query($sql)->fetchAll();
    }

    public static function find(int $id)
    {
        $st = DB::conn()->prepare("SELECT * FROM venta WHERE idventa=?");
        $st->execute([$id]);
        return $st->fetch();
    }

    public static function create(int $idcliente, int $idvendedor, string $tipopago): int
    {
        $st = DB::conn()->prepare("INSERT INTO venta(idcliente,idvendedor,tipopago,estado,total) VALUES(?,?,?,?,0)");
        $st->execute([$idcliente,$idvendedor,$tipopago,'PAGADA']);
        return intval(DB::conn()->lastInsertId());
    }

    public static function detalles(int $idventa): array
    {
        $sql = "SELECT dv.*, p.nombre FROM detalle_venta dv JOIN producto p ON p.idproducto=dv.idproducto WHERE dv.idventa=?";
        $st = DB::conn()->prepare($sql);
        $st->execute([$idventa]);
        return $st->fetchAll();
    }
}
