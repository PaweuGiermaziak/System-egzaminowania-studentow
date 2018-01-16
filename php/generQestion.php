<?php
session_start();
require('functions.php');

$bazaLynk = new mysqli('localhost', 'root', '', 'mazurprojekt') or die();
mysqlcomm($bazaLynk, 'SET NAMES utf8;');

$out = multi_mysqlselect($bazaLynk, 'select pytania from session where id_user='.$_SESSION['id'].' and nazwaSesji='.$_SESSION['nazwaSesji'].';');
$row = mysqli_fetch_array($out);

$idPytanek = explode(',', $row['pytania']);

$out = multi_mysqlselect($bazaLynk, 'select id,pytanie from pytania where id_dzialu='.$_SESSION['idKolokwiumDzial'].' and id_kolokwium='.$_SESSION['idKolokwium'].' and id='.$_POST['qtn'].';');
$row = mysqli_fetch_array($out);

$_SESSION['idPytania']=$row['id'];
$_SESSION['nrPytania']=$_POST['qtn'];

echo 'Pytanie nr. ' . $_POST['qtn'] . ': ' . $row['pytanie'];



?>