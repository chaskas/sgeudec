<div class="content-box">

  <div class="content-box-header">

    <h3 style="cursor: s-resize; ">Registros</h3>

    <ul class="content-box-tabs">
      <li><a href="<?php echo url_for('registro/new') ?>" class="button">Nuevo registro</a></li>
    </ul>

    <div class="clear"></div>

  </div>

  <div class="content-box-content">

    <div class="tab-content default-tab" id="tab1" style="display: block; ">

      <table class="listados">
        <thead>
          <tr>
            <th>Registrado a las:</th>
            <th>Potencia</th>
            <th>Sensor</th>
            <th>opciones</th>
          </tr>
        </thead>

        <tbody>
          <?php foreach ($pager->getResults() as $registro): ?>
          <?php $i = 0; ?>
            <tr <?php if ($i % 2 != 0)echo "class='alt-row'"; ?>>
              <td><?php echo $registro->getRegistradoAt() ?></td>
              <td><?php echo $registro->getPotencia() ?></td>
              <td><?php echo $registro->getSensores() ?></td>
              <td>
                <?php echo link_to(image_tag('icons/pencil.png', array('alt' => 'Editar', 'title' => 'Editar')), 'registro/edit?id=' . $registro->getId()) ?>
                <?php echo link_to(image_tag('icons/cross.png', array('alt' => 'Eliminar', 'title' => 'Eliminar')), 'registro/delete?id=' . $registro->getId(), array('method' => 'delete', 'confirm' => '¿Estas seguro?')) ?>
              </td>
            </tr>
          <?php $i++; ?>
          <?php endforeach; ?>
        </tbody>

        <?php if ($pager->haveToPaginate()): ?>
        <tfoot>
          <tr>
            <td colspan="4">
              <div class="pagination">
                <?php echo link_to('« Primera', 'registro/index?page='.$pager->getFirstPage()) ?>
                <?php echo link_to('« Anterior', 'registro/index?page='.$pager->getPreviousPage()) ?>

                <?php $links = $pager->getLinks(); ?>

                <?php foreach ($pager->getLinks() as $page): ?>
                  <?php if ($page == $pager->getPage()): ?>
                    <a href="<?php echo url_for('registro/index') ?>?page=<?php echo $page ?>" class="number current"><?php echo $page ?></a>
                  <?php else: ?>
                    <a href="<?php echo url_for('registro/index') ?>?page=<?php echo $page ?>" class="number"><?php echo $page ?></a>
                  <?php endif; ?>
                <?php endforeach; ?>

                <?php echo link_to('Siguiente »', 'registro/index?page='.$pager->getNextPage()) ?>
                <?php echo link_to('Siguiente »', 'registro/index?page='.$pager->getLastPage()) ?>
              </div>
              <div class="clear"></div>
            </td>
          </tr>
        </tfoot>
        <?php endif ?>

      </table>

    </div>

  </div>

</div>