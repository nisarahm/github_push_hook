<?php
include_once "ez_sql_core.php";
include_once "ez_sql_mysql.php";

$db = new ezSQL_mysql('DBUSER', 'DBPASS', 'DB', 'localhost');
$tables = [
  'pushes' => 'TABLENAME',
  'events' => 'TABLENAME'
];
$secret = 'GITHUBSECRET';
?>
