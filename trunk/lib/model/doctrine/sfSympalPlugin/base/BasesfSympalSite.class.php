<?php

/**
 * BasesfSympalSite
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $theme
 * @property string $title
 * @property clob $description
 * @property string $page_title
 * @property string $meta_keywords
 * @property string $meta_description
 * @property Doctrine_Collection $Redirects
 * @property Doctrine_Collection $Content
 * @property Doctrine_Collection $MenuItems
 * 
 * @method string              getTheme()            Returns the current record's "theme" value
 * @method string              getTitle()            Returns the current record's "title" value
 * @method clob                getDescription()      Returns the current record's "description" value
 * @method string              getPageTitle()        Returns the current record's "page_title" value
 * @method string              getMetaKeywords()     Returns the current record's "meta_keywords" value
 * @method string              getMetaDescription()  Returns the current record's "meta_description" value
 * @method Doctrine_Collection getRedirects()        Returns the current record's "Redirects" collection
 * @method Doctrine_Collection getContent()          Returns the current record's "Content" collection
 * @method Doctrine_Collection getMenuItems()        Returns the current record's "MenuItems" collection
 * @method sfSympalSite        setTheme()            Sets the current record's "theme" value
 * @method sfSympalSite        setTitle()            Sets the current record's "title" value
 * @method sfSympalSite        setDescription()      Sets the current record's "description" value
 * @method sfSympalSite        setPageTitle()        Sets the current record's "page_title" value
 * @method sfSympalSite        setMetaKeywords()     Sets the current record's "meta_keywords" value
 * @method sfSympalSite        setMetaDescription()  Sets the current record's "meta_description" value
 * @method sfSympalSite        setRedirects()        Sets the current record's "Redirects" collection
 * @method sfSympalSite        setContent()          Sets the current record's "Content" collection
 * @method sfSympalSite        setMenuItems()        Sets the current record's "MenuItems" collection
 * 
 * @package    sympal
 * @subpackage model
 * @author     lacyrhoades@gmail.com
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasesfSympalSite extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('sf_sympal_site');
        $this->hasColumn('theme', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('title', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('description', 'clob', null, array(
             'type' => 'clob',
             'notnull' => false,
             ));
        $this->hasColumn('page_title', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('meta_keywords', 'string', 500, array(
             'type' => 'string',
             'length' => 500,
             ));
        $this->hasColumn('meta_description', 'string', 500, array(
             'type' => 'string',
             'length' => 500,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('sfSympalRedirect as Redirects', array(
             'local' => 'id',
             'foreign' => 'site_id'));

        $this->hasMany('sfSympalContent as Content', array(
             'local' => 'id',
             'foreign' => 'site_id'));

        $this->hasMany('sfSympalMenuItem as MenuItems', array(
             'local' => 'id',
             'foreign' => 'site_id'));

        $sfsympalrecordtemplate0 = new sfSympalRecordTemplate(array(
             ));
        $this->actAs($sfsympalrecordtemplate0);
    }
}