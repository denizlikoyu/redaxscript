<?php
namespace Redaxscript\Modules\SyntaxHighlighter;

use Redaxscript\Head;
use Redaxscript\Module;

/**
 * javascript powered syntax highlighter
 *
 * @since 2.6.0
 *
 * @package Redaxscript
 * @category Modules
 * @author Henry Ruhs
 */

class SyntaxHighlighter extends Module
{
	/**
	 * array of the module
	 *
	 * @var array
	 */

	protected static $_moduleArray =
	[
		'name' => 'Syntax highlighter',
		'alias' => 'SyntaxHighlighter',
		'author' => 'Redaxmedia',
		'description' => 'JavaScript powered syntax highlighter',
		'version' => '3.0.0'
	];

	/**
	 * renderStart
	 *
	 * @since 3.0.0
	 */

	public static function renderStart()
	{
		/* link */

		$link = Head\Link::getInstance();
		$link
			->init()
			->appendFile('//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.7.0/styles/atom-one-dark.min.css');

		/* script */

		$script = Head\Script::getInstance();
		$script
			->init('foot')
			->appendFile('//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.7.0/highlight.min.js')
			->appendFile('modules/SyntaxHighlighter/assets/scripts/init.js')
			->appendFile('modules/SyntaxHighlighter/assets/scripts/syntax_highlighter.js');
	}
}
