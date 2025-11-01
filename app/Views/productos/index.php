<h2>Productos</h2>
<p>
  <a href="/">Inicio</a> |
  <a href="/productos/crear">Nuevo Producto</a>
</p>
<table role="grid">
  <thead>
    <tr>
      <th>ID</th><th>Nombre</th><th>Precio</th><th>Stock</th><th>Tipo</th><th>Acciones</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($productos as $p): ?>
    <tr>
      <td><?= htmlspecialchars($p['idproducto']) ?></td>
      <td><?= htmlspecialchars($p['nombre']) ?></td>
      <td><?= number_format($p['precio'],2) ?></td>
      <td><?= htmlspecialchars($p['stock']) ?></td>
      <td><?= htmlspecialchars($p['tipo']) ?></td>
      <td>
        <a href="/productos/editar?id=<?= $p['idproducto'] ?>">Editar</a>
        |
        <a href="/productos/eliminar?id=<?= $p['idproducto'] ?>" onclick="return confirm('¿Eliminar?')">Eliminar</a>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
