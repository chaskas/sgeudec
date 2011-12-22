<?php

/**
 * energia actions.
 *
 * @package    sgeudec
 * @subpackage energia
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class energiaDiaActions extends sfActions {

  /**
   * Executes index action
   *
   * @param sfRequest $request A request object
   */
  public function executeIndex(sfWebRequest $request) {
    $this->recintos = new EnergiaRecintoForm();
    //$this->ptomonits = new EnergiaPtomonitForm();
    $this->fecha = new EnergiaFechaForm();
    $this->gdia = 0;
    $this->getUser()->setAttribute('recinto_id', '');
    $this->getUser()->setAttribute('ptomonit_id', '');
    $this->getUser()->setAttribute('fecha', '');
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
      
    $date = date_create_from_format('d/m/Y',$request->getParameter('fecha'));
      
    $this->getUser()->setAttribute('fecha',date_format($date, 'Y-m-d'));
  }

  public function executeBarChartData() {
    
    $ptomonit_id = $this->getUser()->getAttribute('ptomonit_id');
    $fecha = $this->getUser()->getAttribute('fecha');

    $color = array('#DC143C','#556B2F','#00FFFF','#8A2BE2','#2F4F4F','#FFD700','#FF69B4','#D2691E','#98FB98','#BC8F8F');
    $Y_Max = 0;

    $g = new stGraph();

    $g->title('Consumo de Energia Diario (kWh)', '{font-size: 20px;}');
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
      
      $bar_1 = new bar( 90, $color[$i]);
      $bar_1->key( $sensor->getIdentificador(), 12 );
      
      $this->registros = Doctrine_Query::create()
              ->select("potencia,registrado_at")
              ->from("Registro")
              ->where('registrado_at between ? and ?', array($fecha.' 00:00:00', $fecha.' 23:59:59'))
              ->andWhere('sensor_id = ?', $sensor->getId())
              ->execute();
      $horas = array();
      foreach ($this->registros as $dato) {
        $tmp += $dato->getPotencia()*(15/60);
        
        if($j==1)$horas[] = $dato->getHora();
        
        if($j==4){
          $bar_1->data[] = $tmp;
          $tmp = 0;
          $j = 0;
        }
        
        $j++;
      }
      $j = 1;
      $Y_Max = max($bar_1->data);
      $maxT[] = $Y_Max;
      $g->data_sets[] = $bar_1;
      $i++;
    }
    
    $g->set_x_labels($horas);

    $g->set_x_label_style(10, '#778899', 2, 1);
    
    $g->set_y_max(max($maxT)+max($maxT)/3);

    $g->y_label_steps(15);
    
    $g->set_y_legend( 'kWh Consumido', 12, '0x736AFF' );
    $g->set_x_legend( 'Horas', 12, '0x736AFF' );

    echo $g->render();

    return sfView::NONE;
  }
  
  public function executeLineChartData() {
    
    $ptomonit_id = $this->getUser()->getAttribute('ptomonit_id');
    $fecha = $this->getUser()->getAttribute('fecha');

    $color = array('#DC143C','#556B2F','#00FFFF','#8A2BE2','#2F4F4F','#FFD700','#FF69B4','#D2691E','#98FB98','#BC8F8F');
    $Y_Max = 0;

    //Create new stGraph object
    $g = new stGraph();

    // Chart Title
    $g->title('Variación de Energía (Bloques de 15 min.)', '{font-size: 20px;}');
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
    foreach ($this->sensores as $sensor) {
      
      $this->registros = Doctrine_Query::create()
              ->select("potencia,registrado_at")
              ->from("Registro")
              ->where('registrado_at between ? and ?', array($fecha.' 00:00:00', $fecha.' 23:59:59'))
              ->andWhere('sensor_id = ?', $sensor->getId())
              ->execute();

      $chartData = array();
      foreach ($this->registros as $dato) {
        $chartData[] = $dato->getPotencia()*(15/60);
      }
      
      $Y_Max = max($chartData);
      $maxT[] = $Y_Max;
      
      $g->set_data($chartData);
      $g->line(2, $color[$i], $sensor->getIdentificador(), 10);

      $horas = array();
      foreach ($this->registros as $dato) {
        $horas[] = $dato->getHora();
      }
      $i++;
    }

    
    $g->set_x_labels($horas);

    //to set the format of labels on x-axis e.g. font, color, orientation, step
    $g->set_x_label_style(10, '#778899', 2, 4);
    
    $g->set_y_max(max($maxT)+max($maxT)/3);

    $g->y_label_steps(15);
    
    $g->set_y_legend( 'kWh Consumido', 12, '0x736AFF' );
    $g->set_x_legend( 'Horas', 12, '0x736AFF' );

    // display the data
    echo $g->render();

    return sfView::NONE;
  }

}
