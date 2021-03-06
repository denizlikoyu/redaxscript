<?php
namespace Redaxscript\Tests\Admin\Html;

use Redaxscript\Admin;
use Redaxscript\Language;
use Redaxscript\Registry;
use Redaxscript\Tests\TestCaseAbstract;

/**
 * FormTest
 *
 * @since 3.0.0
 *
 * @package Redaxscript
 * @category Tests
 * @author Henry Ruhs
 */

class FormTest extends TestCaseAbstract
{
	/**
	 * instance of the registry class
	 *
	 * @var object
	 */

	protected $_registry;

	/**
	 * instance of the language class
	 *
	 * @var object
	 */

	protected $_language;

	/**
	 * setUp
	 *
	 * @since 3.0.0
	 */

	public function setUp()
	{
		$this->_registry = Registry::getInstance();
		$this->_language = Language::getInstance();
	}

	/**
	 * providerCreate
	 *
	 * @since 3.0.0
	 *
	 * @return array
	 */

	public function providerCreate()
	{
		return $this->getProvider('tests/provider/Admin/Html/form_create.json');
	}

	/**
	 * testCreate
	 *
	 * @since 3.0.0
	 *
	 * @param array $attributeArray
	 * @param array $optionArray
	 * @param string $expect
	 *
	 * @dataProvider providerCreate
	 */

	public function testCreate($attributeArray = [], $optionArray = [], $expect = null)
	{
		/* setup */

		$form = new Admin\Html\Form($this->_registry, $this->_language);
		$form->init($attributeArray, $optionArray);

		/* actual */

		$actual = $form;

		/* compare */

		$this->assertEquals($expect, $actual);
	}
}
