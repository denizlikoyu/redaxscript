<?php
namespace Redaxscript;

error_reporting(E_ERROR || E_PARSE);

/* bootstrap */

include_once('includes/bootstrap.php');

/* get instance */

$registry = Registry::getInstance();

/* redirect to install */

if ($registry->get('dbStatus') < 2 && file_exists('install.php'))
{
	header('location: install.php');
	exit;
}

/* render */

Hook::trigger('renderStart');
if ($registry->get('renderBreak'))
{
	return;
}
if ($registry->get('routerBreak'))
{
	$registry->set('contentError', false);
}
if ($registry->get('contentError'))
{
	header('http/1.0 404 not found');
}

/* template */

$template = Hook::collect('renderTemplate');
if (array_key_exists('header', $template))
{
	header($template['header']);
}
if (array_key_exists('content', $template))
{
	echo $template['content'];
}
else
{
	include_once('templates/' . $registry->get('template') . '/index.phtml');
}
Hook::trigger('renderEnd');
