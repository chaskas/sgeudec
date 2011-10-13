<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $sensores->getId() ?></td>
    </tr>
    <tr>
      <th>Identificador:</th>
      <td><?php echo $sensores->getIdentificador() ?></td>
    </tr>
    <tr>
      <th>Ubicacion:</th>
      <td><?php echo $sensores->getUbicacion() ?></td>
    </tr>
    <tr>
      <th>Ptomonit:</th>
      <td><?php echo $sensores->getPtomonitId() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('sensores/edit?id='.$sensores->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('sensores/index') ?>">List</a>
