<?php

/**
 * BasesfGuardGroup
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $name
 * @property string $description
 * @property Doctrine_Collection $Users
 * @property Doctrine_Collection $Permissions
 * @property Doctrine_Collection $sfGuardGroupPermission
 * @property Doctrine_Collection $sfGuardUserGroup
 * @property Doctrine_Collection $MenuItems
 * @property Doctrine_Collection $MenuItemGroups
 * @property Doctrine_Collection $Content
 * @property Doctrine_Collection $EditContent
 * @property Doctrine_Collection $ContentGroups
 * @property Doctrine_Collection $ContentEditGroups
 * 
 * @method string              getName()                   Returns the current record's "name" value
 * @method string              getDescription()            Returns the current record's "description" value
 * @method Doctrine_Collection getUsers()                  Returns the current record's "Users" collection
 * @method Doctrine_Collection getPermissions()            Returns the current record's "Permissions" collection
 * @method Doctrine_Collection getSfGuardGroupPermission() Returns the current record's "sfGuardGroupPermission" collection
 * @method Doctrine_Collection getSfGuardUserGroup()       Returns the current record's "sfGuardUserGroup" collection
 * @method Doctrine_Collection getMenuItems()              Returns the current record's "MenuItems" collection
 * @method Doctrine_Collection getMenuItemGroups()         Returns the current record's "MenuItemGroups" collection
 * @method Doctrine_Collection getContent()                Returns the current record's "Content" collection
 * @method Doctrine_Collection getEditContent()            Returns the current record's "EditContent" collection
 * @method Doctrine_Collection getContentGroups()          Returns the current record's "ContentGroups" collection
 * @method Doctrine_Collection getContentEditGroups()      Returns the current record's "ContentEditGroups" collection
 * @method sfGuardGroup        setName()                   Sets the current record's "name" value
 * @method sfGuardGroup        setDescription()            Sets the current record's "description" value
 * @method sfGuardGroup        setUsers()                  Sets the current record's "Users" collection
 * @method sfGuardGroup        setPermissions()            Sets the current record's "Permissions" collection
 * @method sfGuardGroup        setSfGuardGroupPermission() Sets the current record's "sfGuardGroupPermission" collection
 * @method sfGuardGroup        setSfGuardUserGroup()       Sets the current record's "sfGuardUserGroup" collection
 * @method sfGuardGroup        setMenuItems()              Sets the current record's "MenuItems" collection
 * @method sfGuardGroup        setMenuItemGroups()         Sets the current record's "MenuItemGroups" collection
 * @method sfGuardGroup        setContent()                Sets the current record's "Content" collection
 * @method sfGuardGroup        setEditContent()            Sets the current record's "EditContent" collection
 * @method sfGuardGroup        setContentGroups()          Sets the current record's "ContentGroups" collection
 * @method sfGuardGroup        setContentEditGroups()      Sets the current record's "ContentEditGroups" collection
 * 
 * @package    sympal
 * @subpackage model
 * @author     lacyrhoades@gmail.com
 * @version    SVN: $Id: Builder.php 7200 2010-02-21 09:37:37Z beberlei $
 */
abstract class BasesfGuardGroup extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('sf_guard_group');
        $this->hasColumn('name', 'string', 255, array(
             'type' => 'string',
             'unique' => true,
             'length' => '255',
             ));
        $this->hasColumn('description', 'string', 1000, array(
             'type' => 'string',
             'length' => '1000',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('sfGuardUser as Users', array(
             'refClass' => 'sfGuardUserGroup',
             'local' => 'group_id',
             'foreign' => 'user_id'));

        $this->hasMany('sfGuardPermission as Permissions', array(
             'refClass' => 'sfGuardGroupPermission',
             'local' => 'group_id',
             'foreign' => 'permission_id'));

        $this->hasMany('sfGuardGroupPermission', array(
             'local' => 'id',
             'foreign' => 'group_id'));

        $this->hasMany('sfGuardUserGroup', array(
             'local' => 'id',
             'foreign' => 'group_id'));

        $this->hasMany('sfSympalMenuItem as MenuItems', array(
             'refClass' => 'sfSympalMenuItemGroup',
             'local' => 'group_id',
             'foreign' => 'menu_item_id'));

        $this->hasMany('sfSympalMenuItemGroup as MenuItemGroups', array(
             'local' => 'id',
             'foreign' => 'group_id'));

        $this->hasMany('sfSympalContent as Content', array(
             'refClass' => 'sfSympalContentGroup',
             'local' => 'group_id',
             'foreign' => 'content_id'));

        $this->hasMany('sfSympalContent as EditContent', array(
             'refClass' => 'sfSympalContentEditGroup',
             'local' => 'group_id',
             'foreign' => 'content_id'));

        $this->hasMany('sfSympalContentGroup as ContentGroups', array(
             'local' => 'id',
             'foreign' => 'group_id'));

        $this->hasMany('sfSympalContentEditGroup as ContentEditGroups', array(
             'local' => 'id',
             'foreign' => 'group_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}