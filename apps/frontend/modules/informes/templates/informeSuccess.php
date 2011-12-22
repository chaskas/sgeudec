<div class="content-box">

  <div class="content-box-header">

    <h3 style="cursor: s-resize; ">Informe de Facturaci&oacute;n</h3>
    <ul class="content-box-tabs">
      <li><a href="<?php echo url_for('informes/index'); ?>" class="button">Volver</a></li>
    </ul>
    <div class="clear"></div>

  </div>

  <div class="content-box-content">

    <div class="tab-content default-tab" id="tab1" style="display: block; ">

      <div class="clear"></div>

      <div>
        <h4>Datos del Recinto</h4>
        
        <table>
          <tbody>
            <tr>
              <td>Nombre:</td>
              <td><strong><?php echo $recinto->getNombre(); ?></strong></td>
            </tr>
            <tr>
              <td>Tarifa:</td>
              <td><strong><?php echo $tarifa->getNombre(); ?></strong></td>
            </tr>
          </tbody>
        </table>
        <hr/>
        <h4>Detalle del Consumo</h4>

        <table>
          <tbody>
            <tr>
              <td>Periodo de Consumo:</td>
              <td><strong><?php echo $mesLabel[$mes] . " " . $anno ?></strong></td>
            </tr>
            <tr>
              <td>Consumo de Energ&iacute;a:</td>
              <td><strong><?php echo number_format($consumoEnergia['sum'],2,',','.') ?></strong> kWh</td>
            </tr>
            <tr>
              <td>Demanda M&aacute;xima Le&iacute;da:</td>
              <td><strong><?php echo number_format($DemandaMaximaLeidaMes['maxpot'],2,',','.') ?></strong> kW</td>
            </tr>
          </tbody>
        </table>
        <hr/>
        <h4>Detalle de los Cargos</h4>
        <table>
          <thead>
            <tr>
              <th>&nbsp;</th>
              <th><strong>Unitario</strong></th>
              <th><strong>Neto</strong></th>
            </tr>
          </thead>
          <tbody>
          <?php $total = 0; ?>
          <?php foreach ($cargos as $cargo) : ?>
            <tr>
              <td><?php echo $cargo->getNombre(); ?></td>
              <td><strong><?php echo number_format($cargo->getValor(),2,',','.'); ?></strong> <?php echo $cargo->getUnidades(); ?></td>
              <td><strong><?php echo number_format($cargoResult[$cargo->getId()],2,',','.'); ?></strong> <?php echo $cargo->getUnidades(); ?></td>
            </tr>
          <?php $total += $cargoResult[$cargo->getId()]; ?>
          <?php endforeach; ?>
          </tbody>
        </table>
        <hr/>
        
        <table>
          <tr>
            <td>
              <h4>Total Estimado de la Facturaci&oacute;n</h4>
            </td>
            <td>
              <h4>$<?php echo number_format($total,2,',','.') ?></h4>
            </td>
          </tr>
        </table>
        
        
        
      </div>
    </div>

  </div>

</div>

