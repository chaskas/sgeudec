<?php

/**
 * Ptomonit form.
 *
 * @package    sgeudec
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PtomonitForm extends BasePtomonitForm
{
  public function configure()
  {
    $this->widgetSchema->setLabels(array(
        'potenciaI' => 'Potencia Instalada (kW)'
    ));

    $this->widgetSchema['mapa'] = new sfWidgetFormInputFileEditable(array(
                'label' => 'Mapa',
                'file_src' => '/uploads/mapas/s_' . $this->getObject()->getMapa(),
                'is_image' => true,
                'edit_mode' => !$this->isNew(),
                'with_delete' => true,
                'delete_label' => 'Borrar',
                'template' => '%input%<br/><br/>%file%<br/><br/>%delete% %delete_label%',
            ));

    $this->validatorSchema['mapa'] = new sfValidatorFile(array(
                'path' => sfConfig::get('sf_upload_dir') . '/mapas',
                'required' => false,
                'mime_types' => 'web_images',
                'validated_file_class' => 'sfResizedFile'
            ));

    $this->validatorSchema['mapa_delete'] = new sfValidatorBoolean();
  }
}
