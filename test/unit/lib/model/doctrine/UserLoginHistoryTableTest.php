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
require_once dirname(__FILE__).'/../../../../bootstrap/unit.php';
/** mock session user class */
require_once dirname(__FILE__).'/../../../../fixtures/lib/user/mockUser.class.php';
/** PHPUnit Framework */
require_once 'PHPUnit/Framework.php';

/**
 * PHPUnit test for sfDoctrineGuardLoginHistoryPluginConfiguration
 *
 * @package    sfDoctrineGuardLoginHistoryPluginUnitTests
 * @subpackage config
 * @author     Christian Schaefer <caefer@ical.ly>
 */
class PluginUserLoginHistoryTableTest extends PHPUnit_Framework_TestCase
{
  public function testWriteLoginHistory()
  {
    $sessionUser = new mockUser();

    $event = new sfEvent($sessionUser, 'user.change_authentication', array('authenticated' => true));
    $before = Doctrine_Query::create()->from('UserLoginHistory h')->count();
    UserLoginHistoryTable::writeLoginHistory($event);
    $this->assertEquals($before+1, Doctrine_Query::create()->from('UserLoginHistory h')->count());

    $event = new sfEvent($sessionUser, 'user.change_authentication', array('authenticated' => false));
    UserLoginHistoryTable::writeLoginHistory($event);
    $this->assertEquals($before+2, Doctrine_Query::create()->from('UserLoginHistory h')->count());
  }

  protected function setUp()
  {
    $conn = Doctrine_Manager::connection('sqlite://memory', 'doctrine');
    Doctrine_Manager::getInstance()->setCurrentConnection('doctrine');
    try
    {
      Doctrine_Manager::getInstance()->dropDatabases('doctrine');
    }
    catch(Doctrine_Export_Exception $e){ /* database did not exist so ignore.. */ }
    Doctrine_Manager::getInstance()->createDatabases('doctrine');
    Doctrine_Core::createTablesFromArray(array('sfGuardUser', 'UserLoginHistory'));

    $sfGuardUser = new sfGuardUser();
    $sfGuardUser->username = 'caefer';
    $sfGuardUser->first_name = 'Christian';
    $sfGuardUser->last_name = 'Schaefer';
    $sfGuardUser->email_address = 'caefer@ical.ly';
    $sfGuardUser->save();
  }

  protected function tearDown()
  {
    try
    {
      Doctrine_Manager::getInstance()->dropDatabases('doctrine');
    }
    catch(Doctrine_Export_Exception $e){ /* database did not exist so ignore.. */ }
  }
}
