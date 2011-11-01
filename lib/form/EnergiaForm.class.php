<?php
class EnergiaRecintoForm extends sfForm {

  public function configure() {

    $this->widgetSchema['recinto'] = new sfWidgetFormDoctrineChoice(array('model' => 'Recintos','table_method'=>'getRecintos','add_empty'=>'Seleccione'));

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
    $this->widgetSchema->setNameFormat('energia[%s]');
    $this->widgetSchema->setFormFormatterName('list');

  }

}

class EnergiaPtomonitForm extends sfForm {

  public function configure() {
    
    $this->widgetSchema['ptomonit'] = new sfWidgetFormDoctrineChoice(array('model' => 'Ptomonit','table_method'=>'getPtomonits','add_empty'=>'Seleccione'));

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
    $this->widgetSchema->setNameFormat('energia[%s]');
    $this->widgetSchema->setFormFormatterName('list');

  }

}

class EnergiaSensorForm extends sfForm {

  public function configure() {
    
    $this->widgetSchema['sensor'] = new sfWidgetFormDoctrineChoice(array('model' => 'Sensores','table_method'=>'getSensores','add_empty'=>'Seleccione'));

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
    $this->widgetSchema->setNameFormat('energia[%s]');
    $this->widgetSchema->setFormFormatterName('list');

  }

}

class EnergiaFechaForm extends sfForm {

  public function configure() {
      
    $this->widgetSchema['fecha']= new sfWidgetFormInput();

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
    $this->widgetSchema->setNameFormat('energia[%s]');
    $this->widgetSchema->setFormFormatterName('list');

  }

}

?>
