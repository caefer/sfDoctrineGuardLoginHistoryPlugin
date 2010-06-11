<?php

if (!isset($_SERVER['SYMFONY']))
{
  throw new RuntimeException('Could not find symfony core libraries.');
}

require_once $_SERVER['SYMFONY'].'/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{
  public function setup()
  {
    $this->setPlugins(array('sfDoctrinePlugin', 'sfDoctrineGuardPlugin', 'sfDoctrineGuardLoginHistoryPlugin'));
    $this->setPluginPath('sfDoctrineGuardPlugin', dirname(__FILE__).'/../../../../../sfDoctrineGuardPlugin');
    $this->setPluginPath('sfDoctrineGuardLoginHistoryPlugin', dirname(__FILE__).'/../../../..');
  }
}
