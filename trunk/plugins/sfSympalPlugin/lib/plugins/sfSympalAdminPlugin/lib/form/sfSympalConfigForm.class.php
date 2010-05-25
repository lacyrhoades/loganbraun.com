<?php

class sfSympalConfigForm extends BaseForm
{
  protected
    $_settings = array(),
    $_path;

  public function setup()
  {
    self::$dispatcher->notify(new sfEvent($this, 'sympal.load_config_form'));

    $otherSettings = array();
    foreach ($this->_settings as $group => $settings)
    {
      if (!is_numeric($group))
      {
        $form = new BaseForm();
        foreach ($settings as $setting)
        {
          $setting['widget']->setLabel($setting['label']);

          $form->setWidget($setting['name'], $setting['widget']);
          $form->setValidator($setting['name'], $setting['validator']);
        }
        $this->embedForm($group, $form);
      } else {
        $otherSettings[] = $settings;
      }
    }

    foreach ($otherSettings as $setting)
    {
      $this->setWidget($setting['name'], $setting['widget']);
      $setting['widget']->setLabel($setting['label']);
      $this->setValidator($setting['name'], $setting['validator']);
    }

    $defaults = $this->getDefaults();
    foreach ($this as $key => $value)
    {
      if ($value instanceof sfFormFieldSchema)
      {
        foreach ($value as $k => $v)
        {
          $defaults[$key][$k] = sfSympalConfig::get($key, $k);
        }
      } else {
        $defaults[$key] = sfSympalConfig::get($key);
      }
    }

    $this->setDefaults($defaults);

    $this->widgetSchema->setNameFormat('settings[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function addSetting($group, $name, $label = null, $widget = 'Input', $validator = 'String')
  {
    if (is_null($label))
    {
      $label = sfInflector::humanize($name);
    }

    if (!is_object($widget))
    {
      $widgetClass = 'sfWidgetForm' . $widget;
      $widget = new $widgetClass();
    }

    if (!is_object($validator))
    {
      $validatorClass = 'sfValidator' . $validator;
      $validator = new $validatorClass();
    }

    $validator->setOption('required', false);

    $node = array(
      'name' => $name,
      'label' => $label,
      'widget' => $widget,
      'validator' => $validator
    );

    if (!$group)
    {
      $this->_settings[] = $node;
    } else {
      $this->_settings[$group][] = $node;
    }
  }

  public function save()
  {
    $array = $this->_buildArrayToWrite();

    $this->_path = sfConfig::get('sf_app_dir').'/config/app.yml';

    file_put_contents($this->_path, sfYaml::dump($array, 4));

    chdir(sfConfig::get('sf_root_dir'));
    $task = new sfCacheClearTask(sfApplicationConfiguration::getActive()->getEventDispatcher(), new sfFormatter());
    $task->run(array(), array('type' => 'config'));
  }

  protected function _buildArrayToWrite()
  {
    $old = $this->getDefaults();
    $new = $this->getValues();

    $array = array();
    $array['all']['sympal_config'] = array();

    // Add only the values that have changed from the old default values
    foreach ($new as $key => $value)
    {
      if ($value != $old[$key])
      {
        $array['all']['sympal_config'][$key] = $value;
      }
    }

    // Merge in existing values from the current app.yml file
    $array = sfToolkit::arrayDeepMerge(
      sfYaml::load(sfConfig::get('sf_app_dir').'/config/app.yml'),
      $array
    );

    // Remove values that don't exist anymore
    foreach ($array['all']['sympal_config'] as $key => $value)
    {
      if (!array_key_exists($key, $new))
      {
        unset($array['all']['sympal_config'][$key]);
      }
    }

    return $array;
  }

  public function getGroups()
  {
    $groups = array('General');
    foreach ($this as $key => $value)
    {
      if ($value instanceof sfFormFieldSchema)
      {
        $groups[] = $key;
      }
    }
    return $groups;
  }

  public function getGroupSettings($name)
  {
    $settings = array();
    foreach ($this[$name] as $key => $value)
    {
      $settings[] = $key;
    }
    return $settings;
  }

  public function renderGroup($name)
  {
    if ($name == 'General')
    {
      $settings = array();
      foreach ($this as $key => $value)
      {
        if (!$value instanceof sfFormFieldSchema)
        {
          $settings[] = $key;
        }
      }
      $html = $this->renderFieldSet($name, $this, $settings);
    } else {
      $settings = $this->getGroupSettings($name);
      $html = $this->renderFieldSet($name, $this[$name], $settings);
    }
    return $html;
  }

  public function renderFieldSet($name, $form, $fields)
  {
    $html = '';
    foreach ($fields as $field)
    {
      if (!$form[$field]->isHidden())
      {
        $html .= '<div class="sf_admin_form_row">';
        $html .= $form[$field]->renderLabel();
        $html .= $form[$field];
        $html .= $form[$field]->renderHelp();
        $html .= '</div>';
      }
    }
    return $html;
  }
}