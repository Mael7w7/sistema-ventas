<?php
namespace App\Core;

class Util
{
    public static function redirect(string $path): void
    {
        header('Location: ' . $path);
        exit;
    }

    public static function post(string $key, $default = null)
    {
        return $_POST[$key] ?? $default;
    }

    public static function get(string $key, $default = null)
    {
        return $_GET[$key] ?? $default;
    }
}
