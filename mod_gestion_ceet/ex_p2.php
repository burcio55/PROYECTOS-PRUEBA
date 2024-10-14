<?
session_start();

$ente = $_REQUEST["ente"];

$_SESSION["ente"] = $ente;

echo $ente;
