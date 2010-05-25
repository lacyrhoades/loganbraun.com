<?php

/**
 * sfSympalContentSlot form base class.
 *
 * @method sfSympalContentSlot getObject() Returns the current form's model object
 *
 * @package    sympal
 * @subpackage form
 * @author     lacyrhoades@gmail.com
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasesfSympalContentSlotForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'name'         => new sfWidgetFormInputText(),
      'type'         => new sfWidgetFormInputText(),
      'value'        => new sfWidgetFormTextarea(),
      'is_column'    => new sfWidgetFormInputCheckbox(),
      'content_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'sfSympalContent')),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'name'         => new sfValidatorString(array('max_length' => 255)),
      'type'         => new sfValidatorString(array('max_length' => 255)),
      'value'        => new sfValidatorString(array('required' => false)),
      'is_column'    => new sfValidatorBoolean(array('required' => false)),
      'content_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'sfSympalContent', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('sf_sympal_content_slot[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'sfSympalContentSlot';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['content_list']))
    {
      $this->setDefault('content_list', $this->object->Content->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveContentList($con);

    parent::doSave($con);
  }

  public function saveContentList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['content_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Content->getPrimaryKeys();
    $values = $this->getValue('content_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Content', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Content', array_values($link));
    }
  }

}
