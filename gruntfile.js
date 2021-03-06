module.exports = function (grunt)
{
	'use strict';

	grunt.path = require('path');

	/* config grunt */

	grunt.initConfig(
	{
		version: grunt.file.readJSON('package.json').version,
		jscs:
		{
			dependency:
			{
				src:
				[
					'gruntfile.js'
				]
			},
			base:
			{
				src:
				[
					'assets/scripts/*.js'
				]
			},
			modules:
			{
				src:
				[
					'modules/*/assets/scripts/*.js'
				]
			},
			templates:
			{
				src:
				[
					'templates/*/assets/scripts/*.js'
				]
			},
			options:
			{
				config: '.jscsrc'
			}
		},
		jshint:
		{
			dependency:
			{
				src:
				[
					'gruntfile.js'
				]
			},
			base:
			{
				src:
				[
					'assets/scripts/*.js'
				]
			},
			modules:
			{
				src:
				[
					'modules/*/assets/scripts/*.js'
				]
			},
			templates:
			{
				src:
				[
					'templates/*/assets/scripts/*.js'
				]
			},
			options:
			{
				jshintrc: '.jshintrc'
			}
		},
		jsonlint:
		{
			dependency:
			{
				src:
				[
					'composer.json',
					'package.json'
				]
			},
			ruleset:
			{
				src:
				[
					'.htmlhintrc',
					'.jscsrc',
					'.jshintrc',
					'.stylelintrc',
					'.tocgen'
				]
			},
			languages:
			{
				src:
				[
					'languages/*.json'
				]
			},
			modules:
			{
				src:
				[
					'modules/**/*.json'
				]
			},
			provider:
			{
				src:
				[
					'tests/provider/*.json'
				]
			}
		},
		htmlhint:
		{
			database:
			{
				src:
				[
					'database/**/*.phtml'
				]
			},
			modules:
			{
				src:
				[
					'modules/**/*.phtml'
				]
			},
			templates:
			{
				src:
				[
					'templates/**/*.phtml'
				]
			},
			options:
			{
				htmlhintrc: '.htmlhintrc'
			}
		},
		phpcs:
		{
			root:
			{
				src:
				[
					'index.php',
					'install.php'
				]
			},
			base:
			{
				src:
				[
					'includes/**/**/*.php',
					'assets/scripts/*.js',
					'assets/styles/*.css'
				]
			},
			modules:
			{
				src:
				[
					'modules/*/assets/scripts/*.js',
					'modules/*/assets/styles/*.css',
					'modules/**/**/*.php'
				]
			},
			templates:
			{
				src:
				[
					'templates/*/assets/scripts/*.js',
					'templates/*/assets/styles/*.css'
				]
			},
			benchs:
			{
				src:
				[
					'benchs/**/**/*.php'
				]
			},
			tests:
			{
				src:
				[
					'tests/**/**/*.php'
				]
			},
			options:
			{
				bin: grunt.option('fix') ? 'vendor/bin/phpcbf' : 'vendor/bin/phpcs',
				standard: 'phpcs.xml'
			}
		},
		diffJSON:
		{
			languages:
			{
				src:
				[
					'languages/*.json',
					'!languages/en.json'
				],
				dest: 'build/language.json'
			},
			options:
			{
				type: 'key',
				report:
				{
					obsolete: 'error',
					missing: 'error'
				}
			}
		},
		formatJSON:
		{
			languages:
			{
				src:
				[
					'languages/en.json'
				],
				dest: 'build/language.json',
				options:
				{
					remove:
					[
						'_package',
						'_index'
					]
				}
			}
		},
		uglify:
		{
			base:
			{
				src:
				[
					'assets/scripts/dialog.js',
					'assets/scripts/form.js',
					'assets/scripts/interface.js',
					'assets/scripts/misc.js'
				],
				dest: 'dist/scripts/base.min.js'
			},
			templateAdmin:
			{
				src:
				[
					'templates/admin/assets/scripts/alias.js',
					'templates/admin/assets/scripts/panel.js'
				],
				dest: 'templates/admin/dist/scripts/admin.min.js'
			},
			templateConsole:
			{
				src:
				[
					'templates/console/assets/scripts/console.js'
				],
				dest: 'templates/console/dist/scripts/console.min.js'
			},
			templateInstall:
			{
				src:
				[
					'templates/install/assets/scripts/install.js'
				],
				dest: 'templates/install/dist/scripts/install.min.js'
			}
		},
		postcss:
		{
			base:
			{
				src:
				[
					'assets/styles/_base.css'
				],
				dest: 'dist/styles/base.min.css',
				options:
				{
					processors:
					[
						require('postcss-import'),
						require('autoprefixer')(
						{
							browsers: 'last 2 versions'
						}),
						require('cssnano')(
						{
							autoprefixer: false,
							discardUnused: false
						})
					]
				}
			},
			templateAdmin:
			{
				src:
				[
					'templates/admin/assets/styles/_admin.css'
				],
				dest: 'templates/admin/dist/styles/admin.min.css'
			},
			templateConsole:
			{
				src:
				[
					'templates/console/assets/styles/_console.css'
				],
				dest: 'templates/console/dist/styles/console.min.css'
			},
			templateDefault:
			{
				src:
				[
					'templates/default/assets/styles/_default.css'
				],
				dest: 'templates/default/dist/styles/default.min.css'
			},
			templateSkeleton:
			{
				src:
				[
					'templates/skeleton/assets/styles/_skeleton.css'
				],
				dest: 'templates/skeleton/dist/styles/skeleton.min.css'
			},
			templateInstall:
			{
				src:
				[
					'templates/install/assets/styles/_install.css'
				],
				dest: 'templates/install/dist/styles/install.min.css'
			},
			templateWebsite:
			{
				src:
				[
					'templates/website/assets/styles/_website.css'
				],
				dest: 'templates/website/dist/styles/website.min.css'
			},
			modulePreview:
			{
				src:
				[
					'modules/Preview/assets/styles/_preview.css'
				],
				dest: 'modules/Preview/dist/styles/preview.min.css'
			},
			moduleTinymceContent:
			{
				src:
				[
					'modules/Tinymce/assets/styles/_content.css'
				],
				dest: 'modules/Tinymce/dist/styles/content.min.css'
			},
			moduleTinymceSkin:
			{
				src:
				[
					'modules/Tinymce/assets/styles/_skin.css'
				],
				dest: 'modules/Tinymce/dist/styles/skin.min.css'
			},
			stylelint:
			{
				src:
				[
					'assets/styles/*.css',
					'templates/*/assets/styles/*.css',
					'modules/*/assets/styles/*.css'
				],
				options:
				{
					processors:
					[
						require('stylelint'),
						require('postcss-reporter')(
						{
							throwError: true
						})
					]
				}
			},
			stylefmt:
			{
				src:
				[
					'assets/styles/*.css',
					'!assets/styles/_query.css',
					'!assets/styles/normalize.css',
					'templates/*/assets/styles/*.css',
					'modules/*/assets/styles/*.css'
				],
				options:
				{
					processors:
					[
						require('stylefmt')
					]
				}
			},
			colorguard:
			{
				src:
				[
					'templates/*/dist/styles/*.css',
					'modules/*/assets/styles/*.css'
				],
				options:
				{
					processors:
					[
						require('colorguard')(
						{
							threshold: 2,
							allowEquivalentNotation: true
						}),
						require('postcss-reporter')(
						{
							throwError: true
						})
					]
				}
			},
			options:
			{
				processors:
				[
					require('postcss-import'),
					require('postcss-custom-properties'),
					require('postcss-custom-media'),
					require('postcss-custom-selectors'),
					require('postcss-nesting'),
					require('postcss-extend'),
					require('postcss-color-gray'),
					require('postcss-color-function'),
					require('autoprefixer')(
					{
						browsers: 'last 2 versions'
					}),
					require('cssnano')(
					{
						autoprefixer: false,
						colormin: false,
						zindex: false
					})
				]
			}
		},
		webfont:
		{
			templateAdmin:
			{
				src:
				[
					'node_modules/material-design-icons/action/svg/production/ic_check_circle_24px.svg',
					'node_modules/material-design-icons/action/svg/production/ic_delete_24px.svg',
					'node_modules/material-design-icons/action/svg/production/ic_info_24px.svg',
					'node_modules/material-design-icons/action/svg/production/ic_lock_24px.svg',
					'node_modules/material-design-icons/action/svg/production/ic_power_settings_new_24px.svg',
					'node_modules/material-design-icons/action/svg/production/ic_settings_24px.svg',
					'node_modules/material-design-icons/action/svg/production/ic_visibility_off_24px.svg',
					'node_modules/material-design-icons/alert/svg/production/ic_error_24px.svg',
					'node_modules/material-design-icons/alert/svg/production/ic_warning_24px.svg',
					'node_modules/material-design-icons/communication/svg/production/ic_import_contacts_24px.svg',
					'node_modules/material-design-icons/communication/svg/production/ic_vpn_key_24px.svg',
					'node_modules/material-design-icons/content/svg/production/ic_add_24px.svg',
					'node_modules/material-design-icons/content/svg/production/ic_clear_24px.svg',
					'node_modules/material-design-icons/content/svg/production/ic_create_24px.svg',
					'node_modules/material-design-icons/content/svg/production/ic_remove_24px.svg',
					'node_modules/material-design-icons/navigation/svg/production/ic_chevron_right_24px.svg',
					'node_modules/material-design-icons/navigation/svg/production/ic_expand_less_24px.svg',
					'node_modules/material-design-icons/navigation/svg/production/ic_expand_more_24px.svg',
					'node_modules/material-design-icons/social/svg/production/ic_notifications_24px.svg',
					'node_modules/material-design-icons/social/svg/production/ic_person_24px.svg'
				],
				dest: 'templates/admin/dist/fonts',
				options:
				{
					destCss: 'templates/admin/assets/styles',
					template: 'templates/admin/assets/styles/_icon.tpl'
				}
			},
			templateDefault:
			{
				src:
				[
					'node_modules/material-design-icons/action/svg/production/ic_check_circle_24px.svg',
					'node_modules/material-design-icons/action/svg/production/ic_info_24px.svg',
					'node_modules/material-design-icons/action/svg/production/ic_search_24px.svg',
					'node_modules/material-design-icons/alert/svg/production/ic_error_24px.svg',
					'node_modules/material-design-icons/alert/svg/production/ic_warning_24px.svg',
					'node_modules/material-design-icons/navigation/svg/production/ic_chevron_left_24px.svg',
					'node_modules/material-design-icons/navigation/svg/production/ic_chevron_right_24px.svg',
					'node_modules/material-design-icons/navigation/svg/production/ic_first_page_24px.svg',
					'node_modules/material-design-icons/navigation/svg/production/ic_last_page_24px.svg',
					'node_modules/material-design-icons/content/svg/production/ic_add_24px.svg',
					'node_modules/material-design-icons/content/svg/production/ic_remove_24px.svg',
					'node_modules/material-design-icons/navigation/svg/production/ic_chevron_right_24px.svg',
					'node_modules/material-design-icons/social/svg/production/ic_person_24px.svg'
				],
				dest: 'templates/default/dist/fonts',
				options:
				{
					destCss: 'templates/default/assets/styles',
					template: 'templates/default/assets/styles/_icon.tpl'
				}
			},
			templateWebsite:
			{
				src:
				[
					'node_modules/redaxscript-flaticon/flaticon/essential/agenda.svg',
					'node_modules/redaxscript-flaticon/flaticon/design/cube.svg',
					'node_modules/redaxscript-flaticon/flaticon/essential/alarm.svg',
					'node_modules/redaxscript-flaticon/flaticon/essential/database-1.svg',
					'node_modules/redaxscript-flaticon/flaticon/essential/magic-wand.svg',
					'node_modules/redaxscript-flaticon/flaticon/essential/paper-plane-1.svg',
					'node_modules/redaxscript-flaticon/flaticon/essential/settings-6.svg',
					'node_modules/redaxscript-flaticon/flaticon/essential/stopwatch-1.svg',
					'node_modules/redaxscript-flaticon/flaticon/productivity-and-development/rocket-ship.svg',
					'node_modules/redaxscript-flaticon/flaticon/online-marketing/devices.svg',
					'node_modules/redaxscript-flaticon/flaticon/programming-line/command-line.svg',
					'node_modules/redaxscript-flaticon/flaticon/programming-line/editing-code.svg',
					'node_modules/redaxscript-flaticon/flaticon/science/atoms.svg',
					'node_modules/redaxscript-flaticon/flaticon/science/flask.svg',
					'node_modules/redaxscript-flaticon/flaticon/security/antivirus.svg',
					'node_modules/redaxscript-flaticon/flaticon/security/key.svg',
					'node_modules/redaxscript-flaticon/flaticon/seo-and-analytics/analytics-2.svg',
					'node_modules/redaxscript-flaticon/flaticon/stationery/layers.svg',
					'node_modules/redaxscript-flaticon/flaticon/stationery/paint-palette-1.svg',
					'node_modules/redaxscript-flaticon/flaticon/travel/cruise.svg'
				],
				dest: 'templates/website/dist/fonts',
				options:
				{
					destCss: 'templates/website/assets/styles',
					template: 'templates/website/assets/styles/_icon.tpl',
					codepoints: null,
					rename: null
				}
			},
			options:
			{
				font: 'icon',
				types:
				[
					'woff',
					'woff2'
				],
				codepoints:
				{
					'add': 0x2b,
					'check-circle': 0x2714,
					'chevron-left': 0x3008,
					'chevron-right': 0x3009,
					'clear': 0xd7,
					'create': 0x270E,
					'delete': 0x2297,
					'error': 0x274C,
					'exit-to-app': 0x2192,
					'expand-less': 0x2227,
					'expand-more': 0x2228,
					'first-page': 0x27EA,
					'import-contacts': 0x25EB,
					'info': 0x0069,
					'last-page': 0x27EB,
					'lock': 0x1F511,
					'notifications': 0x1F514,
					'person': 0x26C4,
					'power-settings-new': 0x2BBE,
					'remove': 0x2d,
					'search': 0x2315,
					'settings': 0x2731,
					'visibility-off': 0x2298,
					'vpn-key': 0x2386,
					'warning': 0x0021
				},
				rename: function (name)
				{
					return grunt.path.basename(name).split('_').join('-').replace('ic-', '').replace('-24px', '');
				},
				autoHint: false,
				htmlDemo: false
			}
		},
		shell:
		{
			phpbench:
			{
				command: 'php vendor/bin/phpbench run benchs/phpbench --bootstrap=benchs/phpbench/includes/bootstrap.php --iterations=10 --progress=blinken'
			},
			phpunit:
			{
				command: 'php vendor/bin/phpunit --configuration=phpunit.xml ' + grunt.option.flags()
			},
			phpunitParallel:
			{
				command: 'php vendor/bin/paratest --processes=10 --configuration=phpunit.xml ' + grunt.option.flags()
			},
			phpcpdBase:
			{
				command: 'php vendor/bin/phpcpd includes',
				options:
				{
					failOnError: false
				}
			},
			phpcpdModules:
			{
				command: 'php vendor/bin/phpcpd modules',
				options:
				{
					failOnError: false
				}
			},
			tocBase:
			{
				command: 'sh vendor/bin/tocgen.sh assets .tocgen'
			},
			tocModules:
			{
				command: 'sh vendor/bin/tocgen.sh modules .tocgen'
			},
			tocTemplates:
			{
				command: 'sh vendor/bin/tocgen.sh templates .tocgen'
			},
			toclintBase:
			{
				command: 'sh vendor/bin/tocgen.sh assets .tocgen -l'
			},
			toclintModules:
			{
				command: 'sh vendor/bin/tocgen.sh modules .tocgen -l'
			},
			toclintTemplates:
			{
				command: 'sh vendor/bin/tocgen.sh templates/admin/assets .tocgen -l && sh vendor/bin/tocgen.sh templates/default/assets .tocgen -l'
			},
			removeBuild:
			{
				command: 'rm -rf build'
			},
			options:
			{
				stdout: true,
				failOnError: true
			}
		},
		rename:
		{
			iconAdmin:
			{
				src:
				[
					'templates/admin/assets/styles/icon.tpl'
				],
				dest: 'templates/admin/assets/styles/_icon.css'
			},
			iconDefault:
			{
				src:
				[
					'templates/default/assets/styles/icon.tpl'
				],
				dest: 'templates/default/assets/styles/_icon.css'
			},
			iconWebsite:
			{
				src:
				[
					'templates/website/assets/styles/icon.tpl'
				],
				dest: 'templates/website/assets/styles/_icon.css'
			}
		},
		svgmin:
		{
			modules:
			{
				src:
				[
					'modules/*/assets/images/*.svg'
				],
				expand: true
			},
			templates:
			{
				src:
				[
					'templates/*/assets/images/*.svg'
				],
				expand: true
			},
			options:
			{
				plugins:
				[
					{
						removeViewBox: false
					}
				]
			}
		},
		watch:
		{
			build:
			{
				files:
				[
					'assets/styles/*.css',
					'templates/**/assets/styles/*.css'
				],
				tasks:
				[
					'build'
				]
			},
			css:
			{
				files:
				[
					'assets/styles/*.css',
					'templates/**/assets/styles/*.css'
				],
				tasks:
				[
					'build-css'
				]
			},
			phpunit:
			{
				files:
				[
					'includes/**/*.php',
					'tests/**/*.php',
					'tests/**/*.json'
				],
				tasks:
				[
					'phpunit'
				]
			}
		}
	});

	/* load tasks */

	require('load-grunt-tasks')(grunt);

	/* rename tasks */

	grunt.task.renameTask('json-format', 'formatJSON');
	
	/* register tasks */

	grunt.registerTask('default',
	[
		'jscs',
		'jshint',
		'jsonlint',
		'stylelint',
		'colorguard',
		'htmlhint',
		'phpcs',
		'phpcpd',
		'languagelint',
		'toclint'
	]);
	grunt.registerTask('stylelint',
	[
		'postcss:stylelint'
	]);
	grunt.registerTask('stylefmt',
	[
		'postcss:stylefmt'
	]);
	grunt.registerTask('colorguard',
	[
		'postcss:colorguard'
	]);
	grunt.registerTask('languagelint',
	[
		'formatJSON:languages',
		'diffJSON:languages',
		'shell:removeBuild'
	]);
	grunt.registerTask('toclint',
	[
		'shell:toclintBase',
		'shell:toclintModules',
		'shell:toclintTemplates'
	]);
	grunt.registerTask('test',
	[
		'phpunit'
	]);
	grunt.registerTask('phpbench',
	[
		'shell:phpbench'
	]);
	grunt.registerTask('phpunit',
	[
		'shell:phpunit'
	]);
	grunt.registerTask('phpunitParallel',
	[
		'shell:phpunitParallel'
	]);
	grunt.registerTask('phpcpd',
	[
		'shell:phpcpdBase',
		'shell:phpcpdModules'
	]);
	grunt.registerTask('toc',
	[
		'shell:tocBase',
		'shell:tocModules',
		'shell:tocTemplates'
	]);
	grunt.registerTask('optimize',
	[
		'toc',
		'svgmin'
	]);
	grunt.registerTask('build',
	[
		'build-font',
		'build-css',
		'build-js'
	]);
	grunt.registerTask('build-font',
	[
		'webfont',
		'rename'
	]);
	grunt.registerTask('build-css',
	[
		'postcss:base',
		'postcss:templateAdmin',
		'postcss:templateConsole',
		'postcss:templateDefault',
		'postcss:templateInstall',
		'postcss:templateSkeleton',
		'postcss:templateWebsite',
		'postcss:modulePreview',
		'postcss:moduleTinymceContent',
		'postcss:moduleTinymceSkin'
	]);
	grunt.registerTask('build-js',
	[
		'uglify:base',
		'uglify:templateAdmin',
		'uglify:templateConsole',
		'uglify:templateInstall'
	]);
};
