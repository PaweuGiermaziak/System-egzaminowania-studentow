<?php
require('functions.php');

$lista = '';

$bazaLynk = new mysqli('localhost', 'root', '', 'mazurprojekt') or die();
mysqlcomm($bazaLynk, 'SET NAMES utf8;');

$out = multi_mysqlselect($bazaLynk, 'select * from dzialy;');

	for($i = 1; $row = mysqli_fetch_array($out); $i++){
		$lista .=  '<li><span onclick="dirTree('.$i.')">'.$row['name'].'</span><ul id="ul'.$i.'">';
			$outKolokwia = multi_mysqlselect($bazaLynk, 'select * from kolokwia where id_dzialy = "'.$row['id'].'";');

				while($rowKolokwia = mysqli_fetch_array($outKolokwia)){
					$lista .= '<li onclick="startButton('.$rowKolokwia['id'].', '.$rowKolokwia['id_dzialy'].')">'.$rowKolokwia['name'].'</li>';
				}
			$lista .= '</ul></li>';
	}


echo $lista;
?>