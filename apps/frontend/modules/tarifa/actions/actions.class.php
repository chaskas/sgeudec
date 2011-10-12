<?php

/**
 * tarifa actions.
 *
 * @package    sgeudec
 * @subpackage tarifa
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class tarifaActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->tarifass = Doctrine_Core::getTable('Tarifas')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->tarifas = Doctrine_Core::getTable('Tarifas')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->tarifas);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new TarifasForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new TarifasForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($tarifas = Doctrine_Core::getTable('Tarifas')->find(array($request->getParameter('id'))), sprintf('Object tarifas does not exist (%s).', $request->getParameter('id')));
    $this->form = new TarifasForm($tarifas);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($tarifas = Doctrine_Core::getTable('Tarifas')->find(array($request->getParameter('id'))), sprintf('Object tarifas does not exist (%s).', $request->getParameter('id')));
    $this->form = new TarifasForm($tarifas);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($tarifas = Doctrine_Core::getTable('Tarifas')->find(array($request->getParameter('id'))), sprintf('Object tarifas does not exist (%s).', $request->getParameter('id')));
    $tarifas->delete();

    $this->redirect('tarifa/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $tarifas = $form->save();

      $this->redirect('tarifa/edit?id='.$tarifas->getId());
    }
  }
}
