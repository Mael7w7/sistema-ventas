<h2>Ventas</h2>
<p>
  <a href="/">Inicio</a> |
  <a href="/ventas/crear">Nueva Venta</a>
</p>
<table role="grid">
  <thead>
    <tr>
      <th>ID</th><th>Fecha</th><th>Cliente</th><th>Vendedor</th><th>Pago</th><th>Estado</th><th>Total</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($ventas as $v): ?>
    <tr>
      <td><?= htmlspecialchars($v['idventa']) ?></td>
      <td><?= htmlspecialchars($v['fechahora']) ?></td>
      <td><?= htmlspecialchars($v['cliente']) ?></td>
      <td><?= htmlspecialchars($v['vendedor']) ?></td>
      <td><?= htmlspecialchars($v['tipopago']) ?></td>
      <td><?= htmlspecialchars($v['estado']) ?></td>
      <td><?= number_format($v['total'],2) ?></td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
