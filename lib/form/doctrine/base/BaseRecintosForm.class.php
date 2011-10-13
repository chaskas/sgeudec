<?php

/**
 * Recintos form base class.
 *
 * @method Recintos getObject() Returns the current form's model object
 *
 * @package    sgeudec
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseRecintosForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'        => new sfWidgetFormInputHidden(),
      'nombre'    => new sfWidgetFormInputText(),
      'tarifa_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tarifas'), 'add_empty' => false)),
      'mapa'      => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'        => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'nombre'    => new sfValidatorPass(),
      'tarifa_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Tarifas'))),
      'mapa'      => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('recintos[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Recintos';
  }

}
