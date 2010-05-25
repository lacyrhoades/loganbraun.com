<?php

/**
 * sfSympalRedirect filter form base class.
 *
 * @package    sympal
 * @subpackage filter
 * @author     lacyrhoades@gmail.com
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasesfSympalRedirectFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'site_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Site'), 'add_empty' => true)),
      'source'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'destination' => new sfWidgetFormFilterInput(),
      'content_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Content'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'site_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Site'), 'column' => 'id')),
      'source'      => new sfValidatorPass(array('required' => false)),
      'destination' => new sfValidatorPass(array('required' => false)),
      'content_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Content'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('sf_sympal_redirect_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'sfSympalRedirect';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'site_id'     => 'ForeignKey',
      'source'      => 'Text',
      'destination' => 'Text',
      'content_id'  => 'ForeignKey',
    );
  }
}
