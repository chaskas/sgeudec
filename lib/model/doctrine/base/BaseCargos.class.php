<?php

/**
 * BaseCargos
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property text $nombre
 * @property float $valor
 * @property bigint $tarifa_id
 * @property bigint $unidades_id
 * @property Tarifas $Tarifas
 * @property Unidades $Unidades
 * 
 * @method text     getNombre()      Returns the current record's "nombre" value
 * @method float    getValor()       Returns the current record's "valor" value
 * @method bigint   getTarifaId()    Returns the current record's "tarifa_id" value
 * @method bigint   getUnidadesId()  Returns the current record's "unidades_id" value
 * @method Tarifas  getTarifas()     Returns the current record's "Tarifas" value
 * @method Unidades getUnidades()    Returns the current record's "Unidades" value
 * @method Cargos   setNombre()      Sets the current record's "nombre" value
 * @method Cargos   setValor()       Sets the current record's "valor" value
 * @method Cargos   setTarifaId()    Sets the current record's "tarifa_id" value
 * @method Cargos   setUnidadesId()  Sets the current record's "unidades_id" value
 * @method Cargos   setTarifas()     Sets the current record's "Tarifas" value
 * @method Cargos   setUnidades()    Sets the current record's "Unidades" value
 * 
 * @package    sgeudec
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseCargos extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('cargos');
        $this->hasColumn('nombre', 'text', null, array(
             'type' => 'text',
             'notnull' => true,
             ));
        $this->hasColumn('valor', 'float', null, array(
             'type' => 'float',
             'notnull' => true,
             'scale' => 4,
             ));
        $this->hasColumn('tarifa_id', 'bigint', 20, array(
             'type' => 'bigint',
             'notnull' => true,
             'length' => 20,
             ));
        $this->hasColumn('unidades_id', 'bigint', 20, array(
             'type' => 'bigint',
             'notnull' => true,
             'length' => 20,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Tarifas', array(
             'local' => 'tarifa_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('Unidades', array(
             'local' => 'unidades_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));
    }
}