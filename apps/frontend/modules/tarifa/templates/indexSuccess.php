<h1>Tarifass List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Nombre</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($tarifass as $tarifas): ?>
    <tr>
      <td><a href="<?php echo url_for('tarifa/show?id='.$tarifas->getId()) ?>"><?php echo $tarifas->getId() ?></a></td>
      <td><?php echo $tarifas->getNombre() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('tarifa/new') ?>">New</a>
