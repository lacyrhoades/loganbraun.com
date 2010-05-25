<?php

class sfSympalInstallForm extends BaseForm
{
  public function setup()
  {
    $this->embedForm('user', new sfSympalUserInstallForm());
    $this->embedForm('database', new sfSympalDatabaseInstallForm());

    $this->widgetSchema->setNameFormat('install[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }  
}

class sfSympalUserInstallForm extends BaseForm
{
  public function setup()
  {
    $this->setWidgets(array(
      'first_name'          => new sfWidgetFormInput(),
      'last_name'           => new sfWidgetFormInput(),
      'email_address'       => new sfWidgetFormInput(),
      'username'            => new sfWidgetFormInput(),
      'password'            => new sfWidgetFormInputPassword(),
    ));

    $this->setValidators(array(
      'first_name'          => new sfValidatorString(array('max_length' => 255)),
      'last_name'           => new sfValidatorString(array('max_length' => 255)),
      'email_address'       => new sfValidatorString(array('max_length' => 255)),
      'username'            => new sfValidatorString(array('max_length' => 255)),
      'password'            => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema['password'] = new sfWidgetFormInputPassword();
    $this->widgetSchema['password_again'] = new sfWidgetFormInputPassword();
    $this->validatorSchema['password_again'] = clone $this->validatorSchema['password'];

    $this->widgetSchema->moveField('password_again', 'after', 'password');

    $this->widgetSchema->setNameFormat('install[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->mergePostValidator(new sfValidatorSchemaCompare('password', sfValidatorSchemaCompare::EQUAL, 'password_again', array(), array('invalid' => 'The two passwords must be the same.')));

    parent::setup();
  }
}

class sfSympalDatabaseInstallForm extends BaseForm
{
  public function setup()
  {
    $typeChoices = array(
      '' => '',
      'mysql' => 'MySQL',
      'sqlite' => 'Sqlite',
      'pgsql' => 'PostgreSQL',
      'oracle' => 'Oracle Adapter',
      'oci' => 'Oracle PDO',
      'mssql' => 'MsSQL'
    );

    $this->setWidgets(array(
      'type'       => new sfWidgetFormChoice(array('choices' => $typeChoices)),
      'host'       => new sfWidgetFormInput(),
      'name'       => new sfWidgetFormInput(),
      'username'   => new sfWidgetFormInput(),
      'password'   => new sfWidgetFormInputPassword(),
    ));

    $this->setValidators(array(
      'type'        => new sfValidatorChoice(array('required' => false, 'choices' => array_keys($typeChoices))),
      'host'        => new sfValidatorString(array('required' => false)),
      'name'        => new sfValidatorString(array('required' => false)),
      'username'    => new sfValidatorString(array('required' => false)),
      'password'    => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setLabel('name', 'Database Name');
    $this->widgetSchema['password'] = new sfWidgetFormInputPassword();
    $this->widgetSchema['password_again'] = new sfWidgetFormInputPassword();
    $this->validatorSchema['password_again'] = clone $this->validatorSchema['password'];

    $this->widgetSchema->setNameFormat('database[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->mergePostValidator(new sfValidatorSchemaCompare('password', sfValidatorSchemaCompare::EQUAL, 'password_again', array(), array('invalid' => 'The two passwords must be the same.')));

    parent::setup();
  }
}