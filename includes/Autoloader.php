<?php
namespace Redaxscript;

/**
 * parent class to load required class files
 *
 * @since 3.0.0
 *
 * @package Redaxscript
 * @category Autoloader
 * @author Henry Ruhs
 */

class Autoloader
{
	/**
	 * array of the autoload
	 *
	 * @var array
	 */

	protected $_autoloadArray =
	[
		'Redaxscript' => 'includes',
		'Redaxscript\Modules' => 'modules',
		'libraries'
	];

	/**
	 * file extension
	 *
	 * @var string
	 */

	protected $_fileExtension = '.php';

	/**
	 * init the class
	 *
	 * @since 3.0.0
	 *
	 * @param mixed $autoload key or collection of the autoload
	 */

	public function init($autoload = null)
	{
		/* handle autoload */

		if (is_string($autoload))
		{
			$autoload =
			[
				$autoload
			];
		}
		if (is_array($autoload))
		{
			$this->_autoloadArray = array_merge($this->_autoloadArray, $autoload);
		}

		/* register autoload */

		spl_autoload_register(
		[
			__CLASS__,
			'_load'
		]);
	}

	/**
	 * load the class file
	 *
	 * @since 3.0.0
	 *
	 * @param string $className name of the class
	 */

	protected function _load($className = null)
	{
		foreach ($this->_autoloadArray as $namespace => $directory)
		{
			$file = $this->_getFile($className, $namespace);
			if (file_exists($directory . '/' . $file))
			{
				include_once($directory . '/' . $file);
			}
		}
	}

	/**
	 * get the file
	 *
	 * @since 3.0.0
	 *
	 * @param string $className name of the class
	 * @param string $namespace
	 *
	 * @return string
	 */

	protected function _getFile($className = null, $namespace = null)
	{
		$searchArray =
		[
			$namespace,
			'\\'
		];
		$replaceArray =
		[
			null,
			'/'
		];
		return str_replace($searchArray, $replaceArray, $className) . $this->_fileExtension;
	}
}
