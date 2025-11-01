<h2>Almacenes</h2>
<p>
  <a href="/">Inicio</a> |
  <a href="/almacenes/crear">Nuevo Almacén</a>
</p>
<table role="grid">
  <thead>
    <tr>
      <th>ID</th><th>Nombre</th><th>Dirección</th><th>Área</th><th>Acciones</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($almacenes as $a): ?>
    <tr>
      <td><?= htmlspecialchars($a['idalmacen']) ?></td>
      <td><?= htmlspecialchars($a['nombre']) ?></td>
      <td><?= htmlspecialchars($a['direccion']) ?></td>
      <td><?= htmlspecialchars($a['area']) ?></td>
      <td>
        <a href="/almacenes/editar?id=<?= $a['idalmacen'] ?>">Editar</a>
        |
        <a href="/almacenes/eliminar?id=<?= $a['idalmacen'] ?>" onclick="return confirm('¿Eliminar?')">Eliminar</a>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
