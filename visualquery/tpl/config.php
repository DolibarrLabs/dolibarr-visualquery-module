<?php
//////////////////////////////////////////////
// Database Configuration
//////////////////////////////////////////////

// edit database settings
$config['database_host'] = '${db_host}';
$config['database_user'] = '${db_user}';
$config['database_password'] = '${db_pass}';
$config['database_dbname'] = '${db_name}';

//////////////////////////////////////////////
// user details who can login - You can also specify more than one user
//////////////////////////////////////////////

// user 1
$config['username'][] = '${username}';
$config['password'][] = '${password}';
