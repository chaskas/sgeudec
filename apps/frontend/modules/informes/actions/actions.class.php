<?php

/**
 * informes actions.
 *
 * @package    sgeudec
 * @subpackage informes
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class informesActions extends sfActions {

  /**
   * Executes index action
   *
   * @param sfRequest $request A request object
   */
  public function executeIndex(sfWebRequest $request) {

    $this->form = new InformeForm();

  }

  public function executeInformeCreate(sfWebRequest $request) {
    $this->forward404Unless($request->isMethod(sfRequest::POST));
    $this->form = new InformeForm();
    $this->processInforme($request, $this->form);
    $this->setTemplate('index');
  }

  protected function processInforme(sfWebRequest $request, sfForm $form) {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid()) {

      $this->getUser()->setAttribute('mes', $form->getValue('mes'));
      $this->getUser()->setAttribute('anno', $form->getValue('anno'));
      $this->getUser()->setAttribute('tarifaid', $form->getValue('tarifa'));
      $this->getUser()->setAttribute('recintoid', $form->getValue('recinto'));

      $this->redirect('informes/informe');
    }
  }

  public function executeInforme(sfWebRequest $request) {
    $this->mesLabel = Array('01'=>'Enero','02'=>'Febrero','03'=>'Marzo','04'=>'Abril','05'=>'Mayo','06'=>'Junio','07'=>'Julio','08'=>'Agosto','09'=>'Septiembre','10'=>'Octubre','11'=>'Noviembre','12'=>'Diciembre');

    $this->recintoid  = $this->getUser()->getAttribute('recintoid');
    $this->tarifaid   = $this->getUser()->getAttribute('tarifaid');
    $this->mes        = $this->getUser()->getAttribute('mes');
    $this->anno       = $this->getUser()->getAttribute('anno');
    
    $this->recinto = Doctrine::getTable('Recintos')
            ->findOneBy('id',$this->recintoid);
    
    $this->tarifa = Doctrine::getTable('Tarifas')
            ->findOneBy('id',$this->tarifaid);
    
    $this->cargos = Doctrine_Core::getTable('Cargos')
            ->createQuery('a')
            ->Where('tarifa_id = ?', $this->tarifaid)
            ->execute();

    $q = Doctrine_Query::create()
            ->select('sum(potencia*15/60)')
            ->from('Registro')
            ->where('registrado_at between ? and ?', array($this->anno . '-' . $this->mes . '-01 00:00:00', $this->anno . '-' . $this->mes . '-31 23:59:59'));
    $this->consumoEnergia = $q->fetchOne();
    
    $q1 = Doctrine_Query::create()
                  ->select('sum(potencia) AS maxpot')
                  ->from('Registro')
                  ->groupBy('registrado_at')
                  ->having("registrado_at like '".$this->anno."-".$this->mes."%'");
          
          //$q1->execute();
    $this->maxpots = $q1->fetchArray();

    $this->DemandaMaximaLeidaMes = max($this->maxpots);
    
    $this->cargoResult = Array();
    if ($this->tarifaid == 11) {
      //Tarifa AT43
      foreach($this->cargos as $cargo) {
        if($cargo->getCodigo() == 'AT431'){
          $this->cargoResult[$cargo->getId()] = $cargo->getValor();
        }
        else if ($cargo->getCodigo() == 'AT432'){
          $this->cargoResult[$cargo->getId()] = $cargo->getValor()*$this->consumoEnergia["sum"];
        }
        else if ($cargo->getCodigo() == 'AT433'){
          $this->cargoResult[$cargo->getId()] = $cargo->getValor()*$this->consumoEnergia["sum"];
        }
        else if ($cargo->getCodigo() == 'AT434'){ //Promedio de las 2 mas altas
          
          $q1 = Doctrine_Query::create()
                  ->select('sum(potencia) AS maxpot')
                  ->from('Registro')
                  ->groupBy('registrado_at')
                  ->having("registrado_at like '".$this->anno."-%'");
          
          $this->maxpots = $q1->fetchArray();
          
          rsort($this->maxpots);
          
          $this->promMaxPot = ($this->maxpots[0]['maxpot']+$this->maxpots[1]['maxpot'])/2;
          
          //print_r($this->maxpots);
          
          $this->cargoResult[$cargo->getId()] = $cargo->getValor()*$this->promMaxPot;
        }
        else if ($cargo->getCodigo() == 'AT435'){ //Demanda maxima leida del mes entre las 18:00 y 22:59
          
          $q1 = Doctrine_Query::create()
                  ->select('sum(potencia) AS maxpot')
                  ->from('Registro')
                  ->where('registrado_at between ? and ?', array($this->anno . '-' . $this->mes . '-01 00:18:00', $this->anno . '-' . $this->mes . '-31 22:59:59'))
                  ->groupBy('registrado_at')
                  ->having("registrado_at like '".$this->anno."-".$this->mes."%'");
          
          //$q1->execute();
          $this->maxpots = $q1->fetchArray();
          
          $this->maxpotHoraPunta = max($this->maxpots);
          
          $this->cargoResult[$cargo->getId()] = $cargo->getValor()*$this->maxpotHoraPunta['maxpot'];
        }
      }
    } else if ($this->tarifaid == 8) {
      //Tarifa AT3
      foreach($this->cargos as $cargo) {
        if($cargo->getCodigo() == 'AT301'){
          $this->cargoResult[$cargo->getId()] = $cargo->getValor();
        }
        else if ($cargo->getCodigo() == 'AT302'){
          $this->cargoResult[$cargo->getId()] = $cargo->getValor()*$this->consumoEnergia["sum"];
        }
        else if ($cargo->getCodigo() == 'AT303'){
          $this->cargoResult[$cargo->getId()] = $cargo->getValor()*$this->consumoEnergia["sum"];
        }
        else if ($cargo->getCodigo() == 'AT304'){ //Promedio de las 2 mas altas
          
          $q1 = Doctrine_Query::create()
                  ->select('sum(potencia) AS maxpot')
                  ->from('Registro')
                  ->groupBy('registrado_at')
                  ->having("registrado_at like '".$this->anno."-%'");
          
          $this->maxpots = $q1->fetchArray();
          
          rsort($this->maxpots);
          
          $this->promMaxPot = ($this->maxpots[0]['maxpot']+$this->maxpots[1]['maxpot'])/2;
          
          if($this->DemandaMaximaLeidaMes['maxpot'] > $this->promMaxPot) $this->at304 = $this->DemandaMaximaLeidaMes['maxpot'];
          else $this->at304 = $this->promMaxPot;
          
          //print_r($this->maxpots);
          
          $this->cargoResult[$cargo->getId()] = $cargo->getValor()*$this->at304;
        }
//        else if ($cargo->getCodigo() == 'AT305'){ //Demanda maxima leida del mes entre las 18:00 y 22:59
//          
//          $q1 = Doctrine_Query::create()
//                  ->select('sum(potencia) AS maxpot')
//                  ->from('Registro')
//                  ->where('registrado_at between ? and ?', array($this->anno . '-' . $this->mes . '-01 00:18:00', $this->anno . '-' . $this->mes . '-31 22:59:59'))
//                  ->groupBy('registrado_at')
//                  ->having("registrado_at like '".$this->anno."-".$this->mes."%'");
//          
//          //$q1->execute();
//          $this->maxpots = $q1->fetchArray();
//          
//          $this->maxpotHoraPunta = max($this->maxpots);
//          
//          $this->cargoResult[$cargo->getId()] = $cargo->getValor()*$this->maxpotHoraPunta['maxpot'];
//        }
      }
    }

    
  }

}
