<?php

/**
 * PtomonitTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class PtomonitTable extends Doctrine_Table {

  /**
   * Returns an instance of this class.
   *
   * @return object PtomonitTable
   */
  public static function getInstance() {
    return Doctrine_Core::getTable('Ptomonit');
  }

  public function getPtomonits() {
    $recinto_id = sfContext::getInstance()->getUser()->getAttribute('recinto_id');
    return Doctrine_Query::create()
                    ->select('*')
                    ->from('Ptomonit')
                    -> where('recinto_id=?',$recinto_id)
                    ->OrderBy('nombre asc')
                    ->execute();
  }

}