<?php

/**
 * Create a file based on a template file
 */
function create_file_from_template($file, $template_file, $hooks)
{
	global $conf;

	// Read our template in as a string.
	$template = file_get_contents($template_file);
	$keys = array();
	$data = array();
	foreach($hooks as $key => $value) {
		array_push($keys, '${'. $key .'}');
		array_push($data, $value);
	}

	// Replace all of the variables with the variable values.
	$template = str_replace($keys, $data, $template);

	// Save config file
	file_put_contents($file, $template);
	@chmod($file, octdec($conf->global->MAIN_UMASK));
}
