<?php

/**
 * energia actions.
 *
 * @package    sgeudec
 * @subpackage energia
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class energiaActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->recintos = new EnergiaRecintoForm();
    $this->ptomonits = new EnergiaPtomonitForm();
  }
  public function executePtomonit(sfWebRequest $request)
  {
    $this->getUser()->setAttribute('recinto_id',$request->getParameter('recinto_id'));
    $this->ptomonits = new EnergiaPtomonitForm();
  }
  public function executeSensor(sfWebRequest $request)
  {
    $this->getUser()->setAttribute('ptomonit_id',$request->getParameter('ptomonit_id'));
    $this->sensores = new EnergiaSensorForm();
  }
}
