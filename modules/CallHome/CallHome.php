<?php
namespace Redaxscript\Modules\CallHome;

use Redaxscript\Filter;
use Redaxscript\Head;
use Redaxscript\Language;
use Redaxscript\Module;
use Redaxscript\Reader;
use Redaxscript\Registry;

/**
 * provide version and news updates
 *
 * @since 2.2.0
 *
 * @package Redaxscript
 * @category Modules
 * @author Henry Ruhs
 */

class CallHome extends Module
{
	/**
	 * array of the module
	 *
	 * @var array
	 */

	protected static $_moduleArray =
	[
		'name' => 'Call home',
		'alias' => 'CallHome',
		'author' => 'Redaxmedia',
		'description' => 'Provide version and news updates',
		'version' => '3.0.0'
	];

	/**
	 * renderStart
	 *
	 * @since 3.0.0
	 */

	public static function renderStart()
	{
		if (Registry::get('loggedIn') === Registry::get('token') && Registry::get('firstParameter') === 'admin')
		{
			$script = Head\Script::getInstance();
			$script
				->init('foot')
				->appendFile('//google-analytics.com/analytics.js')
				->appendFile('modules/CallHome/assets/scripts/init.js')
				->appendFile('modules/CallHome/assets/scripts/call_home.js');
		}
	}

	/**
	 * adminPanelNotification
	 *
	 * @since 3.0.0
	 *
	 * @return array
	 */

	public static function adminPanelNotification()
	{
		$output = [];
		$reader = new Reader();
		$aliasFilter = new Filter\Alias();
		$version = $aliasFilter->sanitize(Language::get('version', '_package'));

		/* load result */

		$urlVersion = 'http://service.redaxscript.com/version/' . $version;
		$urlNews = 'http://service.redaxscript.com/news/' . $version;
		$resultVersion = $reader->loadJSON($urlVersion)->getArray();
		$resultNews = $reader->loadJSON($urlNews)->getArray();

		/* merge as needed */

		if (is_array($resultVersion))
		{
			$output = array_merge_recursive($output, $resultVersion);
		}
		if (is_array($resultNews))
		{
			$output = array_merge_recursive($output, $resultNews);
		}
		return $output;
	}
}
