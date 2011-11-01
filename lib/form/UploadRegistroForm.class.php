<?php

class UploadRegistroForm extends sfForm {

  public function configure() {
    $this->widgetSchema['file'] = new sfWidgetFormInputFile();

    $this->validatorSchema['file'] = new sfValidatorFile(array(
                'path' => sfConfig::get('sf_upload_dir') . '/datos',
                'required' => true,
                'mime_types' => array('text/plain'),
            ));

//    $this->validatorSchema['file'] = new sfValidatorString();
    
    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
    $this->widgetSchema->setNameFormat('upload[%s]');
    $this->widgetSchema->setFormFormatterName('list');

  }

}
