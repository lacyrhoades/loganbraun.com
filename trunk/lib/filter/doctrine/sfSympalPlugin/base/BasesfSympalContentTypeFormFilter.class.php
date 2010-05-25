<?php

/**
 * sfSympalContentType filter form base class.
 *
 * @package    sympal
 * @subpackage filter
 * @author     lacyrhoades@gmail.com
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasesfSympalContentTypeFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'description'  => new sfWidgetFormFilterInput(),
      'label'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'default_path' => new sfWidgetFormFilterInput(),
      'theme'        => new sfWidgetFormFilterInput(),
      'template'     => new sfWidgetFormFilterInput(),
      'module'       => new sfWidgetFormFilterInput(),
      'action'       => new sfWidgetFormFilterInput(),
      'slug'         => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'name'         => new sfValidatorPass(array('required' => false)),
      'description'  => new sfValidatorPass(array('required' => false)),
      'label'        => new sfValidatorPass(array('required' => false)),
      'default_path' => new sfValidatorPass(array('required' => false)),
      'theme'        => new sfValidatorPass(array('required' => false)),
      'template'     => new sfValidatorPass(array('required' => false)),
      'module'       => new sfValidatorPass(array('required' => false)),
      'action'       => new sfValidatorPass(array('required' => false)),
      'slug'         => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('sf_sympal_content_type_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'sfSympalContentType';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'name'         => 'Text',
      'description'  => 'Text',
      'label'        => 'Text',
      'default_path' => 'Text',
      'theme'        => 'Text',
      'template'     => 'Text',
      'module'       => 'Text',
      'action'       => 'Text',
      'slug'         => 'Text',
    );
  }
}
