<?
session_start();

$trab = $_REQUEST["trab"];

$_SESSION["trab"] = $trab;

echo $trab;
