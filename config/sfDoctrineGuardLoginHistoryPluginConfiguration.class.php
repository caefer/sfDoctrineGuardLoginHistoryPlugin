<?php

/**
 * sfDoctrineGuardLoginHistoryPlugin configuration.
 * 
 * @package     sfDoctrineGuardLoginHistoryPlugin
 * @subpackage  config
 * @author      caefer <caefer@ical.ly>
 * @version     SVN: $Id: PluginConfiguration.class.php 17207 2009-04-10 15:36:26Z Kris.Wallsmith $
 */
class sfDoctrineGuardLoginHistoryPluginConfiguration extends sfPluginConfiguration
{
  const VERSION = '1.0.0-DEV';

  /**
   * @see sfPluginConfiguration
   */
  public function initialize()
  {
    $this->dispatcher->connect('user.change_authentication', array('UserLoginHistoryTable', 'writeLoginHistory'));
  }
}
