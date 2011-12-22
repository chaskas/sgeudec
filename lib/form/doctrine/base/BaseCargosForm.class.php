<?php

/**
 * Cargos form base class.
 *
 * @method Cargos getObject() Returns the current form's model object
 *
 * @package    sgeudec
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCargosForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'nombre'      => new sfWidgetFormInputText(),
      'valor'       => new sfWidgetFormInputText(),
      'tarifa_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tarifas'), 'add_empty' => false)),
      'unidades_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Unidades'), 'add_empty' => false)),
      'codigo'      => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'nombre'      => new sfValidatorPass(),
      'valor'       => new sfValidatorNumber(),
      'tarifa_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Tarifas'))),
      'unidades_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Unidades'))),
      'codigo'      => new sfValidatorPass(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'Cargos', 'column' => array('codigo')))
    );

    $this->widgetSchema->setNameFormat('cargos[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Cargos';
  }

}
