<h2><?= isset($producto) && $producto ? 'Editar Producto' : 'Nuevo Producto' ?></h2>
<p><a href="/productos">Volver</a></p>
<form method="post" action="<?= isset($producto) && $producto ? '/productos/actualizar' : '/productos/guardar' ?>">
  <?php if(isset($producto) && $producto): ?>
    <input type="hidden" name="id" value="<?= htmlspecialchars($producto['idproducto']) ?>">
  <?php endif; ?>
  <label>Nombre
    <input type="text" name="nombre" value="<?= htmlspecialchars($producto['nombre'] ?? '') ?>" required>
  </label>
  <label>Precio
    <input type="number" step="0.01" name="precio" value="<?= htmlspecialchars($producto['precio'] ?? '0.00') ?>" required>
  </label>
  <label>Stock
    <input type="number" name="stock" value="<?= htmlspecialchars($producto['stock'] ?? '0') ?>" required>
  </label>
  <label>Tipo
    <input type="text" name="tipo" value="<?= htmlspecialchars($producto['tipo'] ?? '') ?>">
  </label>
  <button type="submit">Guardar</button>
</form>
