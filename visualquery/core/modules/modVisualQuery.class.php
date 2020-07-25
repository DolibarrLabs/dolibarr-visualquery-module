<?php

// Load Dolibase
dol_include_once('visualquery/autoload.php');

// Load Dolibase Module class
dolibase_include_once('core/class/module.php');

// Load custom lib
dol_include_once('visualquery/lib/functions.php');

/**
 *	Class to describe and enable module
 */
class modVisualQuery extends DolibaseModule
{
	/**
	 * Function called after module configuration.
	 * 
	 */
	public function loadSettings()
	{
		// Update picto for Dolibarr 12++
		if (function_exists('version_compare') && version_compare(DOL_VERSION, '12.0.0') >= 0) {
			$this->picto = "visualquery_128.png@visualquery";
		}

		// Set permissions
		$this->addPermission("use", "UseVisualQuery", "u");

		// Add menus
		$menu_title = compare_version(DOL_VERSION, '<' ,'7.0.0') ? "VisualQuery" : "VisualQueryWithIcon";
		$this->addLeftMenu($this->config['other']['top_menu_name'], "visualquery", $menu_title, "/visualquery/src/index.php", '$user->rights->visualquery->use', '1', 100, '_blank');
	}

	/**
	 * Function called when module is enabled.
	 * The init function add constants, boxes, permissions and menus
	 * (defined in constructor) into Dolibarr database.
	 * It also creates data directories
	 *
	 * @param string $options Options when enabling module ('', 'noboxes')
	 * @return int 1 if OK, 0 if KO
	 */
	public function init($options = '')
	{
		global $dolibarr_main_db_host, $dolibarr_main_db_user, $dolibarr_main_db_pass, $dolibarr_main_db_name;

		// Create config file
		$config_file = dol_buildpath('visualquery').'/src/config.php';

		if (! file_exists($config_file)) {
			$template_file = dol_buildpath('visualquery/tpl/config.php');
			$hooks = array(
				'db_host'  => $dolibarr_main_db_host,
				'db_user'  => $dolibarr_main_db_user,
				'db_pass'  => $dolibarr_main_db_pass,
				'db_name'  => $dolibarr_main_db_name,
				'username' => 'admin',
				'password' => 'admin'
			);
			create_file_from_template($config_file, $template_file, $hooks);
		}

		// Create .htaccess file
		$htaccess_file = dol_buildpath('visualquery').'/src/.htaccess';

		if (! file_exists($htaccess_file)) {
			$template_file = dol_buildpath('visualquery/tpl/.htaccess.tpl');
			$hooks = array(
				'visual_query_dir'  => dol_buildpath('visualquery/src', 1)
			);
			create_file_from_template($htaccess_file, $template_file, $hooks);
		}

		return parent::init($options);
	}
}
