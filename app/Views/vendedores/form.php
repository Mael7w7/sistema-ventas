<h2><?= isset($vendedor) && $vendedor ? 'Editar Vendedor' : 'Nuevo Vendedor' ?></h2>
<p><a href="/vendedores">Volver</a></p>
<form method="post" action="<?= isset($vendedor) && $vendedor ? '/vendedores/actualizar' : '/vendedores/guardar' ?>">
  <?php if(isset($vendedor) && $vendedor): ?>
    <input type="hidden" name="id" value="<?= htmlspecialchars($vendedor['idvendedor']) ?>">
  <?php endif; ?>
  <label>Nombre
    <input type="text" name="nombre" value="<?= htmlspecialchars($vendedor['nombre'] ?? '') ?>" required>
  </label>
  <label>Código
    <input type="text" name="codigo" value="<?= htmlspecialchars($vendedor['codigo'] ?? '') ?>" required>
  </label>
  <label>Género
    <select name="genero">
      <option value="">-</option>
      <option value="M" <?= (isset($vendedor['genero']) && $vendedor['genero']==='M')?'selected':'' ?>>M</option>
      <option value="F" <?= (isset($vendedor['genero']) && $vendedor['genero']==='F')?'selected':'' ?>>F</option>
      <option value="O" <?= (isset($vendedor['genero']) && $vendedor['genero']==='O')?'selected':'' ?>>O</option>
    </select>
  </label>
  <button type="submit">Guardar</button>
</form>
