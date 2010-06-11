<?php
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
require_once dirname(__FILE__).'/bootstrap/unit.php';
/** PHPUnit Framework */
require_once 'PHPUnit/Framework.php';

/**
 * PHPUnit test suite for sfDoctrineGuardLoginHistoryPlugin
 *
 * @package    sfDoctrineGuardLoginHistoryPluginUnitTests
 * @subpackage TestSuite
 * @author     Christian Schaefer <caefer@ical.ly>
 */
class sfDoctrineGuardLoginHistoryPluginTests
{
  public static function suite()
  {
    global $configuration, $plugin_configuration;
    $suite = new PHPUnit_Framework_TestSuite('sfDoctrineGuardLoginHistoryPlugin');

    // loading plugin configurations
    $configuration = ProjectConfiguration::getActive();
    $pluginConfig = $configuration->getPluginConfiguration('sfDoctrineGuardLoginHistoryPlugin');

    // instantiate a fake symfony unit test task to retrieve all connected tests for this plugin
    $task = new sfTestUnitTask($configuration->getEventDispatcher(), new sfFormatter());
    $event = new sfEvent($task, 'task.test.filter_test_files', array('arguments' => array('name' => array()), 'options' => array()));
    $files = $pluginConfig->filterTestFiles($event, array());
    $suite->addTestFiles($files);

    return $suite;
  }
}
