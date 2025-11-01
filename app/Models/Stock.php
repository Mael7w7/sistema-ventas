<?php
namespace App\Models;

use App\Core\DB;

class Stock
{
    public static function all(): array
    {
        $sql = "SELECT pa.idproducto_almacen, a.nombre AS almacen, p.nombre AS producto, pa.cantidad, pa.idalmacen, pa.idproducto
                FROM producto_almacen pa
                JOIN almacen a ON a.idalmacen = pa.idalmacen
                JOIN producto p ON p.idproducto = pa.idproducto
                ORDER BY pa.idproducto_almacen DESC";
        return DB::conn()->query($sql)->fetchAll();
    }

    public static function of(int $idproducto, int $idalmacen)
    {
        $st = DB::conn()->prepare("SELECT * FROM producto_almacen WHERE idproducto=? AND idalmacen=?");
        $st->execute([$idproducto,$idalmacen]);
        return $st->fetch();
    }

    public static function upsert(int $idproducto, int $idalmacen, int $cantidad): void
    {
        $ex = self::of($idproducto,$idalmacen);
        if ($ex) {
            $st = DB::conn()->prepare("UPDATE producto_almacen SET cantidad=? WHERE idproducto=? AND idalmacen=?");
            $st->execute([$cantidad,$idproducto,$idalmacen]);
        } else {
            $st = DB::conn()->prepare("INSERT INTO producto_almacen(idproducto,idalmacen,fecha,cantidad) VALUES(?,?,CURRENT_DATE,?)");
            $st->execute([$idproducto,$idalmacen,$cantidad]);
        }
    }

    public static function decrease(int $idproducto, int $idalmacen, int $cantidad): bool
    {
        $row = self::of($idproducto,$idalmacen);
        if (!$row || $row['cantidad'] < $cantidad) return false;
        $st = DB::conn()->prepare("UPDATE producto_almacen SET cantidad = cantidad - ? WHERE idproducto=? AND idalmacen=?");
        $st->execute([$cantidad,$idproducto,$idalmacen]);
        return true;
    }
}
