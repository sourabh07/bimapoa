<?php
session_start();
ob_start();
ini_set('max_execution_time', 800); //300 seconds = 5 minutes
function MyAutoload($className){
	include_once('./classes/'.$className . '.php');
}

spl_autoload_register('MyAutoload');

$dbobj = new DB();
$dbobj->connect();
?>