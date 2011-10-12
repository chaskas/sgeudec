<?php

/**
 * Cargos filter form base class.
 *
 * @package    sgeudec
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCargosFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'nombre' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'valor'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'unidad' => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'nombre' => new sfValidatorPass(array('required' => false)),
      'valor'  => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'unidad' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('cargos_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Cargos';
  }

  public function getFields()
  {
    return array(
      'id'     => 'Number',
      'nombre' => 'Text',
      'valor'  => 'Number',
      'unidad' => 'Text',
    );
  }
}
