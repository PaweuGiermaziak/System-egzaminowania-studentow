<?php
session_start();

require('functions.php');

$bazaLynk = new mysqli('localhost', 'root', '', 'mazurprojekt') or die();
mysqlcomm($bazaLynk, 'SET NAMES utf8;');

$out = multi_mysqlselect($bazaLynk, 'select odpowiedzi,poprawne from session where id_user='.$_SESSION['id'].' and nazwaSesji='.$_SESSION['nazwaSesji'].';');
$row = mysqli_fetch_array($out);

	$odp = explode(',', $row['odpowiedzi']);
	$popr = explode(',', $row['poprawne']);
	
	$pkt = 0;
	
	for($i=0; $i< 45; $i++){
		if($odp[$i] == $popr[$i] and $popr[$i] != 0)
			$pkt++;
	}
	
multi_mysqlselect($bazaLynk, 'update session set ocena="'.$i.'" where id_user='.$_SESSION['id'].' and nazwaSesji='.$_SESSION['nazwaSesji'].';');

echo (round($pkt/4.5, 1)).'/10';








unset($_SESSION['time']);
?>