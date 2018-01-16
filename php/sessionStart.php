<?php
session_start();
require('functions.php');

$bazaLynk = new mysqli('localhost', 'root', '', 'mazurprojekt') or die();
mysqlcomm($bazaLynk, 'SET NAMES utf8;');

$out2 = multi_mysqlselect($bazaLynk, 'select count(1) from pytania where id_dzialu='.$_SESSION['idKolokwiumDzial'].' and id_kolokwium='.$_SESSION['idKolokwium'].';');
$rowPytanka = mysqli_fetch_array($out2);

$idPytanka = array(); 
$i=0;
$dupl = false;

while($i<45){
	$tmp = (rand() % $rowPytanka['count(1)']) + 1;
	
	for($j=0; $j<$i; $j++){
		if($idPytanka[$j]==$tmp)
			$dupl = true;
	}
	
	if(!$dupl){
		$idPytanka[]=$tmp;
		$i++;
	}

	
	$dupl = false;
}

$listaPytanek = implode(',', $idPytanka);

$_SESSION['nazwaSesji'] = rand();

		$tmp = '0';
			for($i = 0; $i < 44; $i++){
				$tmp .= ',0';
			}

mysqlcomm($bazaLynk, "insert into session values (null, ".$_SESSION['id'].", ".$_SESSION['nazwaSesji'].", ".$_SESSION['idKolokwiumDzial'].", ".$_SESSION['idKolokwium'].", '".$listaPytanek."', '".$tmp."', '".$tmp."', ".time().", 0);");
$_SESSION['Zaznaczone'] = $tmp;


?>