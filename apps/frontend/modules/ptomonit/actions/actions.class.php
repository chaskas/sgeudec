<?php

/**
 * ptomonit actions.
 *
 * @package    sgeudec
 * @subpackage ptomonit
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ptomonitActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->pto_monits = Doctrine_Core::getTable('PtoMonit')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->pto_monit = Doctrine_Core::getTable('PtoMonit')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->pto_monit);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new PtoMonitForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new PtoMonitForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($pto_monit = Doctrine_Core::getTable('PtoMonit')->find(array($request->getParameter('id'))), sprintf('Object pto_monit does not exist (%s).', $request->getParameter('id')));
    $this->form = new PtoMonitForm($pto_monit);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($pto_monit = Doctrine_Core::getTable('PtoMonit')->find(array($request->getParameter('id'))), sprintf('Object pto_monit does not exist (%s).', $request->getParameter('id')));
    $this->form = new PtoMonitForm($pto_monit);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($pto_monit = Doctrine_Core::getTable('PtoMonit')->find(array($request->getParameter('id'))), sprintf('Object pto_monit does not exist (%s).', $request->getParameter('id')));
    $pto_monit->delete();

    $this->redirect('ptomonit/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $pto_monit = $form->save();

      $this->redirect('ptomonit/edit?id='.$pto_monit->getId());
    }
  }
}
