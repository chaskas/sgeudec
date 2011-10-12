<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $cargos->getId() ?></td>
    </tr>
    <tr>
      <th>Nombre:</th>
      <td><?php echo $cargos->getNombre() ?></td>
    </tr>
    <tr>
      <th>Valor:</th>
      <td><?php echo $cargos->getValor() ?></td>
    </tr>
    <tr>
      <th>Tarifa:</th>
      <td><?php echo $cargos->getTarifaId() ?></td>
    </tr>
    <tr>
      <th>Unidades:</th>
      <td><?php echo $cargos->getUnidadesId() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('cargos/edit?id='.$cargos->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('cargos/index') ?>">List</a>
