<?php
ini_set("display_errors",0);
ini_set("error_reporting","E_ALL");
//calidad-calidad
//security_chain permite que solamente el usuario logeado pueda ver las pantallas
//include('../include/security_chain.php'); 
//$hostname = "127.0.0.1"; 
//$username = "postgres";
//$password = "root";
$hostname = "10.46.1.91"; 
//$username = "desarrolloarea";
//$password = "AdesarrolloPass9@";
$username = "areadesarrollo";
$password = "areadesarrollopasswd";
$debug_settings = false;
$target = "postgres";
//$db_test = "test";
$db1 = "minpptrasse";
$db2 = "entes";
$db3 = "siris";
$db4 = "minpptrassi";
$db5 = "recibos_pagos";
//database name
$db_settings = array();
$db_settings[] = $db1;
$db_settings[] = $db2;
$db_settings[] = $db3;
$db_settings[] = $db4;
$db_settings[] = $db5;

$settings = array();
$settings['datasource'] = array();
$settings['datasource'][$db1] = array();
$settings['datasource'][$db1]['target'] = $target;
$settings['datasource'][$db1]['hostname'] = $hostname;
$settings['datasource'][$db1]['username'] = $username;
$settings['datasource'][$db1]['password'] = $password;
$settings['datasource'][$db2] = array();
$settings['datasource'][$db2]['target'] = $target;
$settings['datasource'][$db2]['hostname'] = $hostname;
$settings['datasource'][$db2]['username'] = $username;
$settings['datasource'][$db2]['password'] = $password;
$settings['datasource'][$db3] = array();
$settings['datasource'][$db3]['target'] = $target;
$settings['datasource'][$db3]['hostname'] = $hostname;
$settings['datasource'][$db3]['username'] = $username;
$settings['datasource'][$db3]['password'] = $password;
$settings['datasource'][$db4] = array();
$settings['datasource'][$db4]['target'] = $target;
$settings['datasource'][$db4]['hostname'] = $hostname;
$settings['datasource'][$db4]['username'] = $username;
$settings['datasource'][$db4]['password'] = $password;
$settings['datasource'][$db5] = array();
$settings['datasource'][$db5]['target'] = $target;
$settings['datasource'][$db5]['hostname'] = $hostname;
$settings['datasource'][$db5]['username'] = $username;
$settings['datasource'][$db5]['password'] = $password;
//nuevo
$settings['debug'] = $debug_settings;
$settings['db'] = "";
$settings['hostname'] = "";
$settings['username'] = "";
$settings['password'] = "";
$settings['target'] = "";

function datasource($db){
	$settings = &$GLOBALS['settings'];
	$hostname = $settings['datasource'][$db]['hostname']; 
	$username = $settings['datasource'][$db]['username'];
	$password = $settings['datasource'][$db]['password'];
	$target = $settings['datasource'][$db]['target'];
	$db_settings[0] = $db;
	//nuevo
	$settings['hostname'] = $settings['datasource'][$db]['hostname']; 
	$settings['username'] = $settings['datasource'][$db]['username'];
	$settings['password'] = $settings['datasource'][$db]['password'];
	$settings['target']= $settings['datasource'][$db]['target'];
	$settings['db'] = $db;	
}
?>
