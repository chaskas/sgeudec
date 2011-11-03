<?php use_stylesheets_for_form($sensores) ?>
<?php use_javascripts_for_form($sensores) ?>
<?php use_helper('jQuery'); ?>

<form method="post" <?php $sensores->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
    <label style="float:left;width:22%;">Sensor<br/>
    <?php echo $sensores['sensor']->Render(array('onchange'=>jq_remote_function(array('update' => 'grafico','url' => 'energiaDia/grafico','with'     => " 'sensor_id=' +this.value")),'class'=>'text-input large-input2')); ?>
    </label>
  <?php $sensores->RenderHiddenFields(); ?>
</form>

