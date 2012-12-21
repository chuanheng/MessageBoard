<?php

require_once('include/sql_class.php');
$db=new db_Mysql(); 
$db->dbServer  = 'localhost';
$db->dbbase   = 'messageboard';
$db->dbUser  = 'root';
$db->dbPwd  = '';
$db->dbconnect(); 

define('MCBOOKINSTALLED', true);
define('TABLE_PREFIX', "mb_");

if (PHP_VERSION > '5.2.0'){
date_default_timezone_set('PRC');
}

?>