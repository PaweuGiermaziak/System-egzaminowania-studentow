<?php
session_start();
require('functions.php');

$bazaLynk = new mysqli('localhost', 'root', '', 'mazurprojekt') or die();
mysqlcomm($bazaLynk, 'SET NAMES utf8;');

//echo 'select odp1, odp2, odp3, odp4 from pytania where id_dzialu='.$_SESSION['idKolokwiumDzial'].' and id_kolokwium='.$_SESSION['idKolokwium'].';';die();

$out = multi_mysqlselect($bazaLynk, 'select odp1, odp2, odp3, odp4, poprawna from pytania where id_dzialu='.$_SESSION['idKolokwiumDzial'].' and id_kolokwium='.$_SESSION['idKolokwium'].' and id='.$_SESSION['idPytania'].';');
$row = mysqli_fetch_array($out);

$i=0;
$dupl = false;
while($i<4){
	$tmp = (rand() % 4) + 1;
	
	for($j=0; $j<$i; $j++){
		if($kolejnosc[$j]==$tmp)
			$dupl = true;
	}
	
	if(!$dupl){
		$kolejnosc[]=$tmp;
		
			if($tmp == $row['poprawna'])
				$poprawna = $i+1;
		$i++;	
	}

	
	
	$dupl = false;
}



$output = '';

for($i = 0; $i<4; $i++){
	switch($kolejnosc[$i]){
		case 1: $output .= '<p><input type="radio" name="T1" value=""> '.$row['odp1'].'</p>'; break;
		case 2: $output .= '<p><input type="radio" name="T1" value=""> '.$row['odp2'].'</p>'; break;
		case 3: $output .= '<p><input type="radio" name="T1" value=""> '.$row['odp3'].'</p>'; break;
		case 4: $output .= '<p><input type="radio" name="T1" value=""> '.$row['odp4'].'</p>'; break;
	}
}

$out = multi_mysqlselect($bazaLynk, 'select poprawne from session where id_user='.$_SESSION['id'].' and nazwaSesji='.$_SESSION['nazwaSesji'].';');
$row = mysqli_fetch_array($out);

	$tmp = explode(',', $row['poprawne']);
	$tmp[$_SESSION['nrPytania']-1] = $poprawna; 
	$tmp = implode(',', $tmp);

	multi_mysqlselect($bazaLynk, 'update session set poprawne="'.$tmp.'" where id_user='.$_SESSION['id'].' and nazwaSesji='.$_SESSION['nazwaSesji'].';');

echo $output;
echo '<span style="display:none">'.rand().'</span>';
?>
