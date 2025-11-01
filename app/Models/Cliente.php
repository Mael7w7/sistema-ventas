<?php
namespace App\Models;

use App\Core\DB;
use PDO;

class Cliente
{
    public static function all(): array
    {
        return DB::conn()->query("SELECT * FROM cliente ORDER BY idcliente DESC")->fetchAll();
    }

    public static function find(int $id)
    {
        $st = DB::conn()->prepare("SELECT * FROM cliente WHERE idcliente=?");
        $st->execute([$id]);
        return $st->fetch();
    }

    public static function create(array $d): void
    {
        $st = DB::conn()->prepare("INSERT INTO cliente(nombre,dni,telefono,correo,estado) VALUES(?,?,?,?,?)");
        $st->execute([$d['nombre'],$d['dni'],$d['telefono'],$d['correo'],$d['estado'] ?? 1]);
    }

    public static function update(int $id, array $d): void
    {
        $st = DB::conn()->prepare("UPDATE cliente SET nombre=?, dni=?, telefono=?, correo=?, estado=? WHERE idcliente=?");
        $st->execute([$d['nombre'],$d['dni'],$d['telefono'],$d['correo'],$d['estado'] ?? 1,$id]);
    }

    public static function delete(int $id): void
    {
        $st = DB::conn()->prepare("DELETE FROM cliente WHERE idcliente=?");
        $st->execute([$id]);
    }
}
