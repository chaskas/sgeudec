<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $registro->getId() ?></td>
    </tr>
    <tr>
      <th>Potencia:</th>
      <td><?php echo $registro->getPotencia() ?></td>
    </tr>
    <tr>
      <th>Registrado at:</th>
      <td><?php echo $registro->getRegistradoAt() ?></td>
    </tr>
    <tr>
      <th>Sensor:</th>
      <td><?php echo $registro->getSensorId() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('registro/edit?id='.$registro->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('registro/index') ?>">List</a>
