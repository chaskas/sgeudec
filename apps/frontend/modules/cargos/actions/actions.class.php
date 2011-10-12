<?php

/**
 * cargos actions.
 *
 * @package    sgeudec
 * @subpackage cargos
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class cargosActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->cargoss = Doctrine_Core::getTable('Cargos')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->cargos = Doctrine_Core::getTable('Cargos')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->cargos);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new CargosForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new CargosForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($cargos = Doctrine_Core::getTable('Cargos')->find(array($request->getParameter('id'))), sprintf('Object cargos does not exist (%s).', $request->getParameter('id')));
    $this->form = new CargosForm($cargos);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($cargos = Doctrine_Core::getTable('Cargos')->find(array($request->getParameter('id'))), sprintf('Object cargos does not exist (%s).', $request->getParameter('id')));
    $this->form = new CargosForm($cargos);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($cargos = Doctrine_Core::getTable('Cargos')->find(array($request->getParameter('id'))), sprintf('Object cargos does not exist (%s).', $request->getParameter('id')));
    $cargos->delete();

    $this->redirect('cargos/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $cargos = $form->save();

      $this->redirect('cargos/edit?id='.$cargos->getId());
    }
  }
}
