[?php

require_once(sfConfig::get('sf_lib_dir').'/form/base/BaseFormPropel.class.php');

/**
 * <?php echo $this->table->getClassname() ?> form base class.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 14297 2008-12-24 04:37:44Z dwhittle $
 */
class Base<?php echo $this->table->getClassname() ?>Form extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
<?php $columns = $this->table->getColumns(); // PHP 5.1.2 bug ?>
<?php foreach ($columns as $column): ?>
      '<?php echo strtolower($column->getColumnName()) ?>'<?php echo str_repeat(' ', $this->getColumnNameMaxLength() - strlen($column->getColumnName())) ?> => new <?php echo $this->getWidgetClassForColumn($column) ?>(<?php echo $this->getWidgetOptionsForColumn($column) ?>),
<?php endforeach; ?>
<?php foreach ($this->getManyToManyTables() as $tables): ?>
      '<?php echo $this->underscore($tables['middleTable']->getClassname()) ?>_list'<?php echo str_repeat(' ', $this->getColumnNameMaxLength() - strlen($this->underscore($tables['middleTable']->getClassname()).'_list')) ?> => new sfWidgetFormPropelSelectMany(array('model' => '<?php echo $tables['relatedTable']->getClassname() ?>')),
<?php endforeach; ?>
    ));

    $this->setValidators(array(
<?php $columns = $this->table->getColumns(); // PHP 5.1.2 bug ?>
<?php foreach ($columns as $column): ?>
      '<?php echo strtolower($column->getColumnName()) ?>'<?php echo str_repeat(' ', $this->getColumnNameMaxLength() - strlen($column->getColumnName())) ?> => new <?php echo $this->getValidatorClassForColumn($column) ?>(<?php echo $this->getValidatorOptionsForColumn($column) ?>),
<?php endforeach; ?>
<?php foreach ($this->getManyToManyTables() as $tables): ?>
      '<?php echo $this->underscore($tables['middleTable']->getClassname()) ?>_list'<?php echo str_repeat(' ', $this->getColumnNameMaxLength() - strlen($this->underscore($tables['middleTable']->getClassname()).'_list')) ?> => new sfValidatorPropelChoiceMany(array('model' => '<?php echo $tables['relatedTable']->getClassname() ?>', 'required' => false)),
<?php endforeach; ?>
    ));

<?php if ($uniqueColumns = $this->getUniqueColumnNames()): ?>
    $this->validatorSchema->setPostValidator(
<?php if (count($uniqueColumns) > 1): ?>
      new sfValidatorAnd(array(
<?php foreach ($uniqueColumns as $uniqueColumn): ?>
        new sfValidatorPropelUnique(array('model' => '<?php echo $this->table->getClassname() ?>', 'column' => array('<?php echo strtolower(implode("', '", $uniqueColumn)) ?>'))),
<?php endforeach; ?>
      ))
<?php else: ?>
      new sfValidatorPropelUnique(array('model' => '<?php echo $this->table->getClassname() ?>', 'column' => array('<?php echo strtolower(implode("', '", $uniqueColumns[0])) ?>')))
<?php endif; ?>
    );

<?php endif; ?>
    $this->widgetSchema->setNameFormat('<?php echo $this->underscore($this->table->getClassname()) ?>[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return '<?php echo $this->table->getClassname() ?>';
  }

<?php if ($this->isI18n()): ?>
  public function getI18nModelName()
  {
    return '<?php echo $this->getI18nModel() ?>';
  }

  public function getI18nFormClass()
  {
    return '<?php echo $this->getI18nModel() ?>Form';
  }
<?php endif; ?>

<?php if ($this->getManyToManyTables()): ?>
  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

<?php foreach ($this->getManyToManyTables() as $tables): ?>
    if (isset($this->widgetSchema['<?php echo $this->underscore($tables['middleTable']->getClassname()) ?>_list']))
    {
      $values = array();
      foreach ($this->object->get<?php echo $tables['middleTable']->getPhpName() ?>s() as $obj)
      {
        $values[] = $obj->get<?php echo $tables['relatedColumn']->getPhpName() ?>();
      }

      $this->setDefault('<?php echo $this->underscore($tables['middleTable']->getClassname()) ?>_list', $values);
    }

<?php endforeach; ?>
  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

<?php foreach ($this->getManyToManyTables() as $tables): ?>
    $this->save<?php echo $tables['middleTable']->getPhpName() ?>List($con);
<?php endforeach; ?>
  }

<?php foreach ($this->getManyToManyTables() as $tables): ?>
  public function save<?php echo $tables['middleTable']->getPhpName() ?>List($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['<?php echo $this->underscore($tables['middleTable']->getClassname()) ?>_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (is_null($con))
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(<?php echo $tables['middleTable']->getClassname() ?>Peer::<?php echo strtoupper($tables['column']->getColumnName()) ?>, $this->object->getPrimaryKey());
    <?php echo $tables['middleTable']->getClassname() ?>Peer::doDelete($c, $con);

    $values = $this->getValue('<?php echo $this->underscore($tables['middleTable']->getClassname()) ?>_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new <?php echo $tables['middleTable']->getClassname() ?>();
        $obj->set<?php echo $tables['column']->getPhpName() ?>($this->object->getPrimaryKey());
        $obj->set<?php echo $tables['relatedColumn']->getPhpName() ?>($value);
        $obj->save();
      }
    }
  }

<?php endforeach; ?>
<?php endif; ?>
}
