<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $tarifas->getId() ?></td>
    </tr>
    <tr>
      <th>Nombre:</th>
      <td><?php echo $tarifas->getNombre() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('tarifa/edit?id='.$tarifas->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('tarifa/index') ?>">List</a>
