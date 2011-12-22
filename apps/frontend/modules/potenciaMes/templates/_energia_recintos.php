<?php use_stylesheets_for_form($recintos) ?>
<?php use_javascripts_for_form($recintos) ?>
<?php use_helper('jQuery'); ?>

<form method="post" <?php $recintos->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
    <label style="float:left;padding-right: 15px;">Recintos <span style="color:red;font-weight: normal;">(*)</span><br/>
    <?php echo $recintos['recinto']->Render(array('onchange'=>jq_remote_function(array('update' => 'ptomonits','url' => 'potenciaMes/ptomonit','with'     => " 'recinto_id=' +this.value")),'class'=>'text-input large-input2')); ?>
    </label>
  <?php $recintos->RenderHiddenFields(); ?>
</form>

