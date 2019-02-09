<?php

// Load Dolibase
include_once '../autoload.php';

// Load Dolibase SetupPage class
dolibase_include_once('core/pages/setup.php');

// Create Setup Page using Dolibase
$page = new SetupPage('Setup', '$user->admin', true, false, false);

// Get parameters
$action = GETPOST('action', 'alpha');

// Set actions ---

if ($action == 'save')
{
	global $dolibarr_main_db_host, $dolibarr_main_db_user, $dolibarr_main_db_pass, $dolibarr_main_db_name;

	// Read our template in as a string.
	$file = dol_buildpath('visualquery/tpl/config.php');
	$template = file_get_contents($file);
	$keys = array();
	$data = array();
	$hooks = array(
		'db_host'  => $dolibarr_main_db_host,
		'db_user'  => $dolibarr_main_db_user,
		'db_pass'  => $dolibarr_main_db_pass,
		'db_name'  => $dolibarr_main_db_name,
		'username' => GETPOST('username', 'alpha'),
		'password' => GETPOST('password', 'alpha')
	);
	foreach($hooks as $key => $value) {
		array_push($keys, '${'. $key .'}');
		array_push($data, $value);
	}

	// Replace all of the variables with the variable values.
	$template = str_replace($keys, $data, $template);

	// Save config file
	$config_file = dol_buildpath('visualquery').'/src/config.php';
	file_put_contents($config_file, $template);
}

// --- End actions

$page->addJsFile('setup.js');

$page->begin();

$page->addSubTitle('VisualQueryLogin');

$page->showTemplate('setup.php');

$page->end();
