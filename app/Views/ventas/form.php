<h2>Nueva Venta</h2>
<p><a href="/ventas">Volver</a></p>
<form method="post" action="/ventas/guardar">
  <div class="grid">
    <label>Cliente
      <select name="idcliente" required>
        <option value="">Selecciona...</option>
        <?php foreach($clientes as $c): ?>
          <option value="<?= $c['idcliente'] ?>"><?= htmlspecialchars($c['nombre']) ?></option>
        <?php endforeach; ?>
      </select>
    </label>
    <label>Vendedor
      <select name="idvendedor" required>
        <option value="">Selecciona...</option>
        <?php foreach($vendedores as $v): ?>
          <option value="<?= $v['idvendedor'] ?>"><?= htmlspecialchars($v['nombre']) ?></option>
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
    <label>Tipo de Pago
      <select name="tipopago">
        <option value="EFECTIVO">Efectivo</option>
        <option value="TARJETA">Tarjeta</option>
        <option value="TRANSFERENCIA">Transferencia</option>
      </select>
    </label>
  </div>

  <h3>Productos</h3>
  <table id="tbl" role="grid">
    <thead>
      <tr><th>Producto</th><th>Cantidad</th><th>Precio</th><th></th></tr>
    </thead>
    <tbody></tbody>
  </table>
  <button type="button" id="add">Agregar Producto</button>
  <p><strong>Total estimado:</strong> <span id="total">0.00</span></p>
  <button type="submit">Confirmar Venta</button>
</form>

<script>
(function(){
  const productos = <?php
    echo json_encode(array_map(function($p){
      return ['id'=>$p['idproducto'],'nombre'=>$p['nombre'],'precio'=>$p['precio']];
    }, $productos));
  ?>;
  const tbody = document.querySelector('#tbl tbody');
  const addBtn = document.getElementById('add');
  const totalEl = document.getElementById('total');

  function recalc(){
    let t=0; tbody.querySelectorAll('tr').forEach(tr=>{
      const qty = parseFloat(tr.querySelector('input[name="cantidad[]"]').value||0);
      const price = parseFloat(tr.querySelector('input[name="precio[]"]').value||0);
      t += qty*price;
    });
    totalEl.textContent = t.toFixed(2);
  }

  function row(){
    const tr = document.createElement('tr');
    const sel = document.createElement('select'); sel.name='idproducto[]'; sel.required=true;
    sel.innerHTML = '<option value="">Selecciona...</option>' + productos.map(p=>`<option value="${p.id}" data-precio="${p.precio}">${p.nombre}</option>`).join('');

    const td1=document.createElement('td'); td1.appendChild(sel);
    const td2=document.createElement('td'); td2.innerHTML='<input type="number" name="cantidad[]" min="1" value="1" style="width:100px">';
    const td3=document.createElement('td'); td3.innerHTML='<input type="number" step="0.01" name="precio[]" value="0.00" style="width:120px">';
    const td4=document.createElement('td'); td4.innerHTML='<button type="button" class="rm">Quitar</button>';

    tr.append(td1,td2,td3,td4); tbody.appendChild(tr);

    sel.addEventListener('change',()=>{
      const opt = sel.selectedOptions[0];
      if(opt && opt.dataset.precio){ tr.querySelector('input[name="precio[]"]').value = parseFloat(opt.dataset.precio).toFixed(2); }
      recalc();
    });
    tr.addEventListener('input', recalc);
    tr.querySelector('.rm').addEventListener('click', ()=>{ tr.remove(); recalc(); });
  }

  addBtn.addEventListener('click', row);
  row();
})();
</script>
