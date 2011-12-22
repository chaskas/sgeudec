<?php use_stylesheets_for_form($anno) ?>
<?php use_javascripts_for_form($anno) ?>
<?php use_helper('jQuery'); ?>

<form method="post" <?php $anno->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
    <label style="float:left;">Año<span style="color:red;font-weight: normal;">(*)</span><br/>
        <?php echo $anno['anno']->Render(array('onchange' => jq_remote_function(array('update' => 'grafico', 'url' => 'potenciaMes/Anno', 'with' => " 'anno=' +this.value")), 'class' => 'text-input','style'=>'width:80px')); ?>
    </label>
    <?php $anno->RenderHiddenFields(); ?>
</form>
