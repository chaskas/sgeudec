<div class="content-box"><!-- Start Content Box -->

  <div class="content-box-header">

    <h3 style="cursor: s-resize; ">Consumo de Energ&iacute;a</h3>

    <div class="clear"></div>

  </div>

  <div class="content-box-content">

    <div class="tab-content default-tab" id="tab1" style="display: block; ">
      <div id="recintos"><?php include_partial('energia_recintos', array('recintos' => $recintos)) ?></div>
      <div id="ptomonits"></div>
      <div id="sensores"></div>
      <div id="fecha"><?php include_partial('energia_fecha', array('fecha' => $fecha)) ?></div>
      <div style="clear:both;"></div>
    </div>

  </div>

</div>
