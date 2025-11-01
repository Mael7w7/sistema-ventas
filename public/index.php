<?php
use App\Core\Router;
use App\Core\Controller;
use App\Core\DB;
use App\Controllers\ClientesController;
use App\Controllers\ProductosController;
use App\Controllers\VendedoresController;
use App\Controllers\AlmacenesController;
use App\Controllers\VentasController;
use App\Controllers\StockController;
use App\Controllers\HomeController;

spl_autoload_register(function ($class) {
    $prefix = 'App\\';
    $base_dir = __DIR__ . '/../app/';
    if (strncmp($prefix, $class, strlen($prefix)) !== 0) return;
    $relative_class = substr($class, strlen($prefix));
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
    if (file_exists($file)) require $file;
});

$router = new Router();

$router->get('/', function(){ (new HomeController)->index(); });

// Clientes
$router->get('/clientes', function(){ (new ClientesController)->index(); });
$router->get('/clientes/crear', function(){ (new ClientesController)->create(); });
$router->post('/clientes/guardar', function(){ (new ClientesController)->store(); });
$router->get('/clientes/editar', function(){ (new ClientesController)->edit(); });
$router->post('/clientes/actualizar', function(){ (new ClientesController)->update(); });
$router->get('/clientes/eliminar', function(){ (new ClientesController)->delete(); });

// Productos
$router->get('/productos', function(){ (new ProductosController)->index(); });
$router->get('/productos/crear', function(){ (new ProductosController)->create(); });
$router->post('/productos/guardar', function(){ (new ProductosController)->store(); });
$router->get('/productos/editar', function(){ (new ProductosController)->edit(); });
$router->post('/productos/actualizar', function(){ (new ProductosController)->update(); });
$router->get('/productos/eliminar', function(){ (new ProductosController)->delete(); });

// Vendedores
$router->get('/vendedores', function(){ (new VendedoresController)->index(); });
$router->get('/vendedores/crear', function(){ (new VendedoresController)->create(); });
$router->post('/vendedores/guardar', function(){ (new VendedoresController)->store(); });
$router->get('/vendedores/editar', function(){ (new VendedoresController)->edit(); });
$router->post('/vendedores/actualizar', function(){ (new VendedoresController)->update(); });
$router->get('/vendedores/eliminar', function(){ (new VendedoresController)->delete(); });

// Almacenes
$router->get('/almacenes', function(){ (new AlmacenesController)->index(); });
$router->get('/almacenes/crear', function(){ (new AlmacenesController)->create(); });
$router->post('/almacenes/guardar', function(){ (new AlmacenesController)->store(); });
$router->get('/almacenes/editar', function(){ (new AlmacenesController)->edit(); });
$router->post('/almacenes/actualizar', function(){ (new AlmacenesController)->update(); });
$router->get('/almacenes/eliminar', function(){ (new AlmacenesController)->delete(); });

// Ventas
$router->get('/ventas', function(){ (new VentasController)->index(); });
$router->get('/ventas/crear', function(){ (new VentasController)->create(); });
$router->post('/ventas/guardar', function(){ (new VentasController)->store(); });

// Stock
$router->get('/stock', function(){ (new StockController)->index(); });
$router->get('/stock/crear', function(){ (new StockController)->create(); });
$router->post('/stock/guardar', function(){ (new StockController)->store(); });

$router->dispatch();
