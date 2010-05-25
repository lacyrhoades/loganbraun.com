<?php

/**
 * sfSympalMenuItemGroup filter form base class.
 *
 * @package    sympal
 * @subpackage filter
 * @author     lacyrhoades@gmail.com
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasesfSympalMenuItemGroupFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
    ));

    $this->setValidators(array(
    ));

    $this->widgetSchema->setNameFormat('sf_sympal_menu_item_group_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'sfSympalMenuItemGroup';
  }

  public function getFields()
  {
    return array(
      'menu_item_id' => 'Number',
      'group_id'     => 'Number',
    );
  }
}
