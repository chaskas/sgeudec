<?php

/**
 * SensoresTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class SensoresTable extends Doctrine_Table {

  /**
   * Returns an instance of this class.
   *
   * @return object SensoresTable
   */
  public static function getInstance() {
    return Doctrine_Core::getTable('Sensores');
  }

  public function getSensores() {
    $ptomonit_id = sfContext::getInstance()->getUser()->getAttribute('ptomonit_id');
    return Doctrine_Query::create()
                    ->select('*')
                    ->from('Sensores')
                    ->where('ptomonit_id=?',$ptomonit_id)
                    ->OrderBy('identificador asc')
                    ->execute();
  }

}