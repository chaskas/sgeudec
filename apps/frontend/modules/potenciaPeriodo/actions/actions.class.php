<?php

/**
 * energia actions.
 *
 * @package    sgeudec
 * @subpackage energia
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class potenciaPeriodoActions extends sfActions {

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
  
  public function executeBarChartData() {
    
    $ptomonit_id = $this->getUser()->getAttribute('ptomonit_id');
    $fechaIni = $this->getUser()->getAttribute('fechaIni');
    $fechaFin = $this->getUser()->getAttribute('fechaFin');

    $color = array('#DC143C','#556B2F','#00FFFF','#8A2BE2','#2F4F4F','#FFD700','#FF69B4','#D2691E','#98FB98','#BC8F8F');
    $Y_Max = 0;

    $g = new stGraph();

    $g->title('Demandas Máximas del Periodo Seleccionado (kW)', '{font-size: 20px;}');
    $g->bg_colour = '#FFFFFF';
    $g->set_inner_background('#FFFFFF', '#FFFFFF', 90);
    $g->x_axis_colour('#8499A4', '#E4F5FC');
    $g->y_axis_colour('#8499A4', '#E4F5FC');

    $g->set_x_tick_size(10);

    $this->sensores = Doctrine_Core::getTable('Sensores')
            ->createQuery('a')
            ->where('ptomonit_id = ?',$ptomonit_id)
            ->execute();
 
    $i = 0;
    $j = 1; //contador del sumador de energia por hora
    
    $tmp = 0;
    foreach ($this->sensores as $sensor) {
      
//      $bar_1 = new bar( 90, $color[$i]);
//      $bar_1->key( $sensor->getIdentificador(), 12 );
      
      $this->registros = Doctrine_Query::create()
              ->select("potencia,registrado_at")
              ->from("Registro")
              ->where('registrado_at between ? and ?', array($fechaIni.' 00:00:00', $fechaFin.' 23:59:59'))
              ->andWhere('sensor_id = ?', $sensor->getId())
              ->execute();
      $horas = array();
      $chartData = array();
      foreach ($this->registros as $dato) {
        
        $tmp += $dato->getPotencia();
        if($j==96){
          $chartData[] = $tmp;
          $tmp = 0;
          $j = 0;
          $horas[] = $dato->getFecha();
        }
        $j++;
      }
      
      $Y_Max = max($chartData);
      $maxT[] = $Y_Max;
      
      $tmp = 0;
      $j = 1;
      
      $g->set_data($chartData);
      $g->line(2, $color[$i], $sensor->getIdentificador(), 10);
      
      //$g->data_sets[] = $bar_1;
      $i++;
    }
    
    $g->set_x_labels($horas);

    $g->set_x_label_style(10, '#778899', 2, 1);
    
    $g->set_y_max(max($maxT)+max($maxT)/2);

    $g->y_label_steps(10);
    
    $g->set_y_legend( 'kW', 12, '0x736AFF' );
    $g->set_x_legend( 'Dias', 12, '0x736AFF' );

    echo $g->render();

    return sfView::NONE;
  }

}
