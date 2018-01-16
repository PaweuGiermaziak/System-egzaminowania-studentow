<?php
session_start();
require('functions.php');

$bazaLynk = new mysqli('localhost', 'root', '', 'mazurprojekt') or die();
mysqlcomm($bazaLynk, 'SET NAMES utf8;');

//$_POST['odp']
//$_SESSION['nrPytania']

$out = multi_mysqlselect($bazaLynk, 'select odpowiedzi from session where id_user='.$_SESSION['id'].' and nazwaSesji='.$_SESSION['nazwaSesji'].';');
$row = mysqli_fetch_array($out);

	$tmp = explode(',', $row['odpowiedzi']);
	
	$tmp[$_SESSION['nrPytania']-1] = $_POST['odp'];
	
	$tmp = implode(',', $tmp);

	multi_mysqlselect($bazaLynk, 'update session set odpowiedzi="'.$tmp.'" where id_user='.$_SESSION['id'].' and nazwaSesji='.$_SESSION['nazwaSesji'].';');
	
//$_SESSION['Zaznaczone'];//wyswietlanie które pytania odwiedzone

?>