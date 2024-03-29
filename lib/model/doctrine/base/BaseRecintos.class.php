<?php

/**
 * BaseRecintos
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property text $nombre
 * @property bigint $tarifa_id
 * @property text $mapa
 * @property Tarifas $Tarifas
 * @property Doctrine_Collection $Recintos
 * 
 * @method text                getNombre()    Returns the current record's "nombre" value
 * @method bigint              getTarifaId()  Returns the current record's "tarifa_id" value
 * @method text                getMapa()      Returns the current record's "mapa" value
 * @method Tarifas             getTarifas()   Returns the current record's "Tarifas" value
 * @method Doctrine_Collection getRecintos()  Returns the current record's "Recintos" collection
 * @method Recintos            setNombre()    Sets the current record's "nombre" value
 * @method Recintos            setTarifaId()  Sets the current record's "tarifa_id" value
 * @method Recintos            setMapa()      Sets the current record's "mapa" value
 * @method Recintos            setTarifas()   Sets the current record's "Tarifas" value
 * @method Recintos            setRecintos()  Sets the current record's "Recintos" collection
 * 
 * @package    sgeudec
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseRecintos extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('recintos');
        $this->hasColumn('nombre', 'text', null, array(
             'type' => 'text',
             'notnull' => true,
             ));
        $this->hasColumn('tarifa_id', 'bigint', 20, array(
             'type' => 'bigint',
             'notnull' => true,
             'length' => 20,
             ));
        $this->hasColumn('mapa', 'text', null, array(
             'type' => 'text',
             'notnull' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Tarifas', array(
             'local' => 'tarifa_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasMany('Ptomonit as Recintos', array(
             'local' => 'id',
             'foreign' => 'recinto_id'));
    }
}