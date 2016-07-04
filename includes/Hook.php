<?php
namespace Redaxscript;

/**
 * parent class to handle module hooks
 *
 * @since 2.2.0
 *
 * @package Redaxscript
 * @category Hook
 * @author Henry Ruhs
 */

class Hook
{
	/**
	 * instance of the registry class
	 *
	 * @var object
	 */

	protected static $_registry;

	/**
	 * module namespace
	 *
	 * @var string
	 */

	protected static $_namespace = 'Redaxscript\Modules\\';

	/**
	 * array of installed and enabled modules
	 *
	 * @var array
	 */

	protected static $_moduleArray = array();

	/**
	 * array of triggered events
	 *
	 * @var array
	 */

	protected static $_eventArray = array();

	/**
	 * constructor of the class
	 *
	 * @since 2.6.0
	 *
	 * @param Registry $registry instance of the registry class
	 */

	public static function construct(Registry $registry)
	{
		self::$_registry = $registry;
	}

	/**
	 * init the class
	 *
	 * @since 2.6.0
	 */

	public static function init()
	{
		$accessValidator = new Validator\Access();
		$modulesDirectory = new Directory();
		$modulesDirectory->init('modules');
		$modulesAvailable = $modulesDirectory->getArray();
		$modulesInstalled = Db::forTablePrefix('modules')->where('status', 1)->findMany();

		/* process modules */

		foreach ($modulesInstalled as $module)
		{
			/* validate access */

			if (in_array($module->alias, $modulesAvailable) && $accessValidator->validate($module->access, self::$_registry->get('myGroups')) === Validator\ValidatorInterface::PASSED)
			{
				self::$_moduleArray[$module->alias] = $module->alias;
			}
		}
	}

	/**
	 * get the module array
	 *
	 * @since 2.2.0
	 *
	 * @return array
	 */

	public static function getModuleArray()
	{
		return self::$_moduleArray;
	}

	/**
	 * get the event array
	 *
	 * @since 3.0.0
	 *
	 * @return array
	 */

	public static function getEventArray()
	{
		return self::$_eventArray;
	}

	/**
	 * trigger the module hook
	 *
	 * @since 3.0.0
	 *
	 * @param string $event name of the module event
	 * @param array $parameterArray parameter of the module hook
	 *
	 * @return mixed
	 */

	public static function trigger($event = null, $parameterArray = array())
	{
		$output = null;

		/* trigger event */

		foreach (self::$_moduleArray as $module)
		{
			$object = self::$_namespace . $module . '\\' . $module;
			self::$_eventArray[$event][$module] = false;

			/* method exists */

			if (method_exists($object, $event))
			{
				self::$_eventArray[$event][$module] = true;
				$temp = call_user_func_array(array(
					$object,
					$event
				), $parameterArray);

				/* merge or concat */

				if (is_array($temp))
				{
					$output = array_merge(is_array($output) ? $output : array(), $temp);
				}
				else
				{
					$output .= $temp;
				}
			}
		}
		return $output;
	}
}
