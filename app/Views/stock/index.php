<h2>Stock por Almacén</h2>
<p>
  <a href="/">Inicio</a> |
  <a href="/stock/crear">Cargar/Actualizar Stock</a>
</p>
<table role="grid">
  <thead>
    <tr>
      <th>ID</th><th>Almacén</th><th>Producto</th><th>Cantidad</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($stocks as $s): ?>
    <tr>
      <td><?= htmlspecialchars($s['idproducto_almacen']) ?></td>
      <td><?= htmlspecialchars($s['almacen']) ?></td>
      <td><?= htmlspecialchars($s['producto']) ?></td>
      <td><?= htmlspecialchars($s['cantidad']) ?></td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
