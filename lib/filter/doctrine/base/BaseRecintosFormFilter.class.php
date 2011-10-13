<?php

/**
 * Recintos filter form base class.
 *
 * @package    sgeudec
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseRecintosFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'nombre'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'tarifa_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tarifas'), 'add_empty' => true)),
      'mapa'      => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'nombre'    => new sfValidatorPass(array('required' => false)),
      'tarifa_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Tarifas'), 'column' => 'id')),
      'mapa'      => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('recintos_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Recintos';
  }

  public function getFields()
  {
    return array(
      'id'        => 'Number',
      'nombre'    => 'Text',
      'tarifa_id' => 'ForeignKey',
      'mapa'      => 'Text',
    );
  }
}
