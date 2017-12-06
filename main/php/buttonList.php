<?php
require('functions.php');

$bazaLynk = new mysqli('localhost', 'root', '', 'mazurprojekt') or die();
mysqlcomm($bazaLynk, 'SET NAMES utf8;');

$out = multi_mysqlselect($bazaLynk, 'select name from kolokwia where id='.$_POST['id'].' and id_dzialy='.$_POST['id_dzialy'].';');
$row = mysqli_fetch_array($out);

echo '['.$row['name'].']';
?>