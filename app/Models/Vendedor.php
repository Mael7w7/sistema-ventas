<?php
namespace App\Models;

use App\Core\DB;

class Vendedor
{
    public static function all(): array
    {
        return DB::conn()->query("SELECT * FROM vendedor ORDER BY idvendedor DESC")->fetchAll();
    }

    public static function find(int $id)
    {
        $st = DB::conn()->prepare("SELECT * FROM vendedor WHERE idvendedor=?");
        $st->execute([$id]);
        return $st->fetch();
    }

    public static function create(array $d): void
    {
        $st = DB::conn()->prepare("INSERT INTO vendedor(nombre,codigo,genero) VALUES(?,?,?)");
        $st->execute([$d['nombre'],$d['codigo'],$d['genero'] ?? null]);
    }

    public static function update(int $id, array $d): void
    {
        $st = DB::conn()->prepare("UPDATE vendedor SET nombre=?, codigo=?, genero=? WHERE idvendedor=?");
        $st->execute([$d['nombre'],$d['codigo'],$d['genero'] ?? null,$id]);
    }

    public static function delete(int $id): void
    {
        $st = DB::conn()->prepare("DELETE FROM vendedor WHERE idvendedor=?");
        $st->execute([$id]);
    }
}
