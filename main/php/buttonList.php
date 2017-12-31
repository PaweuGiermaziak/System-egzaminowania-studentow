<?php
session_start();
require('functions.php');

$_SESSION['idKolokwium']=$_POST['id'];
$_SESSION['idKolokwiumDzial']=$_POST['id_dzialy'];

$bazaLynk = new mysqli('localhost', 'root', '', 'mazurprojekt') or die();
mysqlcomm($bazaLynk, 'SET NAMES utf8;');

$out = multi_mysqlselect($bazaLynk, 'select name from kolokwia where id='.$_POST['id'].' and id_dzialy='.$_POST['id_dzialy'].';');
$row = mysqli_fetch_array($out);

//echo '['.$row['name'].']';

echo '
							<div onclick="loadScreen(1)" id="startButton">
								<h4>Rozpocznij</h4>
								<p id="startBtn">['.$row['name'].']</p>
							</div>
';
?>