<?php

/**
 * BasesfGuardGroupPermission
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $group_id
 * @property integer $permission_id
 * @property sfGuardGroup $Group
 * @property sfGuardPermission $Permission
 * 
 * @method integer                getGroupId()       Returns the current record's "group_id" value
 * @method integer                getPermissionId()  Returns the current record's "permission_id" value
 * @method sfGuardGroup           getGroup()         Returns the current record's "Group" value
 * @method sfGuardPermission      getPermission()    Returns the current record's "Permission" value
 * @method sfGuardGroupPermission setGroupId()       Sets the current record's "group_id" value
 * @method sfGuardGroupPermission setPermissionId()  Sets the current record's "permission_id" value
 * @method sfGuardGroupPermission setGroup()         Sets the current record's "Group" value
 * @method sfGuardGroupPermission setPermission()    Sets the current record's "Permission" value
 * 
 * @package    sgeudec
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasesfGuardGroupPermission extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('sf_guard_group_permission');
        $this->hasColumn('group_id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('permission_id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));

        $this->option('symfony', array(
             'form' => false,
             'filter' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('sfGuardGroup as Group', array(
             'local' => 'group_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('sfGuardPermission as Permission', array(
             'local' => 'permission_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $timestampable0 = new Doctrine_Template_Timestampable(array(
             ));
        $this->actAs($timestampable0);
    }
}