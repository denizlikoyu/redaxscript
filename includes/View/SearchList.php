<?php
namespace Redaxscript\View;

use Redaxscript\Db;
use Redaxscript\Html;
use Redaxscript\Hook;
use Redaxscript\Language;
use Redaxscript\Registry;
use Redaxscript\Validator;

/**
 * children class to generate the search list
 *
 * @since 3.0.0
 *
 * @package Redaxscript
 * @category View
 * @author Henry Ruhs
 * @author Balázs Szilágyi
 */

class SearchList implements ViewInterface
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
	 * constructor of the class
	 *
	 * @since 3.0.0
	 *
	 * @param Registry $registry instance of the registry class
	 * @param Language $language instance of the language class
	 */

	public function __construct(Registry $registry, Language $language)
	{
		$this->_registry = $registry;
		$this->_language = $language;
	}

	/**
	 * render the view
	 *
	 * @since 3.0.0
	 *
	 * @param array $resultArray array for the result
	 *
	 * @return string
	 */

	public function render($resultArray = array())
	{
		$output = Hook::trigger('searchListStart');
		$accessValidator = new Validator\Access();
		
		/* html elements */

		$titleElement = new Html\Element();
		$titleElement->init('h2', array(
			'class' => 'rs-title-content rs-title-result'
		));
		$listElement = new Html\Element();
		$listElement->init('ol', array(
			'class' => 'rs-list-result'
		));
		$itemElement = new Html\Element();
		$itemElement->init('li');
		$linkElement = new Html\Element();
		$linkElement->init('a', array(
			'class' => 'rs-link-result'
		));
		$textElement = new Html\Element();
		$textElement->init('span', array(
			'class' => 'rs-text-result-date'
		));
			
		/* process results */

		foreach ($resultArray as $table => $result)
		{
			$outputItem = null;
			if ($result)
			{
				/* collect item output */

				foreach ($result as $value)
				{
					if ($accessValidator->validate($result->access, Registry::get('myGroups')) === Validator\ValidatorInterface::PASSED)
					{
						$textDate = date(Db::getSetting('date'), strtotime($value->date));
						$linkElement
							->attr('href', build_route($table, $value->id))
							->text($value->title ? $value->title : $value->author);
						$textElement->text($textDate);
						$outputItem .= $itemElement->html($linkElement . $textElement);
					}					
				}

				/* collect output */

				if ($outputItem)
				{
					$titleElement->text($this->_language->get($table));
					$listElement->html($outputItem);
					$output .= $titleElement . $listElement;
				}
			}
		}
		$output .= Hook::trigger('searchListEnd');
		return $output;
	}
}
