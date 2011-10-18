<h1>Registros List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Potencia</th>
      <th>Registrado at</th>
      <th>Sensor</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($registros as $registro): ?>
    <tr>
      <td><a href="<?php echo url_for('registro/show?id='.$registro->getId()) ?>"><?php echo $registro->getId() ?></a></td>
      <td><?php echo $registro->getPotencia() ?></td>
      <td><?php echo $registro->getRegistradoAt() ?></td>
      <td><?php echo $registro->getSensores() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('registro/new') ?>">New</a>
