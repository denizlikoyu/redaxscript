<?php
namespace Redaxscript\Head;

use Redaxscript\Singleton;

/**
 * abstract class to create a head class
 *
 * @since 3.0.0
 *
 * @package Redaxscript
 * @category Head
 * @author Henry Ruhs
 */

abstract class HeadAbstract extends Singleton implements HeadInterface
{
	/**
	 * collection namespace
	 *
	 * @var string
	 */

	protected static $_namespace = 'Redaxscript\Head';

	/**
	 * collection of the head
	 *
	 * @var array
	 */

	protected static $_collectionArray = [];

	/**
	 * stringify the collection
	 *
	 * @since 3.0.0
	 *
	 * @return string
	 */

	public function __toString()
	{
		$render = $this->render();
		if ($render)
		{
			return $render;
		}
		return '<!-- ' . self::$_namespace . ' -->';
	}

	/**
	 * init the class
	 *
	 * @param string $namespace collection sub namespace
	 *
	 * @since 3.0.0
	 *
	 * @return HeadAbstract
	 */

	public function init($namespace = null)
	{
		self::$_namespace = get_called_class();
		if ($namespace)
		{
			self::$_namespace .= '\\' . ucfirst($namespace);
		}
		return $this;
	}

	/**
	 * append to the collection
	 *
	 * @since 3.0.0
	 *
	 * @param mixed $attribute name or set of attributes
	 * @param string $value value of the attribute
	 *
	 * @return HeadAbstract
	 */

	public function append($attribute = null, $value = null)
	{
		if (is_array($attribute))
		{
			self::$_collectionArray[self::$_namespace][] = array_map('trim', $attribute);
		}
		else if (strlen($attribute) && strlen($value))
		{
			self::$_collectionArray[self::$_namespace][] =
			[
				trim($attribute) => trim($value)
			];
		}
		return $this;
	}

	/**
	 * prepend to the collection
	 *
	 * @since 3.0.0
	 *
	 * @param mixed $attribute name or set of attributes
	 * @param string $value value of the attribute
	 *
	 * @return HeadAbstract
	 */

	public function prepend($attribute = null, $value = null)
	{
		if (!is_array(self::$_collectionArray[self::$_namespace]))
		{
			self::$_collectionArray[self::$_namespace] = [];
		}
		if (is_array($attribute))
		{
			array_unshift(self::$_collectionArray[self::$_namespace], array_map('trim', $attribute));
		}
		else if (strlen($attribute) && strlen($value))
		{
			array_unshift(self::$_collectionArray[self::$_namespace],
			[
				trim($attribute) => trim($value)
			]);
		}
		return $this;
	}

	/**
	 * remove from to the collection
	 *
	 * @since 3.0.0
	 *
	 * @param string $attribute name of attribute
	 * @param string $value value of the attribute
	 *
	 * @return HeadAbstract
	 */

	public function remove($attribute = null, $value = null)
	{
		foreach (self::$_collectionArray[self::$_namespace] as $collectionKey => $collectionValue)
		{
			if ($collectionValue[$attribute] === $value)
			{
				unset(self::$_collectionArray[self::$_namespace][$collectionKey]);
			}
		}
		return $this;
	}

	/**
	 * clear the collection
	 *
	 * @since 3.0.0
	 */

	public function clear()
	{
		self::$_collectionArray[self::$_namespace] = [];
		return $this;
	}
}