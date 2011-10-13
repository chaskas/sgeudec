<?php

/**
 * Ptomonit filter form base class.
 *
 * @package    sgeudec
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePtomonitFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'nombre'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ubicacion'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'potenciaI'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'mapa'       => new sfWidgetFormFilterInput(),
      'recinto_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Recintos'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'nombre'     => new sfValidatorPass(array('required' => false)),
      'ubicacion'  => new sfValidatorPass(array('required' => false)),
      'potenciaI'  => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'mapa'       => new sfValidatorPass(array('required' => false)),
      'recinto_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Recintos'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('ptomonit_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Ptomonit';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'nombre'     => 'Text',
      'ubicacion'  => 'Text',
      'potenciaI'  => 'Number',
      'mapa'       => 'Text',
      'recinto_id' => 'ForeignKey',
    );
  }
}
