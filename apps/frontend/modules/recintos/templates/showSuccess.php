<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $recintos->getId() ?></td>
    </tr>
    <tr>
      <th>Nombre:</th>
      <td><?php echo $recintos->getNombre() ?></td>
    </tr>
    <tr>
      <th>Tarifa:</th>
      <td><?php echo $recintos->getTarifaId() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('recintos/edit?id='.$recintos->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('recintos/index') ?>">List</a>
