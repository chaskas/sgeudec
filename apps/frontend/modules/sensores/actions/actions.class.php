<?php

/**
 * sensores actions.
 *
 * @package    sgeudec
 * @subpackage sensores
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class sensoresActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->sensoress = Doctrine_Core::getTable('Sensores')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->sensores = Doctrine_Core::getTable('Sensores')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->sensores);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new SensoresForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new SensoresForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($sensores = Doctrine_Core::getTable('Sensores')->find(array($request->getParameter('id'))), sprintf('Object sensores does not exist (%s).', $request->getParameter('id')));
    $this->form = new SensoresForm($sensores);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($sensores = Doctrine_Core::getTable('Sensores')->find(array($request->getParameter('id'))), sprintf('Object sensores does not exist (%s).', $request->getParameter('id')));
    $this->form = new SensoresForm($sensores);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($sensores = Doctrine_Core::getTable('Sensores')->find(array($request->getParameter('id'))), sprintf('Object sensores does not exist (%s).', $request->getParameter('id')));
    $sensores->delete();

    $this->redirect('sensores/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $sensores = $form->save();

      $this->redirect('sensores/edit?id='.$sensores->getId());
    }
  }
}
