<?php

/**
 * sensores actions.
 *
 * @package    sgeudec
 * @subpackage sensores
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class sensoresActions extends sfActions {

  public function executeIndex(sfWebRequest $request) {
    $this->sensoress = Doctrine_Core::getTable('Sensores')
            ->createQuery('a')
            ->execute();
  }

  public function executeShow(sfWebRequest $request) {
    $this->sensores = Doctrine_Core::getTable('Sensores')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->sensores);
  }

  public function executeNew(sfWebRequest $request) {
    $this->form = new SensoresForm();
  }

  public function executeCreate(sfWebRequest $request) {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new SensoresForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request) {
    $this->forward404Unless($sensores = Doctrine_Core::getTable('Sensores')->find(array($request->getParameter('id'))), sprintf('Object sensores does not exist (%s).', $request->getParameter('id')));
    $this->form = new SensoresForm($sensores);
  }

  public function executeUpdate(sfWebRequest $request) {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($sensores = Doctrine_Core::getTable('Sensores')->find(array($request->getParameter('id'))), sprintf('Object sensores does not exist (%s).', $request->getParameter('id')));
    $this->form = new SensoresForm($sensores);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request) {
    $request->checkCSRFProtection();

    $this->forward404Unless($sensores = Doctrine_Core::getTable('Sensores')->find(array($request->getParameter('id'))), sprintf('Object sensores does not exist (%s).', $request->getParameter('id')));
    $sensores->delete();

    $this->redirect('sensores/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form) {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid()) {
      $sensores = $form->save();

      $this->redirect('sensores/edit?id=' . $sensores->getId());
    }
  }

  public function executeUpload(sfWebRequest $request){
    $this->getUser()->setAttribute('sensor_id', $request->getParameter('id'));
    $this->form = new UploadRegistroForm();
  }
  public function executeUploadCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));
    $this->form = new UploadRegistroForm();
    $this->processUpload($request, $this->form);
    $this->setTemplate('upload');
  }
  protected function processUpload(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));

    if ($form->isValid())
    {
      $sensor_id = sfContext::getInstance()->getUser()->getAttribute('sensor_id');

      //procesar el archivo
      $file = $this->form->getValue('file');
      $filename = 'sensor_'.$sensor_id.'_'.$file->getOriginalName();
      //$fileext  = $file->getExtension($file->getOriginalExtension());
      $file->save(sfConfig::get('sf_upload_dir').'/datos/'.$filename);
      $this->processAddToSensor($filename,$sensor_id);
      $this->redirect('sensores/ok');
    }
  }
  public function executeOk(sfWebRequest $request)
  {

  }
  protected function processAddToSensor($sensor_filename,$sensor_id) {
    
    if (($handle = fopen("http://".$_SERVER['HTTP_HOST']."/uploads/datos/".$sensor_filename, "r")) !== FALSE) {
      while (($data = fgetcsv($handle, 0, ";")) !== FALSE) {
        $registro = new Registro();
        $registro->setPotencia($data[1]);
        $registro->setRegistradoAt($data[0]);
        //$registro->setSensorId($sensor_id);
        $registro->setSensorId($sensor_id);
        $registro->save();
      }
      fclose($handle);
    }
  }

}
