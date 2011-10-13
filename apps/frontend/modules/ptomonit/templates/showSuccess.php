<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $pto_monit->getId() ?></td>
    </tr>
    <tr>
      <th>Nombre:</th>
      <td><?php echo $pto_monit->getNombre() ?></td>
    </tr>
    <tr>
      <th>Potencia i:</th>
      <td><?php echo $pto_monit->getPotenciaI() ?></td>
    </tr>
    <tr>
      <th>Recinto:</th>
      <td><?php echo $pto_monit->getRecintoId() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('ptomonit/edit?id='.$pto_monit->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('ptomonit/index') ?>">List</a>
