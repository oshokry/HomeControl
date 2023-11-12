<?php
require_once 'meekrodb.2.3.class.php';

function getDB($dbName)
{
  $config = parse_ini_file('/var/private/config.ini');

  DB::$host = $config['host'];
  DB::$port = $config['port'];
  DB::$user = getenv('MYSQL_USER');
  DB::$password = getenv('MYSQL_PASSWORD');
  DB::$dbName = $dbName;
  
  return DB;
}
?>