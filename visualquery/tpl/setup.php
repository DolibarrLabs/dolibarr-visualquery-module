<?php

global $langs;

$config_file = dol_buildpath('visualquery').'/src/config.php';

if (file_exists($config_file)) {
	$config = file_get_contents($config_file);
	preg_match('/\$config\[\'username\'\]\[\] = \'(.*)\';/', $config, $username_matches);
	preg_match('/\$config\[\'password\'\]\[\] = \'(.*)\';/', $config, $password_matches);
}

$username = isset($username_matches) && isset($username_matches[1]) ? $username_matches[1] : 'admin';
$password = isset($password_matches) && isset($password_matches[1]) ? $password_matches[1] : 'admin';

?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	<input type="hidden" name="token" value="<?php echo $_SESSION['newtoken']; ?>">
	<input type="hidden" name="mainmenu" value="home">
	<input type="hidden" name="action" value="save">

	<table class="noborder allwidth">
		<tr>
			<td width="70%"><?php echo $langs->trans('Username'); ?></td>
			<td align="right"></td>
			<td align="center"><input type="text" name="username" value="<?php echo $username; ?>"/></td>
		</tr>
		<tr>
			<td width="70%"><?php echo $langs->trans('Password'); ?></td>
			<td align="right" width="10%"><a href="#" id="show_password"><?php echo $langs->trans('ShowPassword'); ?></a></td>
			<td align="center"><input type="password" name="password" value="<?php echo $password; ?>"/></td>
		</tr>
	</table>

	<div class="tabsAction force-center hidden">
		<input type="submit" class="button" value="<?php echo $langs->trans('Save'); ?>">
	</div>
</form>
