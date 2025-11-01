<?php
namespace App\Models;

use App\Core\DB;

class Producto
{
    public static function all(): array
    {
        return DB::conn()->query("SELECT * FROM producto ORDER BY idproducto DESC")->fetchAll();
    }

    public static function find(int $id)
    {
        $st = DB::conn()->prepare("SELECT * FROM producto WHERE idproducto=?");
        $st->execute([$id]);
        return $st->fetch();
    }

    public static function create(array $d): void
    {
        $st = DB::conn()->prepare("INSERT INTO producto(nombre,precio,stock,tipo) VALUES(?,?,?,?)");
        $st->execute([$d['nombre'], $d['precio'], $d['stock'] ?? 0, $d['tipo'] ?? null]);
    }

    public static function update(int $id, array $d): void
    {
        $st = DB::conn()->prepare("UPDATE producto SET nombre=?, precio=?, stock=?, tipo=? WHERE idproducto=?");
        $st->execute([$d['nombre'], $d['precio'], $d['stock'] ?? 0, $d['tipo'] ?? null, $id]);
    }

    public static function delete(int $id): void
    {
        $st = DB::conn()->prepare("DELETE FROM producto WHERE idproducto=?");
        $st->execute([$id]);
    }
}
