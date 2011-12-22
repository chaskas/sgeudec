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

class EnergiaFechaPeriodoForm extends sfForm {

  public function configure() {
      
    $this->widgetSchema['fechaIni']= new sfWidgetFormInput();
    $this->widgetSchema['fechaFin']= new sfWidgetFormInput();

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
    $this->widgetSchema->setNameFormat('energia[%s]');
    $this->widgetSchema->setFormFormatterName('list');

  }

}

class InformeForm extends sfForm {

  public function configure() {

    $this->widgetSchema['recinto'] = new sfWidgetFormDoctrineChoice(array('model' => 'Recintos','table_method'=>'getRecintos','add_empty'=>true));

    $this->widgetSchema['tarifa'] = new sfWidgetFormDoctrineChoice(array('model' => 'Tarifas','table_method'=>'getTarifas','add_empty'=>true));
    
    $years = range(date('Y') - 6, date('Y'));
    $yearsSin0 = array_combine($years, $years);
    $years = $yearsSin0;
    array_unshift($years,'');

    $mes = array(
          '00' => ' ',
          '01' => 'Enero', 
          '02' => 'Febrero', 
          '03' => 'Marzo', 
          '04' => 'Abril', 
          '05' => 'Mayo', 
          '06' => 'Junio', 
          '07' => 'Julio', 
          '08' => 'Agosto', 
          '09' => 'Septiembre', 
          '10' => 'Octubre', 
          '11' => 'Noviembre', 
          '12' => 'Diciembre'
          );
    $mesSin0 = $mes;
    unset($mesSin0["00"]);

    $this->widgetSchema['mes'] = new sfWidgetFormChoice(array(
      'choices' => $mes
    ));
    
    $this->widgetSchema['anno'] = new sfWidgetFormChoice(array(
      'choices' => array_combine($years, $years)
    ));

    $this->validatorSchema['recinto'] = new sfValidatorString(array('required'=>true));
    $this->validatorSchema['tarifa']  = new sfValidatorString(array('required'=>true));
    $this->validatorSchema['anno']    = new sfValidatorChoice(array('choices' => array_keys($yearsSin0)));
    $this->validatorSchema['mes']     = new sfValidatorChoice(array('choices' => array_keys($mesSin0)));
    
    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
    $this->widgetSchema->setNameFormat('informe[%s]');
    $this->widgetSchema->setFormFormatterName('list');

  }

}

class AnnoForm extends sfForm {

  public function configure() {

    
    $years = range(date('Y') - 6, date('Y'));
    $yearsSin0 = array_combine($years, $years);
    $years = $yearsSin0;
    array_unshift($years,'');
    
    $this->widgetSchema['anno'] = new sfWidgetFormChoice(array(
      'choices' => array_combine($years, $years)
    ));

    $this->validatorSchema['anno']    = new sfValidatorChoice(array('choices' => array_keys($yearsSin0)));
   
    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
    $this->widgetSchema->setNameFormat('energia[%s]');
    $this->widgetSchema->setFormFormatterName('list');

  }

}

?>
