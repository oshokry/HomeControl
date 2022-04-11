<?php
require_once 'meekrodb.2.3.class.php';

function getDB($dbName)
{
  $config = parse_ini_file('/var/private/config.ini');

	DB::$host = $config['host'];
	DB::$port = $config['port'];
	DB::$user = $config['user'];
	DB::$password = $config['password'];
  DB::$dbName = $dbName;
  
  return DB;
}
?>