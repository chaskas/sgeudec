<?php

/**
 * energia actions.
 *
 * @package    sgeudec
 * @subpackage energia
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class energiaPeriodoActions extends sfActions {

  /**
   * Executes index action
   *
   * @param sfRequest $request A request object
   */
  public function executeIndex(sfWebRequest $request) {
    $this->recintos = new EnergiaRecintoForm();
    //$this->ptomonits = new EnergiaPtomonitForm();
    $this->fecha = new EnergiaFechaPeriodoForm();
    $this->gdia = 0;
    $this->getUser()->setAttribute('recinto_id', '');
    $this->getUser()->setAttribute('ptomonit_id', '');
    $this->getUser()->setAttribute('fechaIni', '');
    $this->getUser()->setAttribute('fechaFin', '');
  }

  public function executePtomonit(sfWebRequest $request) {
    $this->getUser()->setAttribute('recinto_id', $request->getParameter('recinto_id'));
    $this->ptomonits = new EnergiaPtomonitForm();
  }

  public function executeSensor(sfWebRequest $request) {
    $this->getUser()->setAttribute('ptomonit_id', $request->getParameter('ptomonit_id'));
    $this->sensores = new EnergiaSensorForm();
  }

  public function executeFecha(sfWebRequest $request) {
    
//    $this->fecha = new EnergiaFechaForm();
  }
  
  public function executeGraficoPtomonit(sfWebRequest $request){
    $this->getUser()->setAttribute('ptomonit_id', $request->getParameter('ptomonit_id'));
  }
  public function executeGraficoFecha(sfWebRequest $request){
    
    if($request->hasParameter('fechaIni')){
        $dateIni = date_create_from_format('d/m/Y',$request->getParameter('fechaIni'));
        $this->getUser()->setAttribute('fechaIni',date_format($dateIni, 'Y-m-d'));
    }
    if($request->hasParameter('fechaFin')){
        $dateFin = date_create_from_format('d/m/Y',$request->getParameter('fechaFin'));
        $this->getUser()->setAttribute('fechaFin',date_format($dateFin, 'Y-m-d'));
    }
  }

  public function executeLineChartData() {
    
    $ptomonit_id = $this->getUser()->getAttribute('ptomonit_id');
    $fechaIni = $this->getUser()->getAttribute('fechaIni');
    $fechaFin = $this->getUser()->getAttribute('fechaFin');

    $color = array('#D2691E','#DC143C','#556B2F','#00FFFF','#8A2BE2','#2F4F4F','#FFD700','#FF69B4','#98FB98','#BC8F8F');
    $Y_Max = 0;

    //Create new stGraph object
    $g = new stGraph();

    // Chart Title
    $g->title('Energía por Periodo', '{font-size: 20px;}');
    $g->bg_colour = '#FFFFFF';
    $g->set_inner_background('#FFFFFF', '#FFFFFF', 90);
    $g->x_axis_colour('#8499A4', '#E4F5FC');
    $g->y_axis_colour('#8499A4', '#E4F5FC');

$g->set_y_legend( 'kWh Consumidos', 15, '#736AFF' );
$g->set_x_legend( 'Dias', 15, '#736AFF' );

    $g->set_x_tick_size(10);

    $this->sensores = Doctrine_Core::getTable('Sensores')
            ->createQuery('a')
            ->where('ptomonit_id = ?',$ptomonit_id)
            ->execute();
    
    
    $i = 0;
    foreach ($this->sensores as $sensor) {
      
      $this->registros = Doctrine_Query::create()
              ->select("potencia,registrado_at")
              ->from("Registro")
              ->where('registrado_at between ? and ?', array($fechaIni.' 00:00:00', $fechaFin.' 23:59:59'))
              ->andWhere('sensor_id = ?', $sensor->getId())
              ->execute();

      $chartData = array();
      $j = 0;
      $hora = 0;
      $horas = array();
      foreach ($this->registros as $dato) {
          $hora += $dato->getPotencia()*(5/60);
          if($j==12 || $j == 0){
              $chartData[] = $hora;
              $hora = 0;
              $j = 0;
              $horas[] = $dato->getHora()."\n". $dato->getFecha();
          }
          $j++;
      }
      
      $Y_Max = max($chartData);
      
      $g->set_data($chartData);
      $g->line(2, $color[$i], $sensor->getIdentificador(), 10);

      
//      foreach ($this->registros as $dato) {
//        
//      }
      $i++;
    }

    
    $g->set_x_labels($horas);

    //to set the format of labels on x-axis e.g. font, color, orientation, step
    $g->set_x_label_style(8, '#222222', 2, 1);
    
    $g->set_y_max($Y_Max+$Y_Max/2);

    $g->y_label_steps(15);

    // display the data
    echo $g->render();

    return sfView::NONE;
  }

}
