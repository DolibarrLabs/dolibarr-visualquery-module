<?php

// Load Dolibase
dol_include_once('visualquery/autoload.php');

// Load Dolibase Module class
dolibase_include_once('core/class/module.php');

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
		// Set permissions
		$this->addPermission("use", "UseVisualQuery", "u");

		// Add menus
		$menu_title = compare_version(DOL_VERSION, '<' ,'7.0.0') ? "VisualQuery" : "VisualQueryWithIcon";
		$this->addLeftMenu($this->config['other']['top_menu_name'], "visualquery", $menu_title, "/visualquery/src/", '$user->rights->visualquery->use', '1', 100, '_blank');
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
		global $conf, $dolibarr_main_db_host, $dolibarr_main_db_user, $dolibarr_main_db_pass, $dolibarr_main_db_name;

		$config_file = dol_buildpath('visualquery').'/src/config.php';

		if (! file_exists($config_file)) {
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
				'username' => 'admin',
				'password' => 'admin'
			);
			foreach($hooks as $key => $value) {
				array_push($keys, '${'. $key .'}');
				array_push($data, $value);
			}

			// Replace all of the variables with the variable values.
			$template = str_replace($keys, $data, $template);

			// Save config file
			file_put_contents($config_file, $template);
			@chmod($config_file, octdec($conf->global->MAIN_UMASK));
		}

		return parent::init($options);
	}
}
