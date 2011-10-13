<div class="content-box">

  <div class="content-box-header">

    <h3 style="cursor: s-resize; ">Sensores</h3>

    <ul class="content-box-tabs">
      <li><a href="<?php echo url_for('sensores/new') ?>" class="button">Nuevo sensor</a></li>
    </ul>

    <div class="clear"></div>

  </div>

  <div class="content-box-content">

    <div class="tab-content default-tab" id="tab1" style="display: block; ">

      <table class="listados">
        <thead>
          <tr>
            <th>Pto. Monitoreo</th>
            <th>Identificador</th>
            <th>Ubicaci&oacute;n</th>
            <th>Opciones</th>
          </tr>
        </thead>

        <tbody>
          <?php foreach ($sensoress as $sensores): ?>
          <?php $i = 0; ?>
            <tr <?php if ($i % 2 != 0)echo "class='alt-row'"; ?>>
              <td><?php echo $sensores->getPtomonit() ?></td>
              <td><?php echo $sensores->getIdentificador() ?></td>
              <td><?php echo $sensores->getUbicacion() ?></td>
              <td>
                <?php echo link_to(image_tag('icons/pencil.png',array('alt'=>'Editar','title'=>'Editar')), 'sensores/edit?id='.$sensores->getId()) ?>
                <?php echo link_to(image_tag('icons/cross.png',array('alt'=>'Eliminar','title'=>'Eliminar')), 'sensores/delete?id='.$sensores->getId(), array('method' => 'delete', 'confirm' => '¿Estas seguro?')) ?>
              </td>
            </tr>
          <?php $i++; ?>
          <?php endforeach; ?>
        </tbody>

      </table>

    </div>

  </div>

</div>