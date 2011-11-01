<?php use_stylesheets_for_form($fecha) ?>
<?php use_javascripts_for_form($fecha) ?>
<?php use_stylesheet('south-street/jquery-ui-1.7.3.custom.css'); ?>
<?php use_javascript('jquery-ui-1.7.3.custom.min.js'); ?>
<?php use_javascript('jquery.ui.datepicker-es.js'); ?>
<?php use_helper('jQuery'); ?>

<form method="post" <?php $fecha->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
  <label style="float:left;">Fecha <span style="color:red;font-weight: normal;">(*)</span><br/>
    <?php echo $fecha['fecha']->Render(array('onchange'=>jq_remote_function(array('update' => 'grafico','url' => 'energia/graficoDia','with'     => " 'fecha=' +this.value")),'class'=>'text-input','style'=>'z-index:99999 !important;')); ?>
    </label>
  <?php $fecha->RenderHiddenFields(); ?>
</form>
