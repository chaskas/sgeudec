<?php use_stylesheets_for_form($recintos) ?>
<?php use_javascripts_for_form($recintos) ?>
<?php use_helper('jQuery'); ?>

<form method="post" <?php $recintos->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
    <label style="float:left;width:22%;">Recintos<br/>
    <?php echo $recintos['recinto']->Render(array('onchange'=>jq_remote_function(array('update' => 'ptomonits','url' => 'energia/ptomonit','with'     => " 'recinto_id=' +this.value")),'class'=>'text-input large-input','onclick'=>'$("#sensores").hide();')); ?>
    </label>
  <?php $recintos->RenderHiddenFields(); ?>
</form>
