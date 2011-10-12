<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $unidades->getId() ?></td>
    </tr>
    <tr>
      <th>Unidad:</th>
      <td><?php echo $unidades->getUnidad() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('unidades/edit?id='.$unidades->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('unidades/index') ?>">List</a>
