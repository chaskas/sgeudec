<?php

/**
 * unidades actions.
 *
 * @package    sgeudec
 * @subpackage unidades
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class unidadesActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->unidadess = Doctrine_Core::getTable('Unidades')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->unidades = Doctrine_Core::getTable('Unidades')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->unidades);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new UnidadesForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new UnidadesForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($unidades = Doctrine_Core::getTable('Unidades')->find(array($request->getParameter('id'))), sprintf('Object unidades does not exist (%s).', $request->getParameter('id')));
    $this->form = new UnidadesForm($unidades);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($unidades = Doctrine_Core::getTable('Unidades')->find(array($request->getParameter('id'))), sprintf('Object unidades does not exist (%s).', $request->getParameter('id')));
    $this->form = new UnidadesForm($unidades);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($unidades = Doctrine_Core::getTable('Unidades')->find(array($request->getParameter('id'))), sprintf('Object unidades does not exist (%s).', $request->getParameter('id')));
    $unidades->delete();

    $this->redirect('unidades/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $unidades = $form->save();

      $this->redirect('unidades/edit?id='.$unidades->getId());
    }
  }
}
