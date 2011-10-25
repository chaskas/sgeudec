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
    //$this->ptomonits = new EnergiaPtomonitForm();
    $this->fecha = new EnergiaFechaForm();
    $this->gdia = 0;
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
  public function executeFecha(sfWebRequest $request)
  {
    //$this->getUser()->setAttribute('ptomonit_id',$request->getParameter('ptomonit_id'));
    $this->fecha = new EnergiaFechaForm();
  }
  public function executeDiaGetData(sfWebRequest $request)
  {
    //Accion para recuperar datos de clicks hechos en iconos y luego mostrar en google chart
    $params["tqx"] = $request->getParameter("tqx");
    list($param[],$reqId) = explode(":", $params["tqx"]);

    $datos    = Doctrine_Query::create()
                ->select("potencia,registrado_at")
                ->from("Registro")
                ->where('registrado_at between ? and ?',array('2011-07-07 00:00:00','2011-07-07 23:59:00'))
                ->execute();

    $output = "google.visualization.Query.setResponse({'$param[0]':'$reqId', 'status':'OK',";
    $output .= "'table': {cols: [";
    $output .= "{id:'registrado_at',label:'Fecha',type:'string'},";
    $output .= "{id:'potencia',label:'Potencia',type:'number'}";
    $output .= "]";
    $output .= ",rows: [";

    $sp = "";

    foreach($datos as $dato)
    {
      $output .= $sp . "{c:[{v:'" . $dato["registrado_at"] . "'},{v:" . $dato["potencia"] . ",f:'".$dato["potencia"]."'}]}";
      $sp = ",";
    }
    $output .= "]}});";
    $this->getResponse()->setHttpHeader('Content-type', 'text/plain');
    return $this->renderText($output);
  }
}
