<?php
namespace Redaxscript\Modules\ShareThis;

use Redaxscript\Module;

/**
 * children class to store module config
 *
 * @since 2.2.0
 *
 * @package Redaxscript
 * @category Modules
 * @author Henry Ruhs
 */

class Config extends Module
{
	/**
	 * array of config
	 *
	 * @var array
	 */

	protected static $_configArray =
	[
		'className' =>
		[
			'link' => 'rs-js-link-share-this rs-link-share-this',
			'list' => 'rs-list-share-this rs-fn-clearfix'
		],
		'network' =>
		[
			'facebook' =>
			[
				'url' => 'http://facebook.com/sharer.php?u=',
				'className' => 'rs-link-facebook',
				'attribute' => 'data-type="facebook"'
			],
			'googleplusone' =>
			[
				'url' => 'http://plusone.google.com/_/+1/confirm?url=',
				'className' => 'rs-link-googleplusone'
			],
			'twitter' =>
			[
				'url' => 'http://twitter.com/share?url=',
				'className' => 'rs-link-twitter',
				'height' => 340
			],
			'pinterest' =>
			[
				'url' => 'http://pinterest.com/pin/create/button/?url=',
				'className' => 'rs-link-pinterest'
			],
			'linkedin' =>
			[
				'url' => 'http://linkedin.com/shareArticle?url=',
				'className' => 'rs-link-linkedin',
				'height' => 490,
				'width' => 850
			],
			'stumbleupon' =>
			[
				'url' => 'http://stumbleupon.com/submit?url=',
				'className' => 'rs-link-stumbleupon'
			],
			'delicious' =>
			[
				'url' => 'http://del.icio.us/post?url=',
				'className' => 'rs-link-delicious',
				'height' => 580
			]
		]
	];
}
