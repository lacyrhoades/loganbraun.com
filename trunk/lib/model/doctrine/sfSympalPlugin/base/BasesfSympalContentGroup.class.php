<?php

/**
 * BasesfSympalContentGroup
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $content_id
 * @property integer $group_id
 * @property sfSympalContent $Content
 * @property sfGuardGroup $Group
 * 
 * @method integer              getContentId()  Returns the current record's "content_id" value
 * @method integer              getGroupId()    Returns the current record's "group_id" value
 * @method sfSympalContent      getContent()    Returns the current record's "Content" value
 * @method sfGuardGroup         getGroup()      Returns the current record's "Group" value
 * @method sfSympalContentGroup setContentId()  Sets the current record's "content_id" value
 * @method sfSympalContentGroup setGroupId()    Sets the current record's "group_id" value
 * @method sfSympalContentGroup setContent()    Sets the current record's "Content" value
 * @method sfSympalContentGroup setGroup()      Sets the current record's "Group" value
 * 
 * @package    sympal
 * @subpackage model
 * @author     lacyrhoades@gmail.com
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasesfSympalContentGroup extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('sf_sympal_content_group');
        $this->hasColumn('content_id', 'integer', null, array(
             'primary' => true,
             'type' => 'integer',
             ));
        $this->hasColumn('group_id', 'integer', null, array(
             'primary' => true,
             'type' => 'integer',
             ));

        $this->option('symfony', array(
             'form' => false,
             'filter' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('sfSympalContent as Content', array(
             'local' => 'content_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('sfGuardGroup as Group', array(
             'local' => 'group_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $sfsympalrecordtemplate0 = new sfSympalRecordTemplate(array(
             ));
        $this->actAs($sfsympalrecordtemplate0);
    }
}