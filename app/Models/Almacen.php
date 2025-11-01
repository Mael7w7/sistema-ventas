<?php
namespace App\Models;

use App\Core\DB;

class Almacen
{
    public static function all(): array
    {
        return DB::conn()->query("SELECT * FROM almacen ORDER BY idalmacen DESC")->fetchAll();
    }

    public static function find(int $id)
    {
        $st = DB::conn()->prepare("SELECT * FROM almacen WHERE idalmacen=?");
        $st->execute([$id]);
        return $st->fetch();
    }

    public static function create(array $d): void
    {
        $st = DB::conn()->prepare("INSERT INTO almacen(nombre,direccion,area) VALUES(?,?,?)");
        $st->execute([$d['nombre'],$d['direccion'] ?? null,$d['area'] ?? null]);
    }

    public static function update(int $id, array $d): void
    {
        $st = DB::conn()->prepare("UPDATE almacen SET nombre=?, direccion=?, area=? WHERE idalmacen=?");
        $st->execute([$d['nombre'],$d['direccion'] ?? null,$d['area'] ?? null,$id]);
    }

    public static function delete(int $id): void
    {
        $st = DB::conn()->prepare("DELETE FROM almacen WHERE idalmacen=?");
        $st->execute([$id]);
    }
}
