<?php use_stylesheets_for_form($fecha) ?>
<?php use_javascripts_for_form($fecha) ?>
<?php use_stylesheet('south-street/jquery-ui-1.7.3.custom.css'); ?>
<?php use_javascript('jquery-ui-1.7.3.custom.min.js'); ?>
<?php use_javascript('jquery.ui.datepicker-es.js'); ?>
<?php use_helper('jQuery'); ?>

<script>
    $(function() {
        $( "#energia_fechaIni" ).datepicker({ dateFormat: 'dd/mm/yy' });
        $( "#energia_fechaFin" ).datepicker({ dateFormat: 'dd/mm/yy' });
    });
</script>

<form method="post" <?php $fecha->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
    <label style="float:left;">Inicio<span style="color:red;font-weight: normal;">(*)</span><br/>
        <?php echo $fecha['fechaIni']->Render(array('onchange' => jq_remote_function(array('update' => 'grafico', 'url' => 'potenciaPeriodo/graficoFecha', 'with' => " 'fechaIni=' +this.value")), 'class' => 'text-input','style'=>'width:80px')); ?>
    </label>
    <label style="float:left;">Fin <span style="color:red;font-weight: normal;">(*)</span><br/>
        <?php echo $fecha['fechaFin']->Render(array('onchange' => jq_remote_function(array('update' => 'grafico', 'url' => 'potenciaPeriodo/graficoFecha', 'with' => " 'fechaFin=' +this.value")), 'class' => 'text-input','style'=>'width:80px')); ?>
    </label>
    <?php $fecha->RenderHiddenFields(); ?>
</form>
