<?php

class sfSympalPluginUninstallTask extends sfBaseTask
{
  protected function configure()
  {
    $this->addArguments(array(
      new sfCommandArgument('name', sfCommandArgument::REQUIRED, 'The name of the functionality. i.e. sfSympal#NAME#Plugin'),
    ));

    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_OPTIONAL, 'The application name', sfSympalToolkit::getDefaultApplication()),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      new sfCommandOption('delete', null, sfCommandOption::PARAMETER_NONE, 'Delete the plugin files.'),
      new sfCommandOption('no-confirmation', null, sfCommandOption::PARAMETER_NONE, 'Do not ask for confirmation'),
    ));

    $this->aliases = array();
    $this->namespace = 'sympal';
    $this->name = 'plugin-uninstall';
    $this->briefDescription = 'Uninstall a sympal plugin to an existing sympal installation';

    $this->detailedDescription = <<<EOF
The [sympal:plugin-uninstall|INFO] is a task to uninstall a plugin to an existing sympal installation.
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    if (!$options['no-confirmation'] && !$this->askConfirmation(array('This command will uninstall and remove the sympal plugin named '.sfSympalPluginToolkit::getLongPluginName($arguments['name']), 'Are you sure you want to proceed? (y/N)'), 'QUESTION_LARGE', false))
    {
      $this->logSection('sympal', 'Plugin uninstall aborted');

      return 1;
    }

    $databaseManager = new sfDatabaseManager($this->configuration);
    $pluginManager = sfSympalPluginManager::getActionInstance($arguments['name'], 'uninstall', $this->configuration, $this->formatter);
    $pluginManager->uninstall($options['delete']);
  }
}