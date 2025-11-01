<h2><?= isset($cliente) && $cliente ? 'Editar Cliente' : 'Nuevo Cliente' ?></h2>
<p><a href="/clientes">Volver</a></p>
<form method="post" action="<?= isset($cliente) && $cliente ? '/clientes/actualizar' : '/clientes/guardar' ?>">
  <?php if(isset($cliente) && $cliente): ?>
    <input type="hidden" name="id" value="<?= htmlspecialchars($cliente['idcliente']) ?>">
  <?php endif; ?>
  <label>Nombre
    <input type="text" name="nombre" value="<?= htmlspecialchars($cliente['nombre'] ?? '') ?>" required>
  </label>
  <label>DNI
    <input type="text" name="dni" value="<?= htmlspecialchars($cliente['dni'] ?? '') ?>" required>
  </label>
  <label>Teléfono
    <input type="text" name="telefono" value="<?= htmlspecialchars($cliente['telefono'] ?? '') ?>">
  </label>
  <label>Correo
    <input type="email" name="correo" value="<?= htmlspecialchars($cliente['correo'] ?? '') ?>">
  </label>
  <label>
    <input type="checkbox" name="estado" <?= (isset($cliente['estado']) ? (intval($cliente['estado'])===1?'checked':'') : 'checked') ?>> Activo
  </label>
  <button type="submit">Guardar</button>
</form>
