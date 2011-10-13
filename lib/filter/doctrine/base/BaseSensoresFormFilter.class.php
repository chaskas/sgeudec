<?php

/**
 * Sensores filter form base class.
 *
 * @package    sgeudec
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseSensoresFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'identificador' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ubicacion'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ptomonit_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Ptomonit'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'identificador' => new sfValidatorPass(array('required' => false)),
      'ubicacion'     => new sfValidatorPass(array('required' => false)),
      'ptomonit_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Ptomonit'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('sensores_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Sensores';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'identificador' => 'Text',
      'ubicacion'     => 'Text',
      'ptomonit_id'   => 'ForeignKey',
    );
  }
}
