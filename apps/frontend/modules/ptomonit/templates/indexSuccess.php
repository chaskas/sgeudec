<div class="content-box">

  <div class="content-box-header">

    <h3 style="cursor: s-resize; ">Puntos de monitoreo</h3>

    <ul class="content-box-tabs">
      <li><a href="<?php echo url_for('ptomonit/new') ?>" class="button">Nuevo Pto. monitoreo</a></li>
    </ul>

    <div class="clear"></div>

  </div>

  <div class="content-box-content">

    <div class="tab-content default-tab" id="tab1" style="display: block; ">

      <table class="listados">
        <thead>
          <tr>
            <th>Recinto</th>
            <th>Nombre</th>
            <th>Potencia instalada</th>
            <th>Opciones</th>
          </tr>
        </thead>

        <tbody>
          <?php foreach ($pto_monits as $pto_monit): ?>
          <?php $i = 0; ?>
            <tr <?php if ($i % 2 != 0)echo "class='alt-row'"; ?>>
              <td><?php echo $pto_monit->getRecintos() ?></td>
              <td><?php echo $pto_monit->getNombre() ?></td>
              <td><?php echo $pto_monit->getPotenciaI() ?></td>
              <td>
                <?php echo link_to(image_tag('icons/pencil.png',array('alt'=>'Editar','title'=>'Editar')), 'ptomonit/edit?id='.$pto_monit->getId()) ?>
                <?php echo link_to(image_tag('icons/cross.png',array('alt'=>'Eliminar','title'=>'Eliminar')), 'ptomonit/delete?id='.$pto_monit->getId(), array('method' => 'delete', 'confirm' => '¿Estas seguro?')) ?>
              </td>
            </tr>
          <?php $i++; ?>
          <?php endforeach; ?>
        </tbody>

      </table>

    </div>

  </div>

</div>