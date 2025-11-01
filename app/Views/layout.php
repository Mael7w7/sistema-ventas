<?php
if (session_status() === PHP_SESSION_NONE) session_start();
$flash = $_SESSION['flash'] ?? null; unset($_SESSION['flash']);
?><!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistema de Venta</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
  <style>
    :root{ --brand:#2563eb; }
    header.topbar{ background:#0f172a; color:#e2e8f0; padding: .8rem 0; margin-bottom:1.2rem; }
    header .container{ display:flex; align-items:center; justify-content:space-between; }
    .brand{ font-weight:700; letter-spacing:.4px; }
    nav a{ color:#e2e8f0; opacity:.9; margin-right:.6rem; }
    nav a:hover{ opacity:1; text-decoration:underline; }
    main.container{ max-width: 1100px; }
    table[role="grid"] th, table[role="grid"] td{ vertical-align:middle; }
    .btn{ display:inline-block; padding:.5rem .9rem; border-radius:.5rem; background:var(--brand); color:#fff !important; border:none; }
    .btn:hover{ filter:brightness(1.05); }
    .hero{ text-align:center; padding: 10vh 0; }
    .hero h1{ font-size: clamp(2rem, 6vw, 3rem); margin-bottom:.5rem; }
    .hero p{ color:#475569; }
    .flash{ padding:.8rem 1rem; border-radius:.5rem; margin-bottom:1rem; }
    .flash.ok{ background:#e0f7ec; color:#065f46; }
    .flash.err{ background:#fee2e2; color:#991b1b; }
  </style>
</head>
<body>
  <header class="topbar">
    <div class="container">
      <div class="brand">Sistema de Venta</div>
      <nav>
        <a href="/">Inicio</a>
        <a href="/clientes">Clientes</a>
        <a href="/productos">Productos</a>
        <a href="/vendedores">Vendedores</a>
        <a href="/almacenes">Almacenes</a>
        <a href="/stock">Stock</a>
        <a href="/ventas">Ventas</a>
      </nav>
    </div>
  </header>
  <main class="container">
    <?php if ($flash): ?>
      <div class="flash <?= htmlspecialchars($flash['type'] ?? 'ok') ?>"><?= htmlspecialchars($flash['msg'] ?? '') ?></div>
    <?php endif; ?>
    <?php if (isset($viewFile)) { include $viewFile; } ?>
  </main>
</body>
</html>
