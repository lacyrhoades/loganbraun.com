<?php

/**
 * sfSympalContentSlot filter form base class.
 *
 * @package    sympal
 * @subpackage filter
 * @author     lacyrhoades@gmail.com
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasesfSympalContentSlotFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'type'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'value'        => new sfWidgetFormFilterInput(),
      'is_column'    => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'content_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'sfSympalContent')),
    ));

    $this->setValidators(array(
      'name'         => new sfValidatorPass(array('required' => false)),
      'type'         => new sfValidatorPass(array('required' => false)),
      'value'        => new sfValidatorPass(array('required' => false)),
      'is_column'    => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'content_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'sfSympalContent', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('sf_sympal_content_slot_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function addContentListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query
      ->leftJoin($query->getRootAlias().'.sfSympalContentSlotRef sfSympalContentSlotRef')
      ->andWhereIn('sfSympalContentSlotRef.content_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'sfSympalContentSlot';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'name'         => 'Text',
      'type'         => 'Text',
      'value'        => 'Text',
      'is_column'    => 'Boolean',
      'content_list' => 'ManyKey',
    );
  }
}
