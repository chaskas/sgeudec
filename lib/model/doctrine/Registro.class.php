<?php

/**
 * Registro
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    sgeudec
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Registro extends BaseRegistro
{
  public function getFecha(){
    $date = date_create($this->getRegistradoAt());
    return date_format($date,'d/m/Y');
  }
  public function getHora(){
    $date = date_create($this->getRegistradoAt());
    return date_format($date,'H:i');
  }
  
}
