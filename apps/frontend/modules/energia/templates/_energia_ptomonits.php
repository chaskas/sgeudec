<?php use_stylesheets_for_form($ptomonits) ?>
<?php use_javascripts_for_form($ptomonits) ?>
<?php use_helper('jQuery'); ?>

<form method="post" <?php $ptomonits->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
    <label style="float:left;width:22%;">Puntos de Monitoreo<br/>
    <?php echo $ptomonits['ptomonit']->Render(array('onchange'=>jq_remote_function(array('update' => 'sensores','url' => 'energia/sensor','with'     => " 'ptomonit_id=' +this.value")),'class'=>'text-input large-input','onclick'=>'$("#sensores").show();')); ?>
    </label>
  <?php $ptomonits->RenderHiddenFields(); ?>
</form>

