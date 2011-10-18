<?php

/**
 * Registro filter form base class.
 *
 * @package    sgeudec
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseRegistroFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'potencia'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'registrado_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'sensor_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Sensores'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'potencia'      => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'registrado_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'sensor_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Sensores'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('registro_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Registro';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'potencia'      => 'Number',
      'registrado_at' => 'Date',
      'sensor_id'     => 'ForeignKey',
    );
  }
}
