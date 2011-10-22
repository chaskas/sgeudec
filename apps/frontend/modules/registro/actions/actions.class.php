<?php

/**
 * registro actions.
 *
 * @package    sgeudec
 * @subpackage registro
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class registroActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->pager = new sfDoctrinePager('registro', sfConfig::get('app_max_registros_on_index'));
    $this->pager->setQuery(Doctrine::getTable('Registro')->createQuery('a'));
    $this->pager->setPage($request->getParameter('page', 1));
    $this->pager->init();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->registro = Doctrine_Core::getTable('Registro')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->registro);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new RegistroForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new RegistroForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($registro = Doctrine_Core::getTable('Registro')->find(array($request->getParameter('id'))), sprintf('Object registro does not exist (%s).', $request->getParameter('id')));
    $this->form = new RegistroForm($registro);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($registro = Doctrine_Core::getTable('Registro')->find(array($request->getParameter('id'))), sprintf('Object registro does not exist (%s).', $request->getParameter('id')));
    $this->form = new RegistroForm($registro);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($registro = Doctrine_Core::getTable('Registro')->find(array($request->getParameter('id'))), sprintf('Object registro does not exist (%s).', $request->getParameter('id')));
    $registro->delete();

    $this->redirect('registro/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $registro = $form->save();

      $this->redirect('registro/edit?id='.$registro->getId());
    }
  }
}
