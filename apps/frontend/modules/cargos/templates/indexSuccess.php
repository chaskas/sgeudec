<h1>Cargoss List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Nombre</th>
      <th>Valor</th>
      <th>Tarifa</th>
      <th>Unidades</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($cargoss as $cargos): ?>
    <tr>
      <td><a href="<?php echo url_for('cargos/show?id='.$cargos->getId()) ?>"><?php echo $cargos->getId() ?></a></td>
      <td><?php echo $cargos->getNombre() ?></td>
      <td><?php echo $cargos->getValor() ?></td>
      <td><?php echo $cargos->getTarifaId() ?></td>
      <td><?php echo $cargos->getUnidadesId() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('cargos/new') ?>">New</a>
