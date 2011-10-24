<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<form action="<?php echo url_for('sensores/uploadCreate') ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
  <p>
    <label>
      Archivo CSV:
      <br/><br/>
      <?php echo $form['file']->render(array('class' => 'text-input large-input')); ?>
      <?php echo $form['file']->renderError(); ?>
    </label>
  </p>
  <div style="clear: both;"></div>
  <?php echo $form->renderHiddenFields(); ?>
  <label style="text-align: right;">
    <input type="submit" value="Siguiente" class="button"/>
  </label>
</form>