<?php
namespace Redaxscript\Tests;

use Redaxscript\Hook;
use Redaxscript\Registry;

/**
 * HookTest
 *
 * @since 2.4.0
 *
 * @package Redaxscript
 * @category Tests
 * @author Henry Ruhs
 */

class HookTest extends TestCaseAbstract
{
	/**
	 * instance of the registry class
	 *
	 * @var object
	 */

	protected $_registry;

	/**
	 * setUp
	 *
	 * @since 2.4.0
	 */

	public function setUp()
	{
		$this->_registry = Registry::getInstance();
	}

	/**
	 * testGetModuleArray
	 *
	 * @since 2.4.0
	 */

	public function testGetModuleArray()
	{
		/* setup */

		Hook::construct($this->_registry);
		Hook::init();

		/* actual */

		$actualArray = Hook::getModuleArray();

		/* compare */

		$this->assertArrayHasKey('TestDummy', $actualArray);
	}

	/**
	 * testGetEventArray
	 *
	 * @since 2.4.0
	 */

	public function testGetEventArray()
	{
		/* setup */

		Hook::construct($this->_registry);
		Hook::init();
		Hook::trigger('render');

		/* actual */

		$actualArray = Hook::getEventArray();

		/* compare */

		$this->assertArrayHasKey('render', $actualArray);
	}

	/**
	 * testCollect
	 *
	 * @since 2.4.0
	 */

	public function testCollect()
	{
		/* setup */

		Hook::construct($this->_registry);
		Hook::init();

		/* actual */

		$actualArray = Hook::collect('adminPanelNotification');

		/* compare */

		$this->assertEquals($actualArray['info']['Test dummy'][0], 'test');
	}

	/**
	 * testCollectInvalid
	 *
	 * @since 3.0.0
	 */

	public function testCollectInvalid()
	{
		/* setup */

		Hook::construct($this->_registry);
		Hook::init();

		/* actual */

		$actual = Hook::collect('invalidMethod');

		/* compare */

		$this->assertEmpty($actual);
	}

	/**
	 * testTrigger
	 *
	 * @since 2.4.0
	 */

	public function testTrigger()
	{
		/* setup */

		Hook::construct($this->_registry);
		Hook::init();

		/* actual */

		$actual = Hook::trigger('render');

		/* compare */

		$this->assertEquals(0, $actual);
	}

	/**
	 * testTriggerInvalid
	 *
	 * @since 2.4.0
	 */

	public function testTriggerInvalid()
	{
		/* setup */

		Hook::construct($this->_registry);
		Hook::init();

		/* actual */

		$actual = Hook::trigger('invalidMethod');

		/* compare */

		$this->assertNull($actual);
	}
}
