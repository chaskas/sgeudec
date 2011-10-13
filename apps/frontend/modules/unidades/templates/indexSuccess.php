<div class="content-box">

  <div class="content-box-header">

    <h3 style="cursor: s-resize; ">Unidades</h3>

    <ul class="content-box-tabs">
      <li><a href="<?php echo url_for('unidades/new') ?>" class="button">Nueva unidad</a></li>
    </ul>

    <div class="clear"></div>

  </div>

  <div class="content-box-content">

    <div class="tab-content default-tab" id="tab1" style="display: block; ">

      <table class="listados">
        <thead>
          <tr>
            <th>Unidad</th>
            <th>Opciones</th>
          </tr>
        </thead>

        <tbody>
          <?php foreach ($unidadess as $unidades): ?>
          <?php $i = 0; ?>
            <tr <?php if ($i % 2 != 0)echo "class='alt-row'"; ?>>
              <td><?php echo $unidades->getUnidad() ?></td>
              <td>
                <?php echo link_to(image_tag('icons/pencil.png',array('alt'=>'Editar','title'=>'Editar')), 'unidades/edit?id='.$unidades->getId()) ?>
                <?php echo link_to(image_tag('icons/cross.png',array('alt'=>'Eliminar','title'=>'Eliminar')), 'unidades/delete?id='.$unidades->getId(), array('method' => 'delete', 'confirm' => '¿Estas seguro?')) ?>
              </td>
            </tr>
          <?php $i++; ?>
          <?php endforeach; ?>
        </tbody>

      </table>

    </div>

  </div>

</div>