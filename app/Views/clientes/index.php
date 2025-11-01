<h2>Clientes</h2>
<p>
  <a href="/">Inicio</a> |
  <a href="/clientes/crear">Nuevo Cliente</a>
</p>
<table role="grid">
  <thead>
    <tr>
      <th>ID</th><th>Nombre</th><th>DNI</th><th>Teléfono</th><th>Correo</th><th>Estado</th><th>Acciones</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($clientes as $c): ?>
    <tr>
      <td><?= htmlspecialchars($c['idcliente']) ?></td>
      <td><?= htmlspecialchars($c['nombre']) ?></td>
      <td><?= htmlspecialchars($c['dni']) ?></td>
      <td><?= htmlspecialchars($c['telefono']) ?></td>
      <td><?= htmlspecialchars($c['correo']) ?></td>
      <td><?= $c['estado'] ? 'Activo' : 'Inactivo' ?></td>
      <td>
        <a href="/clientes/editar?id=<?= $c['idcliente'] ?>">Editar</a>
        |
        <a href="/clientes/eliminar?id=<?= $c['idcliente'] ?>" onclick="return confirm('¿Eliminar?')">Eliminar</a>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
