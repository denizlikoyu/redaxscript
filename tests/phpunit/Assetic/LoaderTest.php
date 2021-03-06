<?php
namespace Redaxscript\Tests\Assetic;

use Redaxscript\Assetic;
use Redaxscript\Registry;
use Redaxscript\Tests\TestCaseAbstract;
use org\bovigo\vfs\vfsStream as Stream;

/**
 * LoaderTest
 *
 * @since 3.0.0
 *
 * @package Redaxscript
 * @category Tests
 * @author Henry Ruhs
 */

class LoaderTest extends TestCaseAbstract
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
	 * @since 3.0.0
	 */

	public function setUp()
	{
		$this->_registry = Registry::getInstance();
		Stream::setup('root', 0777, $this->getProvider('tests/provider/Assetic/loader_set_up.json'));
	}

	/**
	 * providerConcat
	 *
	 * @since 3.0.0
	 *
	 * @return array
	 */

	public function providerConcat()
	{
		return $this->getProvider('tests/provider/Assetic/loader_concat.json');
	}

	/**
	 * providerRewrite
	 *
	 * @since 3.0.0
	 *
	 * @return array
	 */

	public function providerRewrite()
	{
		return $this->getProvider('tests/provider/Assetic/loader_rewrite.json');
	}

	/**
	 * testConcat
	 *
	 * @since 3.0.0
	 *
	 * @param array $registryArray
	 * @param array $collectionArray
	 * @param array $expectArray
	 *
	 * @dataProvider providerConcat
	 */

	public function testConcat($registryArray = [], $collectionArray = [], $expectArray = [])
	{
		/* setup */

		$optionArray =
		[
			'directory' => Stream::url('root/cache/styles'),
			'extension' => 'css',
			'attribute' => 'href',
			'lifetime' => 86400
		];
		$this->_registry->init($registryArray);
		$loader = new Assetic\Loader($this->_registry);
		$loader
			->init($collectionArray, 'css')
			->concat($optionArray)
			->concat($optionArray);

		/* actual */

		$actualArray = $loader->getCollectionArray();

		/* compare */

		$this->assertEquals($expectArray, $actualArray);
	}

	/**
	 * testRewrite
	 *
	 * @since 3.0.0
	 *
	 * @param array $collectionArray
	 * @param array $rewriteArray
	 * @param string $expect
	 *
	 * @dataProvider providerRewrite
	 */

	public function testRewrite($collectionArray = [], $rewriteArray = [], $expect = null)
	{
		/* setup */

		$optionArray =
		[
			'directory' => Stream::url('root/cache/styles'),
			'extension' => 'css',
			'attribute' => 'href',
			'lifetime' => 86400
		];
		$loader = new Assetic\Loader(Registry::getInstance());
		$loader
			->init($collectionArray, 'css')
			->concat($optionArray, $rewriteArray)
			->concat($optionArray, $rewriteArray);

		/* actual */

		$file = $loader->getCollectionArray()['bundle']['href'];
		$actual = file_get_contents($file);

		/* compare */

		$this->assertEquals($expect, $actual);
	}
}
