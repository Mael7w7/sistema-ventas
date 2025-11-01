<h2>Cargar/Actualizar Stock</h2>
<p><a href="/stock">Volver</a></p>
<form method="post" action="/stock/guardar">
  <div class="grid">
    <label>Producto
      <select name="idproducto" required>
        <option value="">Selecciona...</option>
        <?php foreach($productos as $p): ?>
          <option value="<?= $p['idproducto'] ?>"><?= htmlspecialchars($p['nombre']) ?></option>
        <?php endforeach; ?>
      </select>
    </label>
    <label>Almacén
      <select name="idalmacen" required>
        <option value="">Selecciona...</option>
        <?php foreach($almacenes as $a): ?>
          <option value="<?= $a['idalmacen'] ?>"><?= htmlspecialchars($a['nombre']) ?></option>
        <?php endforeach; ?>
      </select>
    </label>
    <label>Cantidad
      <input type="number" name="cantidad" min="0" value="0" required>
    </label>
  </div>
  <button type="submit">Guardar</button>
</form>
