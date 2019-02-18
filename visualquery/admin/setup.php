<?php

// Load Dolibase
include_once '../autoload.php';

// Load Dolibase SetupPage class
dolibase_include_once('core/pages/setup.php');

// Load custom lib
dol_include_once('visualquery/lib/functions.php');

// Create Setup Page using Dolibase
$page = new SetupPage('Setup', '$user->admin', true, false, false);

// Get parameters
$action = GETPOST('action', 'alpha');

// Set actions ---

if ($action == 'save')
{
	global $dolibarr_main_db_host, $dolibarr_main_db_user, $dolibarr_main_db_pass, $dolibarr_main_db_name;

	$config_file = dol_buildpath('visualquery').'/src/config.php';
	$template_file = dol_buildpath('visualquery/tpl/config.php');
	$hooks = array(
		'db_host'  => $dolibarr_main_db_host,
		'db_user'  => $dolibarr_main_db_user,
		'db_pass'  => $dolibarr_main_db_pass,
		'db_name'  => $dolibarr_main_db_name,
		'username' => GETPOST('username', 'alpha'),
		'password' => GETPOST('password', 'alpha')
	);
	create_file_from_template($config_file, $template_file, $hooks);
}

// --- End actions

$page->addJsFile('setup.js');

$page->begin();

$page->addSubTitle('VisualQueryLogin');

$page->showTemplate('setup.php');

$page->end();
