<?php
//require('../lib/kint/Kint.class.php');
ini_set("display_errors",0);
ini_set("error_reporting","E_ALL");
//calidad-calidad
//security_chain permite que solamente el usuario logeado pueda ver las pantallas
//include('../include/security_chain.php');
ini_set('date.timezone', 'America/Caracas');

include("settings_entes.php");


/*$hostname = "localhost";
$username = "postgres";
$password = "18932916";*/


/*$hostname = "10.46.1.91";
$username = "areadesarrollo";
$password = "areadesarrollopasswd";*/
/////11052022
$hostname = "10.46.1.93";
$username = "postgres";
$password = "postgres";

//OJOOOOO CAMBIAR ESTO POR LOS DATOS COMENTADOS DEL 72
///11052022
$hostname_recibos = "10.46.1.93";
$username_recibos = "postgres";
$password_recibos = "postgres";


/*$hostname_recibos = "10.46.1.91";
$username_recibos = "areadesarrollo";
$password_recibos = "areadesarrollopasswd";
*/


/*
$hostname_recibos = "10.46.1.72";
$username_recibos = "produccion";
$password_recibos = "produccionpasswd";
*/


$debug_settings = false;
$target = "postgres";
//$db_test = "test";
$db1 = "sire";
$db2 = "recibos_pagos";
$db3 = "acceso1";
$db4 = "minpptrasse";
$db5 = "entes";
$db6 = "minpptrassi";
//database name
$db_settings = array();
$db_settings[] = $db1;
$db_settings[] = $db2;
$db_settings[] = $db3;
$db_settings[] = $db4;
$db_settings[] = $db5;
$db_settings[] = $db6;

$settings = array();
$settings['datasource'] = array();
$settings['datasource'][$db1] = array();
$settings['datasource'][$db1]['target'] = $target;
$settings['datasource'][$db1]['hostname'] = $hostname;
$settings['datasource'][$db1]['username'] = $username;
$settings['datasource'][$db1]['password'] = $password;

$settings['datasource'][$db2] = array();
$settings['datasource'][$db2]['target'] = $target;
$settings['datasource'][$db2]['hostname'] = $hostname_recibos;
$settings['datasource'][$db2]['username'] = $username_recibos;
$settings['datasource'][$db2]['password'] = $password_recibos;

$settings['datasource'][$db3] = array();
$settings['datasource'][$db3]['target'] = $target;
$settings['datasource'][$db3]['hostname'] = $hostname_recibos;
$settings['datasource'][$db3]['username'] = $username_recibos;
$settings['datasource'][$db3]['password'] = $password_recibos;

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

$settings['datasource'][$db6] = array();
$settings['datasource'][$db6]['target'] = $target;
$settings['datasource'][$db6]['hostname'] = $hostname;
$settings['datasource'][$db6]['username'] = $username;
$settings['datasource'][$db6]['password'] = $password;

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
