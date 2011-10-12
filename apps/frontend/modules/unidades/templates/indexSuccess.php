<h1>Unidadess List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Unidad</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($unidadess as $unidades): ?>
    <tr>
      <td><a href="<?php echo url_for('unidades/show?id='.$unidades->getId()) ?>"><?php echo $unidades->getId() ?></a></td>
      <td><?php echo $unidades->getUnidad() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('unidades/new') ?>">New</a>
