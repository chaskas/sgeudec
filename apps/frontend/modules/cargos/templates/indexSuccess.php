<div class="content-box">

  <div class="content-box-header">

    <h3 style="cursor: s-resize; ">Cargos</h3>

    <ul class="content-box-tabs">
      <li><a href="<?php echo url_for('cargos/new') ?>" class="button">Nuevo cargo</a></li>
    </ul>

    <div class="clear"></div>

  </div> <!-- End .content-box-header -->

  <div class="content-box-content">

    <div class="tab-content default-tab" id="tab1" style="display: block; ">

      <table class="listados">
        <thead>
          <tr>
            <th>Tarifa</th>
            <th>Nombre</th>
            <th>Valor</th>
            <th>Unidad</th>
            <th>Opciones</th>
          </tr>
        </thead>

        <tbody>
          <?php foreach ($cargoss as $cargos): ?>
          <?php $i = 0; ?>
            <tr <?php if ($i % 2 != 0)echo "class='alt-row'"; ?>>
              <td><?php echo $cargos->getTarifas() ?></td>
              <td><?php echo $cargos->getNombre() ?></td>
              <td><?php echo $cargos->getValor() ?></td>
              <td><?php echo $cargos->getUnidades() ?></td>
              <td>
                <?php echo link_to(image_tag('icons/pencil.png',array('alt'=>'Editar','title'=>'Editar')), 'cargos/edit?id='.$cargos->getId()) ?>
                <?php echo link_to(image_tag('icons/cross.png',array('alt'=>'Eliminar','title'=>'Eliminar')), 'cargos/delete?id='.$cargos->getId(), array('method' => 'delete', 'confirm' => '¿Estas seguro?')) ?>
              </td>
            </tr>
          <?php $i++; ?>
          <?php endforeach; ?>
        </tbody>

      </table>

    </div>
  </div>

</div>