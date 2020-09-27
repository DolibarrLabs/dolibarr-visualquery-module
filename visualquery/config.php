<?php

global $dolibase_config;

/**
 * Module configuration
 */

$dolibase_config['module'] = array(
	'name'                      => 'VisualQuery',
	'desc'                      => 'Module867383850Desc',
	'version'                   => '1.5',
	'number'                    => '867383850',
	'family'                    => 'other',
	'position'                  => 500,
	'rights_class'              => 'visualquery',
	'url'                       => 'https://www.dolistore.com/en/modules/1086-Visual-Query.html',
	'folder'                    => 'visualquery',
	'picture'                   => 'visualquery.png',
	'dirs'                      => array(),
	'dolibarr_min'              => array(3, 8),
	'php_min'                   => array(5, 3),
	'depends'                   => array(),
	'required_by'               => array(),
	'conflit_with'              => array(),
	'check_updates'             => false,
	'enable_logs'               => false,
	'enable_triggers'           => false,
	'enable_for_external_users' => false
);

/**
 * Author informations
 */

$dolibase_config['author'] = array(
	'name'          => 'AXeL',
	'url'           => 'https://github.com/AXeL-dev',
	'email'         => 'contact.axel.dev@gmail.com',
	'dolistore_url' => 'https://www.dolistore.com/en/search?orderby=position&orderway=desc&search_query=axel'
);

/**
 * Numbering model (optional)
 */

$dolibase_config['numbering_model'] = array(
	'table'  => '',
	'field'  => '',
	'prefix' => ''
);

/**
 * Other (default)
 */

$dolibase_config['other'] = array(
	'setup_page'     => 'setup.php',
	'about_page'     => 'about.php',
	'lang_files'     => array($dolibase_config['module']['folder'].'@'.$dolibase_config['module']['folder']),
	'menu_lang_file' => $dolibase_config['module']['folder'].'@'.$dolibase_config['module']['folder'],
	'top_menu_name'  => 'home'
);
