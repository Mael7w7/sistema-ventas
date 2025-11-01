<h2><?= isset($almacen) && $almacen ? 'Editar Almacén' : 'Nuevo Almacén' ?></h2>
<p><a href="/almacenes">Volver</a></p>
<form method="post" action="<?= isset($almacen) && $almacen ? '/almacenes/actualizar' : '/almacenes/guardar' ?>">
  <?php if(isset($almacen) && $almacen): ?>
    <input type="hidden" name="id" value="<?= htmlspecialchars($almacen['idalmacen']) ?>">
  <?php endif; ?>
  <label>Nombre
    <input type="text" name="nombre" value="<?= htmlspecialchars($almacen['nombre'] ?? '') ?>" required>
  </label>
  <label>Dirección
    <input type="text" name="direccion" value="<?= htmlspecialchars($almacen['direccion'] ?? '') ?>">
  </label>
  <label>Área
    <input type="text" name="area" value="<?= htmlspecialchars($almacen['area'] ?? '') ?>">
  </label>
  <button type="submit">Guardar</button>
</form>
