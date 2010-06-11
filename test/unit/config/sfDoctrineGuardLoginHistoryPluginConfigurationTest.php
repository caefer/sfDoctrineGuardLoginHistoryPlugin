<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

/**
 * This file is part of the sfDoctrineGuardLoginHistoryPlugin unit tests package.
 * (c) 2010 Christian Schaefer <caefer@ical.ly>>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @package    sfDoctrineGuardLoginHistoryPluginUnitTests
 * @author     Christian Schaefer <caefer@ical.ly>
 * @version    SVN: $Id: sfRawFileCache.class.php 63 2010-03-09 04:34:28Z caefer $
 */

/** central bootstrap for unit tests */
require_once dirname(__FILE__).'/../../bootstrap/unit.php';
/** PHPUnit Framework */
require_once 'PHPUnit/Framework.php';

/**
 * PHPUnit test for sfDoctrineGuardLoginHistoryPluginConfiguration
 *
 * @package    sfDoctrineGuardLoginHistoryPluginUnitTests
 * @subpackage config
 * @author     Christian Schaefer <caefer@ical.ly>
 */
class sfDoctrineGuardLoginHistoryPluginConfigurationTest extends PHPUnit_Framework_TestCase
{
  public function testInitialize()
  {
    $dispatcher = $this->projectConfiguration->getEventDispatcher();
    $change_authentication = count($dispatcher->getListeners('user.change_authentication'));

    $this->pluginConfiguration->initialize();

    $this->assertEquals($change_authentication + 1, count($dispatcher->getListeners('user.change_authentication')));
  }

  protected function setUp()
  {
    $this->projectConfiguration = new ProjectConfiguration(dirname(__FILE__).'/../../fixtures/project/');
    $this->pluginConfiguration = new sfDoctrineGuardLoginHistoryPluginConfiguration($this->projectConfiguration);
    if(!sfContext::hasInstance('frontend'))
    {
      sfContext::createInstance($this->projectConfiguration->getApplicationConfiguration('frontend', 'test', true));
    }
  }
}
