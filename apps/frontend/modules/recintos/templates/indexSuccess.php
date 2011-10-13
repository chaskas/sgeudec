<div class="content-box">

  <div class="content-box-header">

    <h3 style="cursor: s-resize; ">Recintos</h3>

    <ul class="content-box-tabs">
      <li><a href="<?php echo url_for('recintos/new') ?>" class="button">Nuevo recinto</a></li>
    </ul>

    <div class="clear"></div>

  </div>

  <div class="content-box-content">

    <div class="tab-content default-tab" id="tab1" style="display: block; ">

      <table class="listados">
        <thead>
          <tr>
            <th>Nombre</th>
            <th>Tarifa</th>
            <th>Opciones</th>
          </tr>
        </thead>

        <tbody>
          <?php foreach ($recintoss as $recintos): ?>
          <?php $i = 0; ?>
            <tr <?php if ($i % 2 != 0)echo "class='alt-row'"; ?>>
              <td><?php echo $recintos->getNombre() ?></td>
              <td><?php echo $recintos->getTarifas() ?></td>
              <td>
                <?php echo link_to(image_tag('icons/pencil.png',array('alt'=>'Editar','title'=>'Editar')), 'recintos/edit?id='.$recintos->getId()) ?>
                <?php echo link_to(image_tag('icons/cross.png',array('alt'=>'Eliminar','title'=>'Eliminar')), 'recintos/delete?id='.$recintos->getId(), array('method' => 'delete', 'confirm' => '¿Estas seguro?')) ?>
              </td>
            </tr>
          <?php $i++; ?>
          <?php endforeach; ?>
        </tbody>

      </table>

    </div>

  </div>

</div>