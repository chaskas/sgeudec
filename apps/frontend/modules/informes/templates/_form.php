<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php use_helper('jQuery'); ?>
<?php use_javascript('jquery.validate.min.js'); ?>




<form action="<?php echo url_for('informes/informeCreate') ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?> id="informe_recinto">
  <label style="float:left;padding-right: 15px;">Recinto:
    <?php echo $form['recinto']->Render(array('class' => 'text-input large-input2')); ?>
  </label>
  <label style="float:left;padding-right: 15px;">Sistema Tarifario:
    <?php echo $form['tarifa']->Render(array('class' => 'text-input large-input2')); ?>
  </label>
  <label style="float:left;padding-right: 15px;">Mes:
    <?php echo $form['mes']->Render(array('class' => 'text-input large-input2')); ?>
  </label>
  <label style="float:left;padding-right: 15px;">Año:
    <?php echo $form['anno']->Render(array('class' => 'text-input large-input2')); ?>
  </label>
  <label style="float:left;padding-right: 15px;">
    <br/>
    <?php echo $form->RenderHiddenFields(); ?>
    <input type="submit" value="Ver Informe"/>
  </label>
  
</form>

<script type="text/javascript">

  $('document').ready(function(){

    $("#informe_recinto").validate();

  });

  function validateForm() {
    
    var $validator = $("#informe_recinto").validate({
      
      /*validation rules */
      rules: {
        energia_recinto: "required"
      },
      messages: {
        energia_recinto: ''
      },
      errorPlacement: function(error, element) {
        /* Error placement */
        error.insertBefore( element );
      }
    });
  }

</script>