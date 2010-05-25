<?php

/**
 * BasesfGuardRememberKey
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $user_id
 * @property string $remember_key
 * @property string $ip_address
 * @property sfGuardUser $User
 * 
 * @method integer            getUserId()       Returns the current record's "user_id" value
 * @method string             getRememberKey()  Returns the current record's "remember_key" value
 * @method string             getIpAddress()    Returns the current record's "ip_address" value
 * @method sfGuardUser        getUser()         Returns the current record's "User" value
 * @method sfGuardRememberKey setUserId()       Sets the current record's "user_id" value
 * @method sfGuardRememberKey setRememberKey()  Sets the current record's "remember_key" value
 * @method sfGuardRememberKey setIpAddress()    Sets the current record's "ip_address" value
 * @method sfGuardRememberKey setUser()         Sets the current record's "User" value
 * 
 * @package    sympal
 * @subpackage model
 * @author     lacyrhoades@gmail.com
 * @version    SVN: $Id: Builder.php 7200 2010-02-21 09:37:37Z beberlei $
 */
abstract class BasesfGuardRememberKey extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('sf_guard_remember_key');
        $this->hasColumn('user_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('remember_key', 'string', 32, array(
             'type' => 'string',
             'length' => '32',
             ));
        $this->hasColumn('ip_address', 'string', 50, array(
             'type' => 'string',
             'length' => '50',
             ));

        $this->option('symfony', array(
             'form' => false,
             'filter' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('sfGuardUser as User', array(
             'local' => 'user_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}