<?php

/**
 * Ptomonit form base class.
 *
 * @method Ptomonit getObject() Returns the current form's model object
 *
 * @package    sgeudec
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePtomonitForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'nombre'     => new sfWidgetFormInputText(),
      'ubicacion'  => new sfWidgetFormInputText(),
      'potenciaI'  => new sfWidgetFormInputText(),
      'mapa'       => new sfWidgetFormInputText(),
      'recinto_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Recintos'), 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'nombre'     => new sfValidatorPass(),
      'ubicacion'  => new sfValidatorPass(),
      'potenciaI'  => new sfValidatorNumber(),
      'mapa'       => new sfValidatorPass(array('required' => false)),
      'recinto_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Recintos'))),
    ));

    $this->widgetSchema->setNameFormat('ptomonit[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Ptomonit';
  }

}
