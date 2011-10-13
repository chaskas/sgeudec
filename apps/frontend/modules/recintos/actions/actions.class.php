<?php

/**
 * recintos actions.
 *
 * @package    sgeudec
 * @subpackage recintos
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class recintosActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->recintoss = Doctrine_Core::getTable('Recintos')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->recintos = Doctrine_Core::getTable('Recintos')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->recintos);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new RecintosForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new RecintosForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($recintos = Doctrine_Core::getTable('Recintos')->find(array($request->getParameter('id'))), sprintf('Object recintos does not exist (%s).', $request->getParameter('id')));
    $this->form = new RecintosForm($recintos);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($recintos = Doctrine_Core::getTable('Recintos')->find(array($request->getParameter('id'))), sprintf('Object recintos does not exist (%s).', $request->getParameter('id')));
    $this->form = new RecintosForm($recintos);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($recintos = Doctrine_Core::getTable('Recintos')->find(array($request->getParameter('id'))), sprintf('Object recintos does not exist (%s).', $request->getParameter('id')));
    $recintos->delete();

    $this->redirect('recintos/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $recintos = $form->save();

      $this->redirect('recintos/edit?id='.$recintos->getId());
    }
  }
}
