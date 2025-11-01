<h2>Vendedores</h2>
<p>
  <a href="/">Inicio</a> |
  <a href="/vendedores/crear">Nuevo Vendedor</a>
</p>
<table role="grid">
  <thead>
    <tr>
      <th>ID</th><th>Nombre</th><th>Código</th><th>Género</th><th>Acciones</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($vendedores as $v): ?>
    <tr>
      <td><?= htmlspecialchars($v['idvendedor']) ?></td>
      <td><?= htmlspecialchars($v['nombre']) ?></td>
      <td><?= htmlspecialchars($v['codigo']) ?></td>
      <td><?= htmlspecialchars($v['genero']) ?></td>
      <td>
        <a href="/vendedores/editar?id=<?= $v['idvendedor'] ?>">Editar</a>
        |
        <a href="/vendedores/eliminar?id=<?= $v['idvendedor'] ?>" onclick="return confirm('¿Eliminar?')">Eliminar</a>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
